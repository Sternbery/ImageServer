<?php

class BrowseController extends Controller{
	public function getView(Request $request, View $view = null){
		
		$user = User::getCurrentUser();
		$dir  = $user->getFile($request->getURI());
		
		if($dir->isDir()){
			$view = new FileView('browse.php');
		}else{
			$view = new FileView('browsefile.php');
		}
		
		$view->bind('user',$user);
		$view->bind('dir',$dir);
		return $view;
	}
}