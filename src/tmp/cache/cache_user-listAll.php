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
		'hbhelpers' => array(            'json' => function($array) {
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
	<title>List User</title>
	<style>
		body{
			font-family: \'Calibri\' , sans-serif;
			color: #444;
			padding: 100px;
			font-size: 1.2em;
		}
		a{
			color: #29AECB;
			text-decoration: none;
			border-bottom: solid 1px #eee;
		}
		ul{
			padding: 0;
			margin: 0;
		}
		li{
			list-style-type: none;
			padding: 5px;
			border-bottom: solid 1px #eee;
		}
	</style>
</head>
<body>
	<h1>List User</h1>
	<ul>
	<!-- Each User -->
		<!-- print user.nama, link user.id -->
		'.LCRun3::hbch($cx, 'formatDate', array(array(LCRun3::v($cx, $in, array('date')),'y m d'),array()), 'encq', '$in').'
'.LCRun3::sec($cx, LCRun3::v($cx, $in, array('user')), $in, true, function($cx, $in) {return ''.((!LCRun3::ifvar($cx, LCRun3::v($cx, $in, array('show')))) ? '				<a href="./user/'.LCRun3::encq($cx, LCRun3::v($cx, $in, array('id'))).'"><li>'.LCRun3::hbch($cx, 'json', array(array($in),array()), 'encq', '$in').' </li></a>
' : '				<li>'.LCRun3::encq($cx, LCRun3::v($cx, $in, array('nama'))).'</li>
').'
';}).'
	</ul>
</body>
</html>';
}
?>