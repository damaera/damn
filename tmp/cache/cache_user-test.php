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
		'hbhelpers' => array(            'upperCase' => function($string) {
		return strtoupper($string);
	},
            'json' => function($array) {
		return json_encode($array, JSON_PRETTY_PRINT);
	},
            'formatDate' => function($date , $format) {
		return date($format , $date);
	},
),
		'partials' => array(),
		'scopes' => array($in),
		'sp_vars' => array(),

	);
	return '<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	'.LCRun3::encq($cx, LCRun3::v($cx, $in, array('tes'))).'
	'.LCRun3::encq($cx, LCRun3::v($cx, $in, array('tos'))).'
'.'	<!DOCTYPE html>
	<html>
	<head>
		<title>List User</title>
		<style>
			body{
				font-family: \'Calibri\' , sans-serif;
				color: #444;
				padding: 100px;
				font-size: 1.2em;
			}
		</style>
	</head>
	<body>
	<pre>	
	'.LCRun3::hbch($cx, 'json', array(array(LCRun3::v($cx, $in, array('userId'))),array()), 'encq', '$in').'
	</pre>
		<h1>nama : '.LCRun3::hbch($cx, 'upperCase', array(array(LCRun3::v($cx, $in, array('userId','nama'))),array()), 'encq', '$in').'</h1>
		<h3>id : '.LCRun3::encq($cx, LCRun3::v($cx, $in, array('userId','id'))).'</h3>
	
	
	
		<h3>'.LCRun3::hbch($cx, 'formatDate', array(array(LCRun3::v($cx, $in, array('date')),'y:m:d'),array()), 'encq', '$in').'</h3>
	</body>
	</html>'.'</body>
</html>';
}
?>