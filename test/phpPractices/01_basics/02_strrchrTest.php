<?php

$PATH = "/usr/raghs:/usr/ashwin:/usr/kannan";
$dir = substr(strrchr($PATH, ":"), 1);
echo "Input :: " . $PATH . "<br/>";
echo "Directory :: " . $dir . "<br/>";

$PATH = "ActressMeena.jpg";
$dir = substr(strrchr($PATH, "."), 1);
echo "Input :: " . $PATH . "<br/>";
echo "Directory :: " . $dir . "<br/>";

?>
