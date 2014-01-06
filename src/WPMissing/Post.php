<?php

namespace WPMissing;

class Post {
  function __construct($id) {
    $this->_post = get_post($id);
    $this->id = (int)$this->_post->ID;
  }

  function __get($name) {
    switch ($name) {
      case 'id':
      return $this->id;
      break;

      case 'title':
      return get_the_title($this->id);
      break;

      case 'html_content':
      global $post;
      $old_post = $post;
      setup_postdata(get_post($this->_post));
      $return = get_the_content();
      $post = $old_post;
      return $return;
      break;
    }

    return null;
  }
}
