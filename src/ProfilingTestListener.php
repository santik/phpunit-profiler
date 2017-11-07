<?php

class ProfilingTestListener extends PHPUnit_Framework_BaseTestListener
{
    const DEFAULT_CRITICAL_TIME = 1.5;
    const DEFAULT_WARNING_TIME = 1;
    const NAME_LENGTH = 50;

    private $criticalTime;

    private $warningTime;

    public function __construct($criticalTime = null, $warningTime = null)
    {
        $this->criticalTime = $criticalTime ? $criticalTime : self::DEFAULT_CRITICAL_TIME;
        $this->warningTime = $warningTime ? $warningTime : self::DEFAULT_WARNING_TIME;
    }


    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        printf("\nTest '%s' time %s s.",
            str_pad($test->toString(), self::NAME_LENGTH),
            $this->getTimeString($time)
        );
    }

    private function getTimeString($time)
    {
        $spent = number_format($time, 3);

        if ($time > $this->criticalTime) {
            $fontColor = '0;31'; //red
        } elseif ($time > $this->warningTime) {
            $fontColor = '1;33'; //yellow
        } else {
            $fontColor = '0;32'; //green
        }

        return "\033[" . $fontColor . "m" .$spent . "\033[0m";
    }
}