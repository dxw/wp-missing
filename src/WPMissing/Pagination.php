<?php

namespace WPMissing;

class Pagination {
  function __construct($query) {
    $this->query = $query;
    $this->paged = ($this->query->get('paged')) ? $this->query->get('paged') : 1;
  }

  function have_previous() {
    return $this->paged > 1;
  }

  function have_next() {
    return $this->paged < $this->query->max_num_pages;
  }

  function uri_previous() {
    return $this->uri_for($this->paged - 1);
  }

  function uri_next() {
    return $this->uri_for($this->paged + 1);
  }

  function uri_for($i) {
    return get_pagenum_link($i, false);
  }

  function link_previous($text) {
    return sprintf('<a href="%s">%s</a>', $this->uri_previous(), $text);
  }

  function link_next($text) {
    return sprintf('<a href="%s">%s</a>', $this->uri_next(), $text);
  }

  function numbers($context, $show_first, $show_last) {
    return 'todo';
  }
}
