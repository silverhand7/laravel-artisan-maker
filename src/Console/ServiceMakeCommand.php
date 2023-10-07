<?php

namespace Silverhand7\LaravelArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;

class ServiceMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:service {name}';

    protected $description = 'Make a service class';

    protected $type = 'Service';
}
