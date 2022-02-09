<?php

namespace Alablaster\Foreman\Exceptions;

use Throwable;

class MissingFileLocation extends \Exception
{
    public function __construct($message = "No valid file location provided.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
