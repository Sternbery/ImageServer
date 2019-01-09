<?php

class Controller{
	
	private $registry = array(
		'browse' => 'BrowseController',
		'upload' => 'UploadController',
		'login'  => 'LoginController',
	);
	
	public function getView(Request $request, View $view = null){
		
		$user = User::getCurrentUser();
		if($user->isGuest() && $request->getControl()!='login')
		{
			//guests need to login first
			$r = $request->copy();
			$r->setControl('login');
			header('Location: '.$r);
			die;
		}
		
		$template = new FileView('template.php');
		
		$template->bind('request',$request);
		$subControl = $this->getController($request);
		$template->bind('view',$subControl->getView($request,$template));
		return $template;
	}
	
	public function getController(Request $request){
		try{
			//Instantiates an object of the class identified by the string in registry
			return new $this->registry[$request->getControl()]();
		}catch(Exception $e){
			return null;
		}
	}
}

