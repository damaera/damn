<?php

class __Mustache_8c467923d21ebe05b4c99e29cdf2025c extends Mustache_Template
{
    protected $strictCallables = true;
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $newContext = array();

        $buffer .= $indent . '<!DOCTYPE html>
';
        $buffer .= $indent . '<html>
';
        $buffer .= $indent . '<head>
';
        $buffer .= $indent . '	<title>Damn Framework</title>
';
        $buffer .= $indent . '	<style>
';
        $buffer .= $indent . '	
';
        $buffer .= $indent . '	body{
';
        $buffer .= $indent . '		font-family: sans-serif;
';
        $buffer .= $indent . '		color: #555;
';
        $buffer .= $indent . '		padding: 100px;
';
        $buffer .= $indent . '	}
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '	</style>
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '<body>
';
        $buffer .= $indent . '<h1>Hello :D</h1>
';
        $buffer .= $indent . '<p>Welcome to the Jungle</p>
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}
