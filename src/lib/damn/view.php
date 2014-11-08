<?php
function render_layout($path, $locals = array(), $layout = null) {

	// load the inner partial
	$content = render($path, $locals);

	// use a layout (fall back to sensible defaults)
	if ($layout !== false) {

		if ($layout == null) {
			$layout = config('views.layout') ?: config('dispatch.layout');
			$layout = ($layout == null) ? 'layout' : $layout;
		}

		// render the layout while plugging in $content
		// check if objek or array
		if(is_array($locals)){
			$locals['content'] = $content;
		}
		if (is_object($locals)) {
			$locals->content = $content;
		}

		return render($layout, $locals);

	} else {
		// if we just want the partial rendered without the layout
		return $content;
	}
}


function render($path, $locals = array()) {
	
	// default views and cache directory
	$views_path = './app/views/' ;
	$views_cache = config('views.cache') ?: './tmp/cache';

	//get content from view
	$template = file_get_contents($views_path . $path . '.html');

	require('app/helpers.php');

	$config_template = array(
		'flags'		=> LightnCandy::FLAG_HANDLEBARSJS | LightnCandy::FLAG_SPVARS | LightnCandy::FLAG_INSTANCE | LightnCandy::FLAG_ERROR_EXCEPTION ,
		'basedir'	=> array($views_path),
		'fileext'	=> array('.html'),
		'hbhelpers'	=> $helpers
	);


	if (PHASE == 'development') {
		//compiling light candy
		$config_template['flags'] = LightnCandy::FLAG_HANDLEBARSJS | LightnCandy::FLAG_SPVARS | LightnCandy::FLAG_INSTANCE | LightnCandy::FLAG_ERROR_EXCEPTION;
		$phpStr = LightnCandy::compile($template, $config_template);

		//make cache file, with name $path, convert user/test to user-test
		$php_tmp = $views_cache . '/cache_' . str_replace('/', '-', $path) . '.php';
		file_put_contents($php_tmp, $phpStr);
	}

	$renderer = include($php_tmp);

	return $renderer($locals);
}

/**
 * running render function, with exception
 * 
 * @param  string $path filename in view, without extension ".html"
 * @param  array  $locals , variabel which passing to view
 */
function view($path, $locals = array()) {
	$path = str_replace('.', '/', $path);
	if (file_exists('app/views/' . $path . '.html')) {
		
		echo render($path, $locals);
	}
	else{
		if (PHASE == 'development') {
			set_exception_handler('exception_handler'); 
			throw new Exception("View '$path' not found");
		}
		
	}
}

/**
 * running render_layout function, render with layout,
 * @param  string $path 
 * @param  array  $locals ,
 * @param  string $layout : layout using in view_layout
 */
function view_layout($path, $locals = array(), $layout = null) {
	$path = str_replace('.', '/', $path);
	if (file_exists('app/views/' . $path . '.html')) {
		echo render_layout($path, $locals, $layout);
	}
	else{
		if (PHASE == 'development') {
			set_exception_handler('exception_handler'); 
			throw new Exception("View '$path' not found");
		}
		
	}


}