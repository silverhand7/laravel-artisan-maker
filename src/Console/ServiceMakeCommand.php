<?php

namespace Silverhand7\LaravelArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ServiceMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:service {name} {--interface=} {--i=}';

    protected $description = 'Make a service class';

    protected $type = 'Service';

    protected function getClassImplementInterfaceStub(): string
    {
        return __DIR__.'/stubs/class-implement-interface.stub';
    }

    protected function buildClass($name): string
    {
        if ($this->option('interface') || $this->option('i')) {
            $interfaceName = $this->option('interface') ?? $this->option('i');
            $interfaceUseNamespace = config('artisan-maker.interface_namespace') . '\\' . $interfaceName;

            $stub = $this->files->get($this->getClassImplementInterfaceStub());

            return $this
                ->replaceInterfaceUseClass($stub, $interfaceUseNamespace)
                ->replaceInterfaceClass($stub, $interfaceName)
                ->replaceNamespace($stub, $name)
                ->replaceClass($stub, $name);
        }

        $stub = $this->files->get($this->getStub());

        return $this
                ->replaceNamespace($stub, $name)
                ->replaceClass($stub, $name);
    }

    protected function replaceInterfaceClass(&$stub, $interfaceName)
    {
        $stub = Str::replace("{{ interfaceName }}", $interfaceName, $stub);
        return $this;
    }

    protected function replaceInterfaceUseClass(&$stub, $interfaceUseNamespace)
    {
        $stub = Str::replace("{{ interfaceUseNamespace }}", $interfaceUseNamespace, $stub);
        return $this;
    }
}
