<?php

namespace AdamGaskins\ViewString\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app)
    {
        $app->make('blade.compiler')->directive('hello', function () {
            return '<?php echo "world"; ?>';
        });
    }
}
