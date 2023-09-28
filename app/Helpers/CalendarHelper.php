<?php

namespace App\Helpers;

class CalendarHelper
{
    public function get_next_month($y, $m)
    {
        $y = intval($y);
        $m = intval($m);

        //***
        $m++;
        if ($m % 13 == 0 or $m > 12) {
            $y++;
            $m = 1;
        }

        return ['y' => $y, 'm' => $m];
    }

    public function get_prev_month($y, $m)
    {
        $y = intval($y);
        $m = intval($m);

        //***
        $m--;
        if ($m <= 0) {
            $y--;
            $m = 12;
        }

        return ['y' => $y, 'm' => $m];
    }
}
