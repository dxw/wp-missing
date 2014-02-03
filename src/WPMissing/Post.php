<?php

namespace WPMissing;

class Post {
  function __construct($id) {
    $this->_post = get_post($id);
    $this->id = (int)$this->_post->ID;
  }

  function __get($name) {
    switch ($name) {
      case 'title':
      return $this->_post->post_title;
      break;

      case 'url':
      return get_permalink($this->id);
      break;

      case 'created_at':
      return $this->_post->post_date_gmt;
      break;

      case 'updated_at':
      return $this->_post->post_modified_gmt;
      break;

      case 'html_content':
      global $post;
      $old_post = $post;
      setup_postdata($this->_post);
      $return = get_the_content();
      $post = $old_post;
      return $return;
      break;
    }

    $trace = debug_backtrace();
    trigger_error(sprintf('Undefined property via __get(): %s in %s on line %s'), $name, $trace[0]['file'], $trace[0]['line'], E_USER_ERROR);
    return null;
  }

  function created_at($format, $else, $tz=null) {
    return \WPMissing\Util::strftime($this->created_at, $format, $else, $tz);
  }

  function updated_at($format, $else, $tz=null) {
    return \WPMissing\Util::strftime($this->updated_at, $format, $else, $tz);
  }
}
