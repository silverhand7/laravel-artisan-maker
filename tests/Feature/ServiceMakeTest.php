<?php

use Orchestra\Testbench\TestCase;
use Silverhand7\LaravelArtisanMaker\LaravelArtisanMakerServiceProvider;

class ServiceMakeTest extends TestCase
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

    public function test_make_service_command()
    {
        $this->artisan('make:service HelloService');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('Services/HelloService.php'));
    }

    public function test_make_service_command_customized_directory()
    {
        $this->app['config']['artisan-maker.service_directory'] = 'app/CustomServiceDirectory';
        $this->artisan('make:service HelloService');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('CustomServiceDirectory/HelloService.php'));
    }
}