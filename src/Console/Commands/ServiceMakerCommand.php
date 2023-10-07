<?php

namespace Silverhand7\LaravelArtisanMaker\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ServiceMakerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    protected $description = 'Make a service class';

    protected $type = 'Service';

    protected function getStub(): string
    {
        return __DIR__.'/../../../stubs/service.stub';
    }

    protected function buildClass($name): string
    {
        $serviceName = "{$name}";

        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $serviceName)
                    ->replaceClass($stub, $name);
    }

    protected function replaceClass($stub, $name): string
    {
        $serviceName = "{$name}";
        $className = Str::replace($this->getNamespace($serviceName).'\\', '', $serviceName);

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
        return "{$rootNamespace}\\Services";
    }
}
