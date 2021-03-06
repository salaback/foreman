<?php

namespace Alablaster\Foreman\Locations;

use Illuminate\Support\Str;

abstract class Location
{

    public bool $inWrapper = true;

    public function __construct(
        protected string $model,
        protected ?string $namespace = null,
        protected ?string $domain = null)
    {}

    abstract protected function fileName(): string;

    public function run(): string
    {

        $location = $this->srcPath();

        $location .= $this->fileName();

        return $location;
    }

    protected function namespaceToDirectory($namespace): string
    {
        return str_replace("\\", "/", $namespace);
    }

    protected function srcPath(): string
    {
        $location = $this->inWrapper ? config('foreman.wrapper') . '/' : '';

        if($this->domain) {
            $location .= $this->domain . '/';
        }

        $location .= $this->getPath() ? $this->getPath() . '/' : null;

        $location .= $this->namespace ? $this->namespaceToDirectory($this->namespace) . '/' : null;

        return base_path($location);
    }

    abstract protected function getPath(): ?string;

}
