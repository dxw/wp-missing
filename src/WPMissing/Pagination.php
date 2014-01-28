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

  function uri_previous() {
    return $this->uri_for($this->paged - 1);
  }

  function uri_next() {
    return $this->uri_for($this->paged + 1);
  }

  function uri_for($i) {
    return get_pagenum_link($i, false);
  }

  // link_*

  function link_previous($text) {
    return sprintf('<a href="%s">%s</a>', esc_attr($this->uri_previous()), $text);
  }

  function link_next($text) {
    return sprintf('<a href="%s">%s</a>', esc_attr($this->uri_next()), $text);
  }

  // etc

  function numbers($context, $show_first_last) {
    return 'todo';
  }
}
