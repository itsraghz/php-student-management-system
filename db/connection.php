<?php
	try {
		/*$pdo = new PDO('mysql:host=localhost;dbname=<dbName>', '<userName>','<password>');
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

   		/* Ref : http://php.net/manual/en/ref.pdo-mysql.connection.php */
   		/* Options will have an array to supply any options while obtaining a connection from DB. here we use for UTF-8,
        	to avoid the JSON output being  broken if not the charset beingset to UTF-8 which is the min  requirement for json_encode() */
   	    $options = array(
	        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    );

	    $pdo = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', '<userName>','<password>', $options);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

      //echo "DB Connection succeeded! <br/>";
	}
	catch(PDOException $e) {
		exit('Database error.');
	}
?>
