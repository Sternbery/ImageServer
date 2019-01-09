<?php 
	$cols = 5; 
	$spacing = 1;
	
	$name = $dir->name();
	$files = $dir->scan();
	if($name){ 
		$dir->navUp();
		$files[]='..';
		$dir->navTo($name);
	}
	$num_files = count($files);
	
	$rows = $num_files/$cols;
	$height= 100.0/$rows;
	
?>
<div style="height:<?php echo 100.0/$cols*$rows; ?>vw"><?php

	//to generalize we need a view factory
	$view =  new FileView('filebutton.php');
	$view->bind('cols',$cols);
	$view->bind('spacing',$spacing);
	$view->bind('height',$height.'%');
	
	//render each file in the directory
	foreach(array_reverse($files) as $d){
		$dir->navTo($d);
		
		$file = $dir->file();
		
		if($dir->isDir()){
			$view->bind('image',asset('img/Folder-50.png',false));
		}else if($dir->isImage()){
			$view->bind('image',url('uploads',$dir->filepath(),false));
		}else{
			$view->bind('image',asset('img/Home-50.png',false));
		}
		
		$view->bind('file',$file);
		$view->bind('uri',$dir->filepath());
		
		$view->render();

		$dir->navUp();

	}
	
?></div>
