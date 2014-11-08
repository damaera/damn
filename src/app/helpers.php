<?php
/**
 * Custom Helper for Handlebars
 * 
 * @var array
 */
$helpers = array(

	/**
	 * change to uppercase
	 *
	 * usage
	 * var1 = 'lorem ipsum'
	 * {{ upperCase var1 }}
	 * output = 'LOREM IPSUM'
	 */
	
	"upperCase" => function ($string) {
		return strtoupper($string);
	},

	"lowerCase" => function ($string) {
		return strtolower($string);
	},

	"titleCase" => function ($string) {
		return ucwords($string);
	},

	"json" => function ($array) {
		return json_encode($array, JSON_PRETTY_PRINT);
	},

	"formatDate" => function ($date , $format) {
		return date($format , $date);
	}


	/**
	 * Make your own helpers
	 */

);