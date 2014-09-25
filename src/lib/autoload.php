<?php

$includes = array(
	'dispatch/dispatch.php',
	'mustache/Autoloader.php',
	'DB/db.php',
	'damn/damn.php',
	'error/phperror.php'
);



foreach($includes as $file) {
	include_once $file;
}

?>