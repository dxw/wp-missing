<?php

namespace WPMissing;

class Util
{
    public static function excerpt($text, $length, $more = '…')
    {
        $text = strip_shortcodes($text);

        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = wp_trim_words($text, $length, $more);

        return $text;
    }

    public static function strftime($date_string, $format, $else, $tz = null)
    {
        if ($tz === null) {
            $tz = get_option('timezone_string');

            if (empty($tz)) {
                $tz = 'Etc/UTC';
            }
        }

        return \Missing\Dates::strftime($date_string, $format, $else, $tz);
    }
}
