<?php

use Carbon\Carbon;

if (! function_exists('escape_like')) {
    /**
     * Escape special characters for a LIKE query.
     *
     * @param $string
     * @return string
     */
    function escape_like($string): string
    {
        $search = ['%', '_'];
        $replace = ['\%', '\_'];

        return str_replace($search, $replace, $string);
    }
}
if (! function_exists('get_weekday_name')) {
    /**
     * Escape special characters for a LIKE query.
     *
     * @param $date
     * @return string
     */
    function get_weekday_name($dateString): string
    {
        $date = Carbon::createFromFormat('Y-m-d', $dateString);
        $getName = '';
        $dayFormat = $date->format('D');
        if ($dayFormat == 'Mon') {
            $getName = 'Thứ 2';
        } else if ($dayFormat == 'Tue') {
            $getName = 'Thứ 3';
        } else if ($dayFormat == 'Wed') {
            $getName = 'Thứ 4';
        } else if ($dayFormat == 'Thu') {
            $getName = 'Thứ 5';
        } else if ($dayFormat == 'Fri') {
            $getName = 'Thứ 6';
        } else if ($dayFormat == 'Sat') {
            $getName = 'Thứ 7';
        } else if ($dayFormat == 'Sun') {
            $getName = 'Chủ Nhật';
        }
        return $getName . ', '. 'ngày '. date('d', strtotime($date)) . ' tháng ' . date('m', strtotime($date)) . ' năm ' . date('Y', strtotime($date));
    }
}
