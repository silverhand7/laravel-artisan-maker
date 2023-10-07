<?php

namespace Silverhand7\LaravelArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ActionMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name}';

    protected $description = 'Make an action class';

    protected $type = 'Action';

    protected function getStub(): string
    {
        return __DIR__.'/stubs/boilerplate.stub';
    }

    protected function buildClass($name): string
    {
        $actionName = "{$name}";

        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $actionName)
                    ->replaceClass($stub, $name);
    }

    protected function replaceClass($stub, $name): string
    {
        $actionName = "{$name}";
        $className = Str::replace($this->getNamespace($actionName).'\\', '', $actionName);

        $replace = [
            '{{ className }}' => $className,
        ];

        return str_replace(array_keys($replace), array_values($replace), $stub);
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'].'/'.Str::replace('\\', '/', $name).'.php';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}\\Actions";
    }
}
