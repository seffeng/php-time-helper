<?php

use PHPUnit\Framework\TestCase;
use Seffeng\TimeHelper\Time;

class TimeTest extends TestCase
{
    public function testGetWeekRangeTime()
    {
        print_r(Time::getWeekRangeTime(2022));
    }

    public function testAsWeekCN()
    {
        var_dump(Time::asWeekCN(time()));
    }

    public function testAsTimestampDiff()
    {
        var_dump(Time::asTimestampDiff(strtotime('2022-01-01'), time()));
    }

    public function testTimeToString()
    {
        var_dump(Time::timeToString(time() - strtotime('2022-01-01')));
    }
}