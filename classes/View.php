<?php

//In order to make views reusable I need to make them template-able
//a parent view defines spaces for sub-views to place their content
//a parent view may need more than just raw content to place. It may need to know 
//how big that content is so that it can be formattted correctly.
//a view should publish what content it needs, whether it is optional and
//and what kind of content it can accept.
abstract class View{
	public abstract function render();
}