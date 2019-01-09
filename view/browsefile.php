<img class="transparent" src="<?php 
	if($dir->isImage())
		url('uploads',$dir->filepath());
	else
		asset('img/Settings-50.png');
?>"/>