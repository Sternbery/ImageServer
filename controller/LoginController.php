<?php
class LoginController extends Controller{
	public function getView(Request $request, View $view = null){
		return new FileView('login.php');
	}
}