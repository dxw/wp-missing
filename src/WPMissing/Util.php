<?php

namespace WPMissing;

class Util {
  static function excerpt($text, $length, $more='') {

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = wp_trim_words( $text, $length, $more );

    return $text;
  }
}
