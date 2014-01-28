<?php

namespace WPMissing;

class Pagination {
  function __construct($query) {
    $this->query = $query;
    $this->paged = ($this->query->get('paged')) ? $this->query->get('paged') : 1;
  }

  // have_*

  function have_previous() {
    return $this->paged > 1;
  }

  function have_next() {
    return $this->paged < $this->query->max_num_pages;
  }

  // uri_*

  function uri_next() {
    return $this->uri_for($this->paged + 1);
  }

  function uri_for($i) {
    return get_pagenum_link($i, false);
  }

  // link_*

  function link_for($i, $text=null) {
    if ($text === null) {
      $text = $i;
    }
    return sprintf('<a href="%s">%s</a>', esc_attr($this->uri_for($i)), esc_html($text));
  }

  function link_previous($text=null) {
    return $this->link_for($this->paged - 1, $text);
  }

  function link_next($text=null) {
    return $this->link_for($this->paged + 1, $text);
  }

  // etc

  function numbers($context, $show_first_last) {
    $numbers = [];
    for ($i = $this->paged - $context; $i <= $this->paged + $context; $i++) {
      if ($i > 0 && $i <= $this->query->max_num_pages) {
        $current = $i === $this->paged;
        $numbers[] = sprintf('<span>%s</span>', $this->link_for($i));
      }
    }

    $first = $last = '';

    if ($show_first_last) {
      if ($this->paged - $context > 1) {
        $first = $this->link_for(1).' … ';
      }
      if ($this->paged + $context < $this->query->max_num_pages) {
        $last = ' … '.$this->link_for($this->query->max_num_pages);
      }
    }

    return $first.implode(' ', $numbers).$last;
  }
}
