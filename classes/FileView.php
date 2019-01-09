<?php

class FileView extends View{
	private $filename;
	
	private $variables = array();
	
	public function __construct($filename,$dir='view/'){
		$this->filename=$dir.$filename;
	}
	public function render(){
		
		global $request;
		
		foreach($this->variables as $k => $v){
			$$k = $v;
		}
		
		include $this->filename;
	}
	
	public function bind($key,$val){
		$this->variables[$key]=$val;
		return $this;
	}
}