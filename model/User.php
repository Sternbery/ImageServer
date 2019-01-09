<?php

class User{
	private $id;
	private $username;
	private $password;
	private $token;
	private $rootUserDir;
	private $is_admin=false;
	private $is_logged_in = false;
	private $login_error;
	
	public static function getCurrentUser(){
		
		$u = getFormData('username');
		$p = getFormData('password');
		$sp= sha1($p);
		$t = getFormData('token');
		
		if( !$u && (!$p || !$t) ){
			return new User();
		}
		
		$qstring = 'SELECT `user_id`, `username`, `password`, `is_admin`, `root_dir`
		FROM `user`
		WHERE `username` = :username';
		
		if($p)
			$qstring .= ' AND `password` = :password';
		else if($t)
			$qstring .= ' AND `token` = :token';
		
		global $db;
		
		$query = $db->prepare($qstring);
		$query->bindParam(':username',$u);
		
		if($p)
			$query->bindParam(':password',$sp);
		else if($t)
			$query->bindParam(':token',$t);
		
		$query->execute();
		
		if($query->rowCount()==0){
			$user = self::getUsernameNotFound();
			$user->username = $u;
			if($p)
				$user->password = $sp;
			else if($t)
				$user->token = $t;
			
			return $user;
		}
			
		$user = self::getUserFromQuery($query->fetch());
		
		$user->token = createToken($u);
		
		$iquery = $db->prepare(
		'UPDATE `user`
		SET `token` = :token
		WHERE `user_id` = :uid');
		$iquery->bindParam(':token',$user->token);
		$iquery->bindParam(':uid',$user->id,PDO::PARAM_INT);
		
		$iquery->execute();
		
		$user->removeCookie();
		$user->createCookie();
		
		return $user;
	}
	
	private static function getUsernameNotFound(){
		$user = new User();
		$user->login_error = 
		'User not found';
		return $user;
	}
	private static function getPasswordMismatch(){
		$user = new User();
		$user->login_error = 
		'Passwords do not match';
		return $user;
	}
	private static function getUserFromQuery(array $query){
		$user = new User();
		$user->id = $query['user_id'];
		$user->username=$query['username'];
		$user->password=$query['password'];
		$user->root_user_dir=$query['root_dir'];
		$user->is_admin = $query['is_admin'];
		$user->is_logged_in = true;
		return $user;
	}
	
	public function isLoggedIn(){
		return $this->is_logged_in;
	}
	public function isGuest(){
		return ! $this->is_logged_in;
	}
	
	public function createCookie(){
		$this->removeCookie();
		setcookie('username',$this->username,time()+(60*60),'/');
		setcookie('token',$this->token,time()+(60*60),'/');
	}
	public function removeCookie(){
		setcookie('username','a',time()-(60*60),'/');
		setcookie('token','a',time()-(60*60),'/');
	}

	public function getFile(array $path = []){
		return new FileCursor('uploads'.$this->rootUserDir,$path);
	}
}

function createToken($salt){
	$date = (new DateTime())->format('l, d-M-Y H:i:s T');
	return sha1($salt.':'.$date);
}
?>