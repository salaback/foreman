<?php

namespace Intellicoreltd\Generators\Contracts;

interface GeneratorsContract
{
    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     */
    public function model(string $location, string $model, string $namespace): void;
}
