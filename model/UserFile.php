<?php

//things I want to do with this
//get the directory indicated by the request uri
//get a list of sub files to navigate to
//get uri for any particular file
//traverse up and down the directory tree;
//perhaps the UserFile 

class UserFile extends SPLFileInfo{
	
	private $filename;
	
	public function __construct($filename){
		parent::__construct(getcwd().'\\'.$filename);
		$this->filename = $filename;
	}
	
	public function scandir(){
		if(!$this->isDir())
			return array();
		
		$dir = scandir($this->getPathname());
		
		$dir = array_filter($dir,function($var){
			return !in_array($var,array('.','..'));
		});
		
		$dirs = array();
		foreach($dir as $v){
			$dirs[] = new UserFile($this->filename.''.$v);
		}
		
		return $dirs;
	}
	
/* 	public static function isRelativePath($path){
		if(is_array($path))
			return self::isRelativePathArray($path);
		return self::isRelativePathString($path);
	}
	public static function isRelativePathArray(array $path){
		$linux = false
		
		if($linux){//linux
			if($path[0]=='') return false;
			return true;
		}else{ //windows
			if($path[0]=='c:') return false;
			return true;
		}
		
	}
	public static function isRelativePathString($path){
		$path = str_replace($path,'\\','/');
		return self::isRelativePathArray(explode('/'),$path);
	} */
}