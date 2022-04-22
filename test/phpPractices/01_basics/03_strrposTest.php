<?php

$mystring="Raghavan. alias Saravanan.M";
$charToSearch=".";
$pos = strrpos($mystring, $charToSearch);

echo "Last Index of '$charToSearch' of input '$mystring' : $pos <br/>";

$pos = strpos($mystring, $charToSearch);
echo "First Index of '$charToSearch' of input '$mystring' : $pos <br/>";

?>
