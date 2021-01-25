<?php

namespace AdamGaskins\ViewString\Tests;

use AdamGaskins\ViewString\ViewString;

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
