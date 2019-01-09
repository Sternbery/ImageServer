<?php
	//var_dump($_POST);
	
	$keys = [
		'name',
		'type',
		'tmp_name',
		'error',
		'size'
	];
	
	//var_dump($_FILES);
	
	foreach(PostedFile::getPost() as $f){
		$f->save($dir);
	}
	
	$r = Request::getCurrentRequest()->copy()->setControl('browse');
	
	//redirect to browse the files just uploaded
	header('Location: '.$r);
	die;
?>