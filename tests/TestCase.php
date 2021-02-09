<?php

namespace AdamGaskins\ViewString\Tests;

use AdamGaskins\ViewString\ViewStringServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ViewStringServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app->make('blade.compiler')->directive('hello', function () {
            return '<?php echo "world"; ?>';
        });
    }
}
