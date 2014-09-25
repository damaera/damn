<?php

class __Mustache_70b2ab7036da0393f3decfb321137f57 extends Mustache_Template
{
    protected $strictCallables = true;
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $newContext = array();

        $buffer .= $indent . '<!-- index file -->
';
        $buffer .= $indent . '<h1>Hello there, ';
        $value = $this->resolveValue($context->find('name'), $context, $indent);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '!</h1>';

        return $buffer;
    }
}
