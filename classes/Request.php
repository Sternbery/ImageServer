<?php

class Request{
	private $host;
	private $verb;
	private $control;
	private $uri;
	
	private $set = false;
	
	public static $schemes = array(
		'browse',
		'upload',
		'uploads',
		'download',
		'login'
	);
	
	public static $default_scheme = 'browse';
	public static $login_scheme = 'login';
	
	public static $currentRequest;
	
	public function __construct($host ='image-server.local',$verb ='GET',$control='browse',$uri=''){
		$this->host = $host;
		$this->verb = $verb;
		$this->control = $control;
		$this->uri = $uri;
	}
	
	public function getURI(){
		return self::trimURI(explode('/',$this->uri));
	}
	public function getAddress(){
		return $this->uri;
	}
	public function getControl(){
		return $this->control;
	}
	public function getHTTPMethod(){
		return $this->verb;
	}
	
	public function setAddress($uri){
		if(!$this->set) $this->uri=$uri;
		else throw new Exception();
		return $this;
	}
	public function setHTTPMethod($verb){
		if(!$this->set) $this->verb=$verb;
		else throw new Exception();
		return$this;
	}
	public function setControl($control){
		if(!$this->set) $this->control=$control;
		else throw new Exception();
		$this;
	}
	public function setURI(array $uri){
		if(!$this->set) $this->uri=implode('/',$uri);
		else throw new Exception();
		$this;
	}
	
	public function copy(){
		return new Request($this->host,
			$this->verb,
			$this->control,
			$this->uri);
	}
	public function __toString(){
		return 'http://'.$this->host.'/'.$this->control.'/'.$this->getAddress();
	}
	
	public static function getCurrentRequest(){
		
		//URL is either of the form 
		//domain-name.com/control/uri
		//or
		//ip.add.re.ss/document-root/control/uri
		//this method is currently only capable of handling the former case
		
		//if we've already found the current request just return that.
		
		//return new Request();
		
		if(self::$currentRequest)
			return self::$currentRequest;
		
		$host = $_SERVER['HTTP_HOST'];
		$verb = $_SERVER['REQUEST_METHOD'];
		$scheme='';
		
		$uri = urldecode($_SERVER['REQUEST_URI']);
		$uri = explode('/',$uri);
		
		if(count($uri)>0){
			$uri = self::trimURI($uri);
			if(!empty($uri[0])) $scheme = $uri[0];
		}
		
		if(in_array($scheme, self::$schemes))
			$uri = array_slice($uri,1);
		else
			$scheme = self::$default_scheme;
		
		
		$uri = implode('/',$uri);
		
		self::$currentRequest = new Request($host,$verb,$scheme,$uri);
		self::$currentRequest->set = true;
		return self::$currentRequest;
	}
	
	public static function trimURI(array $uri){
		
		while(isset($uri[0])&&$uri[0]=='')
			$uri = array_slice($uri,1);
		$uri = array_reverse($uri);
		while(isset($uri[0])&&$uri[0]=='')
			$uri = array_slice($uri,1);
		$uri = array_reverse($uri);
		return $uri;
	}
}

$request = Request::getCurrentRequest();

