<?php

class __Mustache_6805d6f51ac352d615900bacde6a688a extends Mustache_Template
{
    private $lambdaHelper;
    protected $strictCallables = true;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
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
        $buffer .= $indent . '	<link rel="stylesheet" href="asset/css/style.css">
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '<body>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . 'not found bro
';
        $buffer .= $indent . '
';
        // 'verbatim' section
        $value = $context->find('verbatim');
        $buffer .= $this->sectionF56aea840ba08327ec62e0c90ef21520($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }

    private function sectionF56aea840ba08327ec62e0c90ef21520(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (is_object($value) && is_callable($value)) {
            $source = '
{{angular variabel}}
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
                
                $value = $this->resolveValue($context->find('angular variabel'), $context, $indent);
                $buffer .= $indent . htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
