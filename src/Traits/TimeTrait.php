<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2022 seffeng
 */
namespace Seffeng\TimeHelper\Traits;

Trait TimeTrait
{
    /**
     * 计算某年每周时间范围
     * @author zxf
     * @date   2020年5月21日
     * @param  int $year
     * @return array
     */
    public static function getWeekRangeTime(int $year)
    {
        $time = strtotime(date($year .'-01-01'));
        $weekDay = date('w', $time);
        if ($weekDay == 0) {
            $weekDay = 7;
        }
        $data = [];
        for ($i = 1; ; $i++) {
            $startTime = strtotime('-'. ($weekDay - 1) .' days', $time);
            $endTime = strtotime('+'. (7 - $weekDay) .' days', $time);
            $startYear = date('Y', $startTime);
            if ($startYear > $year) {
                break;
            }
            $data[$i] = [
                'start' => date('Y-m-d', $startTime),
                'end' => date('Y-m-d', $endTime),
            ];
            $time = strtotime('+7 days', $startTime);
            if ($i > 1 && date('Y', $endTime) > $startYear) {
                break;
            }
            $weekDay = date('w', $startTime);
            if ($weekDay == 0) {
                $weekDay = 7;
            }
        }
        return $data;
    }

    /**
     * 整月转换[3-31日上个月为2-28或2-29]
     *
     * @author zxf
     * @date   2024-01-17
     * @param  integer $time
     * @param  integer $value
     * @return integer
     */
    public static function subMonths(int $time, int $value = 1)
    {
        $startTime = strtotime(date('Y-m-01 H:i:s', $time));
        $lastDay = date('d', $time);
        $isLastDay = date('d', $time) === date('t', $time);
        $time = strtotime('-' . $value . ' months', $startTime);
        if ($isLastDay) {
            return strtotime(date('Y-m-t H:i:s', $time));
        } else {
            return strtotime(date('Y-m-' . $lastDay . ' H:i:s', $time));
        }
    }

    /**
     * 整月转换[1-31日下个月为2-28或2-29]
     *
     * @author zxf
     * @date   2024-01-17
     * @param  integer $time
     * @param  integer $value
     * @return integer
     */
    public static function addMonths(int $time, int $value = 1)
    {
        $startTime = strtotime(date('Y-m-01 H:i:s', $time));
        $lastDay = date('d', $time);
        $isLastDay = date('d', $time) === date('t', $time);
        $time = strtotime($value . ' months', $startTime);
        if ($isLastDay) {
            return strtotime(date('Y-m-t H:i:s', $time));
        } else {
            return strtotime(date('Y-m-' . $lastDay . ' H:i:s', $time));
        }
    }

    /**
     * 返回周N
     * @author zxf
     * @date   2020年5月21日
     * @param  int $time
     * @param  string $key
     * @return string
     */
    public static function asWeekCN(int $time, string $key = '周')
    {
        $weekItems = ['日', '一', '二', '三', '四', '五', '六'];
        $week = date('w', $time);
        return $key . $weekItems[$week];
    }

    /**
     * 返回N年X月Y天
     * @author zxf
     * @date    2020年10月15日
     * @param  int $startTime
     * @param  int $endTime
     * @return string|\DateInterval
     */
    public static function asTimestampDiff(int $startTime, int $endTime, string $format = 'Y-m-d', bool $toString = true)
    {
        $startDate = new \DateTime(date($format, $startTime));
        $endDate = new \DateTime(date($format, $endTime));
        $interval = $endDate->diff($startDate);
        $year = $interval->y;
        $month = $interval->m;
        $day = $interval->d;
        $hour = $interval->h;
        $minute = $interval->i;
        $second = $interval->s;

        if ($toString) {
            return ($year > 0 ? ($year . '年') : '') . ($month > 0 ? ($month . '月') : '') . ($day > 0 ? ($day . '天') : '') .
                    ($hour > 0 ? ($hour . '时') : '') . ($minute > 0 ? ($minute . '分') : '') . ($second > 0 ? ($second . '秒') : '');
        }
        return $interval;
    }

    /**
     * 秒转时长
     * @author zxf
     * @date    2020年10月15日
     * @param int $time
     * @param string $format
     * @return string
     */
    public static function timeToString(int $time, string $format = 'Y-m-d H:i:s')
    {
        $startTime = time();
        $endTime = $startTime + $time;
        return self::asTimestampDiff($startTime, $endTime, $format);
    }
}