<?php

namespace Santik\PhpunitProfiler;

use PHPUnit_Framework_BaseTestListener;
use PHPUnit_Framework_Test;

class ProfilingTestListener extends PHPUnit_Framework_BaseTestListener
{
    const CRITICAL_TIME = 1.5;
    const WARNING_TIME = 1;

    const NAME_LENGTH = 50;

    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        printf("Test '%s' time %s s.\n",
            str_pad($test->toString(), self::NAME_LENGTH),
            $this->getTimeString($time)
        );
    }

    private function getTimeString($time)
    {
        $spent = number_format($time, 3);

        if ($time > self::CRITICAL_TIME) {
            $fontColor = '0;31'; //red
        } elseif ($time > self::WARNING_TIME) {
            $fontColor = '1;33'; //yellow
        } else {
            $fontColor = '0;32'; //green
        }

        return "\033[" . $fontColor . "m" .$spent . "\033[0m";
    }
}