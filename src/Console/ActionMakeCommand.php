<?php

namespace Silverhand7\LaravelArtisanMaker\Console;

use Illuminate\Console\GeneratorCommand;

class ActionMakeCommand extends GeneratorCommand
{
    use FileGenerable;

    protected $signature = 'make:action {name}';

    protected $description = 'Make an action class';

    protected $type = 'Action';
}
