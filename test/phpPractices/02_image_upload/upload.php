<?php
  echo "
    <html><head><title>PHP Form Upload</title></head><body>
    <form method='post' action='upload.php' enctype='multipart/form-data'>
    Select File: <input type='file' name='filename' size='10'/>
    <input type='Submit' name='Upload' value='Upload'/>
    </form>
  ";

  echo '<br/>';
  echo '<b>Files Array contains : </b> <br/><pre>' . print_r($_FILES) . '</pre>';
  echo '<br/>';

  if($_FILES) {
    $name = $_FILES['filename']['name'];
    echo "DIR is : " . __DIR__ . "<br/>";
    echo "Document Root is : " .  $_SERVER ["DOCUMENT_ROOT"] . "<br/>";
    echo "dirname(__DIR__) is : " . dirname(__DIR__). "<br/>";
    echo "<b>Name : </b> " . $name . "<br/>";
    //move_uploaded_file($_FILES['filename']['tmp_name'], "images/".$name);
    $target=__DIR__ . "/../../../data/pics/".$name;
    $target = $_SERVER ["DOCUMENT_ROOT"] . "/sms" . "/data/pics/".$name;
    echo "Target is : " . $target . "<br/>";
    move_uploaded_file($_FILES['filename']['tmp_name'], $target);
    echo "Uploaded Image : '$name' <br/>";
    echo "<img src='$target'/>";
    echo "<br/><pre>", print_r($_FILES) , "</pre>";
  }

  echo "</body></html>";
?>
