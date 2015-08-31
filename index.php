<?php

require_once "lib/m/Model.php";



$header = "значительная ШАПКА";
$content = "КАКОЕ-ТО С-О-Д-Е-Р-Ж-И-М-О-Е";
$footer = "тихая шапка";
$title = "ГРОМКИЙ ЗАГОЛОВОК";

$m = new Model();
$m->getTableRows();
$articles = $m->getResult();

if (!is_array($articles)) {
  $content = $m->_error;
} else{
  // разворачиваем массив $articles в подшаблоне
  $content = $m->view_include("v/v_list.tpl", Array( 'articles' => $articles));
}


    // разворачиваем переменную $header в подшаблоне

    // разворачиваем переменную $footer в подшаблоне



// выводим все на экран
echo $m->view_include("v/v_main.tpl", Array( 'header' => $header,'footer' => $footer,'content' => $content, 'title' => $title));


