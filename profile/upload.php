<?php
  require_once __DIR__ . '/../inc/header.php';

  // Fetch a logger, it will inherit settings from the root logger
  $log = Logger::getLogger('upload.php');

  /*echo '<br/>';
  echo '<b>Files Array contains : </b> <br/>';
  echo '<pre>' . print_r($_FILES) . '</pre>';
  echo '<br/>';*/

  if($_POST['Clear']) {
    unset($_SESSION['fileUploadMsg']);
    unset($_SESSION['TargetFileNameWithExt']);
    unset($_SESSION['uploadedFile']);
    unset($_FILES);
    $_SESSION['canCloseProfileCreationMsg'] = true;
  }

  if($_FILES)
  {
    $name = $_FILES['photo']['name'];
    //echo "name is : " . $name . "<br/>";
    $log->info("name : " . $name);

    $searchedUserName = $_SESSION['searchedUser'];
    //echo "searchedUserName is : " . $searchedUserName . "<br/>";
    $log->info("searchedUserName : " . $searchedUserName);

    $path_parts = pathinfo($name);
    $fileNameWithoutExt = $path_parts['filename'];
    $extension=$path_parts['extension'];

    $TargetFileNameWithExt = $searchedUserName . "." . $extension;

    //echo "fileNameWithoutExt : [" . $fileNameWithoutExt . "] <br/>";
    //echo "extension : [" . $extension . "] <br/>";
    //echo "TargetFileNameWithExt : [" . $TargetFileNameWithExt . "] <br/>";

    $log->info("fileNameWithoutExt : [$fileNameWithoutExt]");
    $log->info("extension : [$extension]");
    $log->info("TargetFileNameWithExt : [$TargetFileNameWithExt]");

    /*echo "DIR is : " . __DIR__ . "<br/>";
    echo "\$_SERVER ['DOCUMENT_ROOT'] is : " .  $_SERVER ["DOCUMENT_ROOT"] . "<br/>";
    echo "dirname(__DIR__) is : " . dirname(__DIR__). "<br/>";
    echo "<b>Name : </b> " . $name . "<br/>";*/

    //move_uploaded_file($_FILES['filename']['tmp_name'], "images/".$name);
    //$target=__DIR__ . "/../../../data/pics/".$name;
    //echo "DOCUMENT_ROOT :: " . DOCUMENT_ROOT . "<br/>";
    //$target = DOCUMENT_ROOT. "/data/pics/".$name;

    $target = dirname(__DIR__) . "/data/pics/" . $TargetFileNameWithExt;
    //echo "Target is : " . $target . "<br/>";
    $log->info("Target : [$target]");
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    //echo "Uploaded Image : '$target' <br/>";
    $log->info("Uploaded Image : [$target]");
    //header('Content-Type: image/jpg');
    //echo "<img src='$target'/>";
    //echo $target;
    //echo "<br/><pre>", print_r($_FILES) , "</pre>";
    $log->info('print_r \$_FILES : ' . print_r($_FILES, 1));

    $_SESSION['fileUploadMsg'] = 'File Uploaded successfully!';
    $_SESSION['TargetFileNameWithExt'] = $TargetFileNameWithExt;
    $_SESSION['uploadedFile'] = $name;
  }

  header('Location: create.php');

  require_once __DIR__ . '/../inc/footer.php';
?>
