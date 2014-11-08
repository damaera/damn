<?php

/**
 * just autoload
 * @var array
 */
$includes = array(
	'dispatch/dispatch.php',
	'damn/view.php',
	'damn/loader.php',
	'lightcandy/lightcandy.php',
	'DB/db.php',
	'damn/damn.php'
);



foreach($includes as $file) {
	include_once $file;
}

?>