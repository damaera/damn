<?php

class __Mustache_7a9fd0cfac42c21ac07a56ed1399ded8 extends Mustache_Template
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
        $buffer .= $indent . '		color: #444;
';
        $buffer .= $indent . '		padding: 100px;
';
        $buffer .= $indent . '		font-size: 1.2em;
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
        $buffer .= $indent . '
';
        $buffer .= $indent . '<h1>This is Damn Framework</h1>
';
        $buffer .= $indent . '<p>Welcome To The Jungle</p>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}