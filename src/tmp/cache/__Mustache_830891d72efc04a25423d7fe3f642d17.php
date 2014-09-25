<?php

class __Mustache_830891d72efc04a25423d7fe3f642d17 extends Mustache_Template
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
        // 'user' section
        $value = $context->find('user');
        $buffer .= $this->sectionC51b939b715d2bc36c81316fc1caf745($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '</table>';

        return $buffer;
    }

    private function sectionC51b939b715d2bc36c81316fc1caf745(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (is_object($value) && is_callable($value)) {
            $source = '
	<tr>
		<td>{{id_user}}</td>
		<td>{{name_user}}</td>
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
                $value = $this->resolveValue($context->find('id_user'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</td>
';
                $buffer .= $indent . '		<td>';
                $value = $this->resolveValue($context->find('name_user'), $context, $indent);
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
