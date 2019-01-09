<?php

spl_autoload_register();

set_include_path(get_include_path().PATH_SEPARATOR.'classes/');
set_include_path(get_include_path().PATH_SEPARATOR.'model/');
set_include_path(get_include_path().PATH_SEPARATOR.'controller/');



/* spl_autoload_register(function($class){ 
	include 'controller/'.$class.'.php';
}); */