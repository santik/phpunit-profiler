<?php

namespace Santik\PhpunitProfiler;

class ProfilingTestListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider timeColor
     */
    public function testEndTest_shouldPrintTimeInCorrectColor($data)
    {

        $test = $this->prophesize(\PHPUnit_Extensions_PhptTestCase::class);
        $test->toString()->willReturn('dummy test name to pad with ' . ProfilingTestListener::NAME_LENGTH . ' characters');

        $time = $data[0];
        $color  = $data[1];

        $listener = new ProfilingTestListener();

        $listener->endTest($test->reveal(), $time);

        $this->expectOutputString("Test 'dummy test name to pad with 50 characters         ' time \033[".$color."m".number_format($time, 3)."\033[0m s." . "\n");
    }

    public function timeColor()
    {
        return [
            [
                [1.6789,
                '0;31']
            ],
            [
                [1.2345,
                '1;33']
            ],
            [
                [0.9876,
                '0;32']
            ],
        ];
    }
}
