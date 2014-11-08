<?php 
/**
 * ---------------------------
 * Damn Application Route
 * ---------------------------
 * 
 * Semua request akan di terima disini.
 *
 * dokumentasi :
 * http://damaera.github.io/damn/#/docs/v1.0/core/routes
 */


get('/', function(){

	view_layout('hello');

});

error(404, function(){

	view_layout('404');

});


?>