<?php
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
