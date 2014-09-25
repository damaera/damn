<?php

class __Mustache_052881c13fc86948f5bd048fc700bae8 extends Mustache_Template
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
        $buffer .= $indent . '<table border="1">
';
        $buffer .= $indent . '	
';
        // 'post' section
        $value = $context->find('post');
        $buffer .= $this->sectionFc27975a3f60f1fa919f87496fa8c2b3($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '</table>';

        return $buffer;
    }

    private function sectionFc27975a3f60f1fa919f87496fa8c2b3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (is_object($value) && is_callable($value)) {
            $source = '
	<tr>
		<td>{{id_post}}</td>
		<td>{{title_post}}</td>
	</tr>
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
                
                $buffer .= $indent . '	<tr>
';
                $buffer .= $indent . '		<td>';
                $value = $this->resolveValue($context->find('id_post'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</td>
';
                $buffer .= $indent . '		<td>';
                $value = $this->resolveValue($context->find('title_post'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</td>
';
                $buffer .= $indent . '	</tr>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
