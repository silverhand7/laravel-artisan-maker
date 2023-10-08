<?php

namespace Silverhand7\LaravelArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;

class InterfaceMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:interface {name}';

    protected $description = 'Make an interface contract';

    protected $type = 'Interface';

    protected function getStub(): string
    {
        return __DIR__.'/stubs/interface.stub';
    }
}
