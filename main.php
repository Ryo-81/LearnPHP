<?php
include_once './Classes/Counter/Counter.php';
include_once './Classes/Counter/ImageCounter.php';

$c = new ImageCounter();
// echo $c -> Get_int_Count();
echo $c -> Get_HTMLTag_CountImage();
