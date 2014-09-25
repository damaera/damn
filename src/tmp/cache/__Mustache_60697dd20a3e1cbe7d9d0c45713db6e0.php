<?php

class __Mustache_60697dd20a3e1cbe7d9d0c45713db6e0 extends Mustache_Template
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
        $buffer .= $indent . '<!-- this replaces dispatch\'s content() call -->
';
        $buffer .= $indent . 'ini adalah layout
';
        $buffer .= $indent . 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde ad tenetur, nemo vel. Obcaecati facilis fugit, nisi, assumenda eius debitis deleniti, architecto minima tempora et vero facere, praesentium dolorum eveniet.
';
        $buffer .= $indent . '
';
        $value = $this->resolveValue($context->find('content'), $context, $indent);
        $buffer .= $indent . $value;
        $buffer .= '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}
