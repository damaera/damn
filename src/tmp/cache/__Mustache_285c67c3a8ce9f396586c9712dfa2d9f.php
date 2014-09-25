<?php

class __Mustache_285c67c3a8ce9f396586c9712dfa2d9f extends Mustache_Template
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
        $buffer .= $indent . '	<title>404, not found</title>
';
        $buffer .= $indent . '	<style>
';
        $buffer .= $indent . '	body{
';
        $buffer .= $indent . '		padding: 60px;
';
        $buffer .= $indent . '	}
';
        $buffer .= $indent . '	</style>
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '<body>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<h1>404 :( </h1>
';
        $buffer .= $indent . '<p>not found</p>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}
