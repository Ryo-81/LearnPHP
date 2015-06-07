<?php
$str_ClassPath = dirname(__FILE__) . '/Classes/Counter/ImageCounter.php';
include_once $str_ClassPath;

$c = new ImageCounter();
echo $c -> Get_str_CountImage(8);
