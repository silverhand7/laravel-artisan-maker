<?php

use Orchestra\Testbench\TestCase;
use Silverhand7\LaravelArtisanMaker\LaravelArtisanMakerServiceProvider;

class FacadeMakeTest extends TestCase
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

    public function test_make_facade_command()
    {
        $this->artisan('make:facade HelloFacade');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('Facades/HelloFacade.php'));
    }

    public function test_make_facade_command_customized_directory()
    {
        $this->app['config']['artisan-maker.facade_directory'] = 'app/CustomFacadesDirectory';
        $this->artisan('make:facade HelloFacade');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('CustomFacadesDirectory/HelloFacade.php'));
    }
}