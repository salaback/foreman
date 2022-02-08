<?php

namespace Alablaster\Foreman\Exceptions;

use Throwable;

class MissingStubException extends \Exception
{
    public function __construct($message = "Either a stub or a StubPath must be provided.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
