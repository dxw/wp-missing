<?php

namespace WPMissing;

class Pagination
{
    public function __construct($query)
    {
        $this->query = $query;
        $this->paged = ($this->query->get('paged')) ? (int) $this->query->get('paged') : 1;
    }

    // have_*

    public function have_previous()
    {
        return $this->paged > 1;
    }

    public function have_next()
    {
        return $this->paged < $this->query->max_num_pages;
    }

    // uri_*

    public function uri_next()
    {
        return $this->uri_for($this->paged + 1);
    }

    public function uri_for($i)
    {
        return get_pagenum_link($i, false);
    }

    // link_*

    public function link_for($i, $text = null)
    {
        $i = (int) $i; // This is neccessary because apparently $i tends to be a double

        if ($text === null) {
            $text = $i;
        }

        $current = ($i === $this->paged) ? ' class="current" ' : '';

        return sprintf('<span %s><a href="%s">%s</a></span>', $current, esc_attr($this->uri_for($i)), esc_html($text));
    }

    public function link_previous($text = null)
    {
        return $this->link_for($this->paged - 1, $text);
    }

    public function link_next($text = null)
    {
        return $this->link_for($this->paged + 1, $text);
    }

    // etc

    public function numbers($context, $show_first_last)
    {
        $numbers = [];

        $min = $this->paged - $context;
        $max = $this->paged + $context;

        if ($min < 1) {
            $x = -$min;
            $max += $x;
            $min += $x;
        }

        if ($max > $this->query->max_num_pages) {
            $x = $this->query->max_num_pages - $max;
            $max += $x;
            $min += $x;
        }

        for ($i = $min; $i <= $max; ++$i) {
            if ($i > 0 && $i <= $this->query->max_num_pages) {
                $numbers[] = $this->link_for($i);
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
