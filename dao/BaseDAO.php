<?php

require_once __DIR__ . '/../util/Util.php';

class BaseDAO {
  public function sanitize($value)
	{
		$util = new Util;
		$value = $util->sanitizeInput($value);

		//add other filterings later , on demand like filter_var() method constants.
		/*
			[26Apr2021] Commented out mysql*_*_escape_string is deprecated and will be removed.
		 https://stackoverflow.com/questions/14012642/what-is-the-pdo-equivalent-of-function-mysql-real-escape-string
		 */
		//$value = mysqli_real_escape_string($value);

		/* Used pdo->quote() method but it doesnt' work as expected. However left it as PDO doesn't really need such,
			but sanitizeInput() method does!
		*/
		/*global $pdo;
		$value = $pdo->quote($value);*/

		return $value;
	}
}
?>
