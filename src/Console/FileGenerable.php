<?php

namespace Silverhand7\LaravelArtisanMaker\Console;
use Illuminate\Support\Str;

trait FileGenerable
{
    protected function getStub(): string
    {
        return __DIR__.'/stubs/boilerplate.stub';
    }

    protected function buildClass($name): string
    {
        $typeName = "{$name}";

        $stub = $this->files->get($this->getStub());

        return $this
                ->replaceNamespace($stub, $typeName)
                ->replaceClass($stub, $name);
    }

    protected function replaceClass($stub, $name): string
    {
        $typeName = "{$name}";
        $className = Str::replace($this->getNamespace($typeName).'\\', '', $typeName);

        $replace = [
            '{{ className }}' => $className,
        ];

        return Str::replace(array_keys($replace), array_values($replace), $stub);
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.Str::replace('\\', '/', $name).'.php';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $nameSpace = Str::of($this->type)->plural();

        return "{$rootNamespace}\\{$nameSpace}";
    }
}