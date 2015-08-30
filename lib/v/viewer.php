<?php


class Viewer {


  public function view_include($template_pathname, $content_array = array())
  {

    foreach ($content_array as $key => $item) {
      $$key = $item;
    }

    ob_start();
    include $template_pathname;
    return ob_get_clean();
  }
}