<?php

use Orchestra\Testbench\TestCase;
use Silverhand7\LaravelArtisanMaker\LaravelArtisanMakerServiceProvider;

class ActionMakeTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelArtisanMakerServiceProvider::class,
        ];
    }

    public function test_make_action_command()
    {
        $this->artisan('make:action HelloAction');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('Actions/HelloAction.php'));
    }

    public function test_make_action_command_customized_directory()
    {
        $this->app['config']['artisan-maker.action_directory'] = 'app/CustomActionDirectory';
        $this->artisan('make:action HelloAction');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('CustomActionDirectory/HelloAction.php'));
    }
}