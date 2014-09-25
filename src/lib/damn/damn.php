<?php 

/**
* 
*/
class Damn
{
	function __construct()
	{

		include 'app/config.php';

		if (PHASE == 'development') {
			\php_error\reportErrors();
		}
		if (PHASE == 'production'){
			error_reporting(0);
		}


		foreach (glob("app/controllers/*.php") as $filename)
		{
			include $filename;
		}
		foreach (glob("app/models/*.php") as $filename)
		{
			include $filename;
		}

		config(array(
			'mustache.cache'	=> VIEW_CACHE,
			'mustache.views'	=> VIEW_DIR,
			'mustache.layout'	=> VIEW_LAYOUT
		));
		
		Mustache_Autoloader::register();
		include 'app/routes.php';
		dispatch();
	}
}