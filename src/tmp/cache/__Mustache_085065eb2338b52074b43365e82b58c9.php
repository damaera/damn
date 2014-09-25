<?php

class __Mustache_085065eb2338b52074b43365e82b58c9 extends Mustache_Template
{
    private $lambdaHelper;
    protected $strictCallables = true;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $newContext = array();

        $buffer .= $indent . 'mnmnmnm
';
        $buffer .= $indent . '
';
        // 'post' section
        $value = $context->find('post');
        $buffer .= $this->section463c1b36a501e45e36944b0a581f2d88($context, $indent, $value);

        return $buffer;
    }

    private function section463c1b36a501e45e36944b0a581f2d88(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (is_object($value) && is_callable($value)) {
            $source = '
	{{id_post}}
';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '	';
                $value = $this->resolveValue($context->find('id_post'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
