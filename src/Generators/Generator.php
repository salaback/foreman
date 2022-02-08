<?php

namespace Alablaster\Foreman\Generators;

use Illuminate\Support\Facades\File;
use Alablaster\Foreman\Traits\ApplyFilterTrait;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

class Generator
{

    use ApplyFilterTrait;
    use InteractsWithFilesTrait;

    /**
     * @param string $location
     * @param string|null $stubPath
     * @param string|null $stub
     * @param array $properties
     */
    public function __construct(
        protected string $location,
        protected string|null $stubPath = null,
        protected string|null $stub = null,
        protected array $properties = [])
    {}

    public function execute(): void
    {
        $this->loadStub();

        $this->hydrateStub();

        $this->saveFile($this->location, $this->stub);
    }

    /**
     *
     * If the stub is not loaded, check for a stub in the path provided.
     *
     */
    protected function loadStub(): void
    {
        if($this->stub == null && $this->stubPath != null) {
            $this->stub = File::get($this->stubPath);
        }
    }

    /**
     * An internal function to hydrate the stub based on the slot array.
     *
     * @return void
     */
    protected function hydrateStub(): void
    {
        $stub = $this->stub;

        $stub = str_replace(
            '{{ baseNamespace }}',
            config('generators.base-namespace'),
            $stub
        );

        // hydrate dynamically defined slots
        while(strpos($stub,'{{'))
        {
            $start = strpos($stub,'{{') + 2;
            $length = strpos($stub,'}}') - $start;
            $key = substr($stub, $start, $length);

            $replacement = $this->fillPlaceholder($key);

            $stub = str_replace(
                '{{' . $key . '}}',
                $replacement,
                $stub
            );
        }

        $this->stub = $stub;
    }

    /**
     * Takes a stub placeholder and brakes it into both a key and an a default value,
     * then determines ehe replacement value.
     *
     * @param String $key
     * @return string|null
     */
    protected function fillPlaceholder(String $key): ?string
    {
        // Check for if there is a default value, to return if no value is provided.
        // If there isn't a default, set the default to null.
        $keys = explode('||', $key);
        $default = isset($keys[1]) ? $keys[1] : null;

        return $this->makeReplacement($keys[0], $default);
    }

    /**
     * Take the key from the stub and find either a custom slot, or a reference class element,
     * then apply any additional filters to the replacement string
     *
     *
     * @param $key
     * @param string $replacement
     * @return string|null
     */
    protected function makeReplacement($key, $replacement = ''): ?string
    {

        try {
            $keys = explode('.', trim($key));

            // get the primary key and remove from array
            $primaryKey = array_shift($keys);

            // Check for matching custom designed slot
            if(array_key_exists($primaryKey, $this->properties))
            {
                $replacement = $this->properties[$primaryKey];
            }

            // apply any optional filters to the property
            while(count($keys)) {
                $replacement = $this->applyFilter(array_shift($keys), $replacement);
            }
        } catch (\Exception $exception) {
            print "\n\033[33m Error Building " . $this->location;
            print "\n -> " . $exception->getMessage() . "\033[0m";
        } finally {
            return $replacement;
        }
    }


}
