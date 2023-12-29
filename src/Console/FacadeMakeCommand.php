<?php

namespace Silverhand7\LaravelArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;

class FacadeMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:facade {name}';

    protected $description = 'Make a facade class';

    protected $type = 'Facade';

    protected function getStub(): string
    {
        return __DIR__.'/stubs/facade.stub';
    }
}
