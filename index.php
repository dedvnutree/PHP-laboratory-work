<?php

#require 'vendor/autoload.php';
include 'geometry.php';

$T1 = new Point(1,10);
$V1 = new Vector(1,5);
$V2 = new Vector(0, 0);
$V3 = new Vector(-5, 1);
echo $V1-> GetLenght() .'<br>';
echo $V2 -> GetLenght() .'<br>';
echo $V3 -> GetLenght() .'<br>';

var_dump ($V1  -> PerpendicularWith($V3));
echo '<br>';

$T1 = $T1 -> ChangeX(($V1 -> X) + ($T1 -> X)) -> ChangeY(($V1 -> Y) + ($T1 -> Y));
var_dump($T1);