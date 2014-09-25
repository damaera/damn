<?php

class __Mustache_e6eb9590a53d0ecebecd4a0cc0e329a4 extends Mustache_Template
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
        $buffer .= $indent . '<h1>Damn</h1>
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
