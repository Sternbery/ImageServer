<?php

//things I want to do with this
//get the directory indicated by the request uri
//get a list of sub files to navigate to
//get uri for any particular file
//traverse up and down the directory tree;
//perhaps the UserFile 

class FileCursor{
	private $base_dir='';
	private $filepath = [];
	private $prevpath = [];
	
	public function __construct($base,array $filepath=[]){
		$this->base_dir = $base;
		$this->filepath = $filepath;
	}
	
	public function path(){
		return $this->base_dir.'\\'.implode('\\',$this->filepath);
	}
	public function filepath(){
		return implode('\\',$this->filepath);
	}
	public function navTo($file){
		$this->filepath[] = $file;
	}
	public function navUp(){
		return array_pop($this->filepath);
	}
	public function cd($p){
		if(substr($p,0,1) == '/'){
			$this->filepath=[];
		}
		$path = explode('/',$p);
		foreach($path as $v){
			if($v=='.') continue;
			else if($v=='..') $this->navUp();
			else if($v=='~') $this->filepath=[];
			else $this->navTo($v);
		}
	}
	public function savePath(){
		$this->prevpath = $this->filepath;
	}
	public function back(){
		$this->filepath = $this->prevpath;
		$this->prevpath = [];
	}
	public function name(){
		$r = end($this->filepath);
		reset($this->filepath);
		return $r;
	}
	public function scan($filter = true){
		
		$dirs = @scandir($this->path());
		
		if(!$dirs)
			return array();
		
		if($filter)
			$dirs = array_filter($dirs,function($v){
				return !in_array($v,array('.','..'));
			});
		
		return $dirs;
	}
	
	public function exists(){
		return file_exists($this->path());
	}
	public function isDir(){
		return is_dir($this->path());
	}
	public function isFile(){
		return is_file($this->path());
	}
	public function file(){
		$path = $this->path();
		return is_dir($path)?new SPLFileInfo($path):new SPLFileObject($path);
	}
	
	//need way of telling if indicated file is image and 
	//if so, retrieving it as such.
	
	public function isImage(){
		return @exif_imagetype($this->path());
	}
	
	public function image(){
		
	}
}