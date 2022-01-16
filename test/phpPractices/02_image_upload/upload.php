<?php
  echo "
    <html><head><title>PHP Form Upload</title></head><body>
    <form method='post' action='upload.php' enctype='multipart/form-data'>
    Select File: <input type='file' name='filename' size='10'/>
    <input type='Submit' name='Upload' value='Upload'/>
    </form>
  ";

  echo '<b>Files Array contains : </b> <br/><pre>' . print_r($_FILES) . '</pre>';

  if($_FILES) {
    $name = $_FILES['filename']['name'];
    echo "<b>Name : </b> " . $name . "<br/>";
    move_uploaded_file($_FILES['filename']['tmp_name'], $name);
    echo "Uploaded Image : '$name' <br/><img src='$name'/>";
    echo "<br/><pre>", print_r($_FILES) , "</pre>";
  }

  echo "</body></html>";
?>
