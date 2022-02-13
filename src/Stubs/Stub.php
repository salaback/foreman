<?php

namespace Alablaster\Foreman\Stubs;

use Alablaster\Foreman\Traits\ApplyFilterTrait;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;
use Illuminate\Support\Str;

class Stub
{
    use ApplyFilterTrait;
    use InteractsWithFilesTrait;

    protected string $stub;

    public function __construct(
        protected StubType $type,
        protected array $properties = []
    )
    {
        $this->loadStub();

        if(count($this->properties)) {
            $this->hydrateStub();
        }

    }

    public function get(): string
    {
        return $this->stub;
    }

    public function setStub(string $stub): void
    {
        $this->stub = $stub;
        $this->hydrateStub();
    }

    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }
    protected function hydrateStub()
    {
        $this->stub = str_replace(
            '{{ baseNamespace }}',
            config('foreman.base-namespace'),
            $this->stub
        );

        // hydrate dynamically defined slots
        while(strpos($this->stub,'{{'))
        {
            $start = strpos($this->stub,'{{') + 2;
            $length = strpos($this->stub,'}}') - $start;
            $key = substr($this->stub, $start, $length);

            $replacement = $this->fillPlaceholder($key);

            $this->stub = str_replace(
                '{{' . $key . '}}',
                $replacement,
                $this->stub
            );
        }
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
            print "\n\033[33m Error Building " . Str::title($this->type);
            print "\n -> " . $exception->getMessage() . "\033[0m";
        } finally {
            return $replacement;
        }
    }

    protected function loadStub(): string
    {
        $file = $this->type->value . '.stub';

        if(file_exists(base_path('stubs/'. $file))) {
            return $this->stub = $this->openFile(base_path('stubs/' . $file));
        }

        return $this->stub =  $this->openFile(__DIR__ . '/stubs/' . $file);
    }
}
