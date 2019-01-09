<?php
class SuperView extends FileView{
	protected $subviews =[];
	
	public function bindSubview($key, SubView $view){
		$this->subviews[$key] = $view;
	}
	
	public function render(){
		global $request;
		
		$renderDependencies = $this->renderDependencies;
		
		foreach($this->subviews as $k => $v){
			$$k = $v;
		}
		
		foreach($this->variables as $k => $v){
			$$k = $v;
		}
		
		include $this->filename;
	}
	
	public function renderDependencies($id){
		foreach($subviews as $key => $view){
			$view->renderDependency($id);
		}
	}
	
}