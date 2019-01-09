<?php
	$dsn = 'mysql:host=localhost;dbname=image_server';
    $dusername = 'root';
    $dpassword = '';
	
	try {
        $db = new PDO($dsn, $dusername, $dpassword);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
		trigger_error($error_message);
        exit();
    }
	
	function getFormData($index){
		if(isset($_POST[$index]))
			return $_POST[$index];
		if(isset($_GET[$index]))
			return $_GET[$index];
		if(isset($_COOKIE[$index]))
			return $_COOKIE[$index];
		return null;
	}
?>