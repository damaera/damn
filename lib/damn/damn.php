<?php 

/**
* @author damaera [damaera@live.com]
*
*
* 
*/
class Damn
{
	function __construct()
	{

		require 'app/config.php';

		if (PHASE == 'development') {
			error_reporting(E_ALL);
		}
		if (PHASE == 'production'){
			error_reporting(0);
		}
		if (file_exists('vendor/autoload.php')) {
			require 'vendor/autoload.php';
		}

		foreach (glob("app/controllers/*Controller.php") as $filename)
		{
			include $filename;
		}
		foreach (glob("app/models/*Model.php") as $filename)
		{
			include $filename;
		}

		config(array(
			'views.cache'	=> VIEW_CACHE,
			'views.layout'	=> VIEW_LAYOUT
		));

		require 'app/routes.php';

		dispatch();
	}
}