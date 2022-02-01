<?php

namespace Intellicoreltd\Generators\Exceptions;

use Throwable;

class MissingHydrationProperty extends \Exception
{

    public function __construct(string $propertyName)
    {
        $message = "Missing required hydration property: $propertyName";
        parent::__construct($message);
    }
}
