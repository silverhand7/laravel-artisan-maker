<?php

namespace Silverhand7\LaravelArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ServiceMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:service {name} {--i|interface=}';

    protected $description = 'Make a service class';

    protected $type = 'Service';

    protected function getClassImplementInterfaceStub(): string
    {
        return __DIR__.'/stubs/class-implement-interface.stub';
    }

    protected function buildClass($name): string
    {
        if ($interfaceName = $this->option('interface')) {
            $interfaceUseNamespace = config('artisan-maker.interface_namespace') . '\\' . $interfaceName;

            if (!$this->checkInterfaceExists($interfaceUseNamespace)) {
                if ($this->confirm("The {$interfaceName} does not exist in " . config('artisan-maker.interface_namespace') . ", do you want to create one?", true)) {
                    Artisan::call('make:interface', [
                        'name' => $interfaceName
                    ]);
                }
            }


            $stub = $this->files->get($this->getClassImplementInterfaceStub());

            return $this
                    ->replaceInterfaceUseNamespace($stub, $interfaceUseNamespace)
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

    protected function replaceInterfaceUseNamespace(&$stub, $interfaceUseNamespace)
    {
        $stub = Str::replace("{{ interfaceUseNamespace }}", $interfaceUseNamespace, $stub);
        return $this;
    }

    protected function checkInterfaceExists($interfaceUseNamespace): bool
    {
        $paths = explode('\\', $interfaceUseNamespace);
        array_shift($paths);
        return file_exists($this->laravel['path'] . '/' . implode('/', $paths) . '.php');
    }
}
