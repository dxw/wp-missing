<?php

namespace WPMissing;

class Util {
  static function excerpt($text, $length, $more='…') {

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = wp_trim_words( $text, $length, $more );

    return $text;
  }

  static function strftime($date_string, $format, $else, $tz=null) {
    if ($tz === null) {
      $tz = get_option('timezone_string');
    }

    return \Missing\Date::strftime($date_string, $format, $else, $tz);
  }
}
