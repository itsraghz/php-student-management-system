<?php

  /* Reference: https://www.delftstack.com/howto/php/php-push-associative-array/ */

  $color = array("1" => "Blue", "2" => "Red");
  echo "<pre>", print_r($color) , "</pre>";
  echo "<hr/>";

  echo "<h2>After adding a new element via array_push() method </h2>";
  array_push($color, "3");
  array_push($color, "array_push_item_1", "array_push_item_2");
  echo "<pre>", print_r($color) , "</pre>";
  echo "<hr/>";

  echo "<h2>array_merge() method </h2>";
  $color = array("1" => "Blue", "2" => "Red");
  $color2 = array("3" => "Orange", "4" => "Green");
  $colors = array_merge($color, $color2);
  echo "<pre>", print_r($colors) , "</pre>";
  echo "<hr/>";

  echo "<h2>array_push() method - one at a time</h2>";
  $names = array("Raghavan", "Kannan", "Muthu", "Karthiga", "Karthick");
  $associativeArray1 = array();
  $associativeArray2 = array();
  foreach($names as $key => $val) {
    echo "Key : [$key], Value : [$val] <br/>";
    array_push($associativeArray1, $val);
    $temp_array = array($val => $key);
    //$temp_array = array($key => $val);
    $associativeArray2 = array_merge($associativeArray2, $temp_array);
  }
  echo "<hr/>";
  echo "<pre>", print_r($associativeArray1) , "</pre>";
  echo "<pre>", print_r($associativeArray2) , "</pre>";
  echo "<hr/>";
?>
