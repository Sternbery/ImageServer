<?php
class PostedFile{
	private $name, $type, $tmp_name, $error, $size;
	
	private function __construct($a){
		$this->name=$a['name'];
		$this->type=$a['type'];
		$this->tmp_name=$a['tmp_name'];
		$this->error=$a['error'];
		$this->size=$a['size'];
	}
	
	public static function getPost(){
		$files = [];
		
		foreach($_FILES as $file){
			foreach(self::getInput($file) as $a){
				$files[] = new PostedFile($a);
			}
		}
		
		return $files;
	}
	
	public static function getInput($files){
		$arr = [];
		
		foreach($files as $field => $a){
			foreach($a as $i => $v){
				$arr[$i][$field] = $v;
			}
		}
		
		return $arr;
	}
	
	public function save(FileCursor $cursor){
		//var_dump($cursor);
		$cursor->navTo($this->name);
		//var_dump($cursor);
		move_uploaded_file($this->tmp_name,$cursor->path());
		$cursor->navUp();
	}
}
?>