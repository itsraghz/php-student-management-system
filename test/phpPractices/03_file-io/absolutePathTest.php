<?php

function getBaseDir() {
    $loc_pos_2 = strpos($_SERVER['REQUEST_URI'], "/", 1);

    echo "REQUEST_URI :: <i>" . $_SERVER['REQUEST_URI'] . "</i> | ";
    echo "loc_pos_2 -> " . $loc_pos_2 . " | ";

    $baseDir = substr($_SERVER['REQUEST_URI'], 0, $loc_pos_2);

    echo "baseDir : " . $baseDir . "<br/>";

    //$baseDir = $_SERVER['DOCUMENT_ROOT'] . $baseDir;

    return $baseDir;
}

function getDocumentRoot() {
    echo "<b> BaseDir : </b> " . getBaseDir() . "<br/>";

    $docRoot =  getBaseDir();// . '/' . 'sms';

    //$docRoot = getBaseDir2();
    //$docRoot = $_SERVER['DOCUMENT_ROOT'] . '/raghs-nextGen';

    return $docRoot;
}

define('DOCUMENT_ROOT', getDocumentRoot());

function notUsedGetBaseDir2() {
    /* DOES NOT work as it gives the abosulte path in disk :( */

    $DirOfThisFile = dirname(__FILE__);

    $loc = strrpos($DirOfThisFile, "/", 0);

    //echo "<i>Last Index of '/' is :  </i> " . $loc . " | ";

    $baseDir1 = substr($DirOfThisFile, 0, $loc);

    //echo "<i>BaseDir computed : </i> " . $baseDir1 . "<br/>";

    return $baseDir1;
}




function test() {

  echo "__FILE__ : " . __FILE__ . "<br>";
  // output: C:\installedSoft\xampp\htdocs\sms\test\phpPractices\03_file-io\absolutePathTest.php

  echo "DOCUMENT_ROOT : " . DOCUMENT_ROOT. "<br>";

  echo "\$_SERVER['DOCUMENT_ROOT'] : " . $_SERVER['DOCUMENT_ROOT'] . "<br/>";

  echo "__DIR__ : " . __DIR__ . "<br>";
  // output: C:\installedSoft\xampp\htdocs\sms\test\phpPractices\03_file-io

  echo "dirname(__DIR__) : " . dirname(__DIR__) . "<br>" ;
  // output: C:\installedSoft\xampp\htdocs\sms\test\phpPractices

  echo "dirname(__FILE__) : " . dirname(__FILE__) . "<br>" ;;
  // C:\installedSoft\xampp\htdocs\sms\test\phpPractices\03_file-io

  echo "getcwd() : " . getcwd() . "<br>" ;
  //C:\installedSoft\xampp\htdocs\sms\test\phpPractices\03_file-io

  //echo "chroot(".") : " . chroot(".") . "<br>" ;
  //Fatal error: Call to undefined function chroot() in C:\installedSoft\xampp\htdocs\sms\test\phpPractices\03_file-io\absolutePathTest.php on line 17

  // converting the root directory path string into an array
  $path = explode('/', $_SERVER["DOCUMENT_ROOT"]);
  // printing the first element of the root directory path array
  echo $path[0]. "<br>" ;  // output: C:

  echo "realpath('.') : " . realpath(".") . "<br/>";

  //echo "\$_SERVER['PATH_TRANSLATED'] : " . $_SERVER['PATH_TRANSLATED'] . "<br/>";
}

test();
?>
