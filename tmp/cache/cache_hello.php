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
	return '<div class="jumbo">
	<div class="container">
		<img alt="damn php framework" class="logo" src="data:image/png;base64,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"/>

		<h1 align="center">Damn Framework.</h1>
		<h3 align="center">Welcome To The Jungle.</h3>
		<div style=\'display:"inline-block";text-align: center;\'>
		<a href="https://github.com/damaera/damn" class="download button">View on Github.</a>
		<a href="https://damaera.github.io/damn/#/docs" class="download button">Read The Docs.</a>
		</div>
	</div>
</div>';
}
?>