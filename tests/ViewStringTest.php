<?php

namespace AdamGaskins\ViewString\Tests;

use AdamGaskins\ViewString\ViewString;
use Illuminate\Support\Facades\Blade;

class ViewStringTest extends TestCase
{
    /**
     * @test
     * @dataProvider viewProvider
     */
    public function it_compiles_blade($string, $data, $expected)
    {
        $this->assertEquals(
            $expected,
            ViewString::compile($string, $data)
        );
    }

    /**
     * @test
     * @dataProvider viewProvider
     */
    public function it_compiles_blade_with_helper($string, $data, $expected)
    {
        $this->assertEquals(
            $expected,
            view_string($string, $data)
        );
    }

    /** @test */
    public function it_compiles_to_php()
    {
        $this->assertEquals(
            'Hello <?php echo e($name); ?>',
            ViewString::compile('Hello {{ $name }}', [ 'name' => 'World' ], false)
        );
    }

    /** @test */
    public function it_compiles_via_blade_directive()
    {
        $this->assertEquals(
            'Hello <?php echo e($name); ?>',
            Blade::compileString('@includeString("Hello @{{ \$name }}", [ "name" => "World" ])')
        );
    }

    public function viewProvider()
    {
        return [
            'html' => [ '<html><body></body></html>', [], '<html><body></body></html>' ],
            'blade' => [ '<html><body>{{ $hello }}</body></html>', [ 'hello' => 'world' ], '<html><body>world</body></html>' ],
            'php' => [ '<?php echo 4 + 4; ?>', [ ], '8' ],
            'condition' => [ '@if($condition)Yes!@endif', [ 'condition' => false ], '' ],
            'directive' => [ '@hello', [], 'world' ],
            'non-existent directive' => [ '@world', [], '@world' ],
        ];
    }
}
