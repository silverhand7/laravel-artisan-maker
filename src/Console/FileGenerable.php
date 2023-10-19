<?php

namespace Silverhand7\LaravelArtisanMaker\Console;
use Illuminate\Support\Str;

trait FileGenerable
{
    protected function getStub(): string
    {
        return __DIR__.'/stubs/class.stub';
    }

    protected function buildClass($name): string
    {
        $stub = $this->files->get($this->getStub());

        return $this
                ->replaceNamespace($stub, $name)
                ->replaceClass($stub, $name);
    }

    protected function replaceClass($stub, $name): string
    {
        $className = Str::replace($this->getNamespace($name).'\\', '', $name);

        $replace = [
            '{{ className }}' => $className,
        ];

        return Str::replace(array_keys($replace), array_values($replace), $stub);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $type = Str::lower($this->type);
        $nameSpace = config("artisan-maker.{$type}_namespace");

        return $nameSpace;
    }

    protected function getPath($name)
    {
        $type = Str::lower($this->type);
        return $this->laravel->basePath() . '/' . config("artisan-maker.{$type}_directory") . '/' . $this->getNameInput() .'.php';
    }
}