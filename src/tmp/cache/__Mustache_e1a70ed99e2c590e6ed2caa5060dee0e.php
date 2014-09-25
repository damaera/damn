<?php

class __Mustache_e1a70ed99e2c590e6ed2caa5060dee0e extends Mustache_Template
{
    protected $strictCallables = true;
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $newContext = array();

        $buffer .= $indent . '<!-- layout file -->
';
        $buffer .= $indent . '<!doctype html>
';
        $buffer .= $indent . '<html>
';
        $buffer .= $indent . '<head><title>';
        $value = $this->resolveValue($context->find('title'), $context, $indent);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '</title></head>
';
        $buffer .= $indent . '<body>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . 'this is layout
';
        $buffer .= $indent . '
';
        $value = $this->resolveValue($context->find('content'), $context, $indent);
        $buffer .= $indent . $value;
        $buffer .= '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}
