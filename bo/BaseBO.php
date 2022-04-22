<?php
require_once __DIR__ . '/../util/Util.php';

class BaseBO {
  public function sanitize($value)
  {
    $util = new Util;
    $value = $util->sanitizeInput($value);
    //add other filterings later , on demand like filter_var() method constants.
    $value = mysql_escape_string($value);

    return $value;
  }

  public function isValidDate($date)
  {
    if($date===null || strcmp($date, '0000-00-00 00:00:00')==0 || strcmp($date, '0000-00-00')==0) {
      return false;
    }

    return true;
  }
}
?>
