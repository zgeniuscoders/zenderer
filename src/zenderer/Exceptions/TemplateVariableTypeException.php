<?php

namespace Zgeniuscoders\Zenderer\Zenderer\Exceptions;

class TemplateVariableTypeException extends \Exception
{
    public function __construct($message = "Array variables are not supported for template replacement. Please use scalar variables only.", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
