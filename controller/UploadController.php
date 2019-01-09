<?php
class UploadController extends Controller{
	public function getView(Request $request, View $view = null){
		
		
		if($request->getHTTPMethod()=='POST'){
			$user = User::getCurrentUser();
			$dir  = $user->getFile($request->getURI());
			
			$view = new FileView('postupload.php');
			
			$view->bind('dir',$dir);
		}
		else{
			$view = new FileView('upload.php');
			$view->bind('request',$request->copy());
		}
		
		return $view;
	}
}