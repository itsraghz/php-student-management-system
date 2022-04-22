<?php

// Reference: https://stackoverflow.com/questions/2183486/php-get-file-name-without-file-extension
// Direct link : https://stackoverflow.com/a/2183512/1001242

function getParts($fileName)
{
  $path_parts = pathinfo($fileName);

  echo "<b>Input : </b>" . $fileName . "<br/>";

  echo "\$path_parts['dirname'] : " . $path_parts['dirname'], "<br/>";
  echo "\$path_parts['basename'] : " .  $path_parts['basename'],  "<br/>";
  echo "\$path_parts['extension'] : " .  $path_parts['extension'],  "<br/>";
  echo "\$path_parts['filename'] : " .  $path_parts['filename'],  "<br/>";

  echo "----------------- <br/>";
}

getParts('/www/htdocs/inc/lib.inc.php');
getParts('ActressMeena.jpg');
getParts('WhatsApp Image 2021-08-19 at 08.17.40 (2).jpeg');

?>
