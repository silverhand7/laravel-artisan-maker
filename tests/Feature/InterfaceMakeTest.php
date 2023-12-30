<?php

use Orchestra\Testbench\TestCase;
use Silverhand7\LaravelArtisanMaker\LaravelArtisanMakerServiceProvider;

class InterfaceMakeTest extends TestCase
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

    public function test_make_interface_command()
    {
        $this->artisan('make:interface HelloInterface');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('Contracts/HelloInterface.php'));
    }

    public function test_make_interface_command_customized_directory()
    {
        $this->app['config']['artisan-maker.interface_directory'] = 'app/CustonInterfaceDirectory';
        $this->artisan('make:interface HelloInterface');
        $this->assertTrue(true);
        $this->assertFileExists(app_path('CustonInterfaceDirectory/HelloInterface.php'));
    }
}