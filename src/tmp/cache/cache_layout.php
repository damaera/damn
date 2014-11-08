<?php return function ($in, $debugopt = 1) {
	$cx = array(
		'flags' => array(
			'jstrue' => true,
			'jsobj' => true,
			'spvar' => true,
			'prop' => true,
			'method' => true,
			'mustlok' => false,
			'mustsec' => false,
			'debug' => $debugopt,
		),
		'helpers' => array(),
		'blockhelpers' => array(),
		'hbhelpers' => array(),
		'partials' => array(),
		'scopes' => array($in),
		'sp_vars' => array(),

	);
	return '<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="id"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="id"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="id"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="id"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Damn Framework</title>
	<meta name="keywords" content="damn, php, framework, simple, indonesia">
	<meta name="description" content="damn framework adalah simple php framework yang membuat bahagia">
	<meta name="author" content="damaera">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="asset/css/skeleton.css">
	<link rel="stylesheet" href="asset/css/layout.css">

</head>
<body>

	<!-- Primary Page Layout
	================================================== -->

	'.LCRun3::raw($cx, LCRun3::v($cx, $in, array('content'))).'

	<div class="primary container">
		<div class="sixteen columns footer">
			<span class="copyright">
				Created by <a href="https://twitter.com/vamaera" target="_blank">@vamaera</a>
		  Code licensed under the MIT
			</span>
		</div>

	</div>
	
	<script src="ctrl/root.js"></script>

<!-- End Document
================================================== -->
</body>
</html>
';
}
?>