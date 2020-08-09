<?php

$text = "\t\tThese are a few words :) ...  ";
$binary = "\x09Example string\x0A";
$hello  = "Yamaguchi Hofu Miwacho";
var_dump($text, $binary, $hello);

print "\n";

//$trimmed = ltrim($text);
//var_dump($trimmed);
//$trimmed = ltrim($text, " \t.");
//var_dump($trimmed);

$trimmed = ltrim($hello, "Yamaguchi ");
var_dump($trimmed);

// ASCII 制御文字 (0 から 31 まで) を
// $binary の先頭から取り除きます
// $clean = ltrim($binary, "\x00..\x1F");
// var_dump($clean);

?>