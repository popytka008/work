<?php


class Viewer {


  public function render($template_pathname, $content_array = array())
  {

    foreach ($content_array as $key => $item) {
      $$key = $item;
    }

    ob_start();
    include $template_pathname;
    return ob_get_clean();
  }

  static public function out($str)
  {
    echo $str;
  }


}