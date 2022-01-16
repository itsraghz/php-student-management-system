<?php

  require_once '../inc/header.php';
  require_once '../inc/connection.php';

/* Half way through. Used PhpMyAdmin for an easy way for time being! */
  function insertStudents($users)
	{
	    global $pdo;

	    //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "INSERT INTO TblStudent (RegnNo, Name, DOB, Gender, Department, Year, AadhaarNo, " +
            "FathersName, MothersName, Email, Mobile, Address)" +
            "VALUES (':regnNo', ':name', ':dob', ':gender', ':department', ':year', ':aadhaarNo', " +
            "':fathersName', ':mothersName', ':email', ':mobile', ':address')";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

	    try
	    {
	        $statement = $pdo->prepare($sql);

          foreach($users as $user) {
            //echo $user . "<br/>";
            $statement->bindParam(":regnNo", $user);
   	       	$statement->bindParam(":name", $user);
            $statement->bindParam(":dob", $user);
   	       	$statement->bindParam(":gender", $user);
            $statement->bindParam(":department", $user);
   	       	$statement->bindParam(":year", $user);
            $statement->bindParam(":aadhaarNo", $user);
   	       	$statement->bindParam(":name", $user);
            print_r($statement->execute());
            echo "<i>Inserted <b>$user</b> into the TblUser...</i> <br/>";
          }

	        //

	        //$row = $query->fetch();


          //$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

          //print_r($sth->execute());

        /*  foreach($rows as $row) {
              //printf("$row[0] $row[1] $row[2]\n");
              print_r($row);
              //echo $row['UserId'];
              $isValid = true;
              $_SESSION['userName']=$row['Name'];
          }*/

          /*while($rows!==false) {
            echo $rows['UserId'];
            $isValid = true;
          }*/

	       	//$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	    	//[TODO] Proper way of error handling.
	        echo 'ERROR: ' . $e->getMessage();
	    }

	    //return $isValid;
	    //return $userIdFromDB;
	}

  function insertUsers($users)
	{
	    global $pdo;

	    //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "INSERT INTO TblUser (UserId, Password) VALUES (:userName, :password)";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

	    try
	    {
	        $statement = $pdo->prepare($sql);
          $usersInserted = 0;

          foreach($users as $user) {
            //echo $user . "<br/>";
            $statement->bindParam(":userName", $user);
   	       	$statement->bindParam(":password", $user);
            //print_r($statement->execute());
            $statement->execute();
            $usersInserted++;
            echo "<i>Inserted <b>$user</b> into the TblUser...</i> <br/>";
          }

          echo "<br>Inserted total # $usersInserted users in the TblUser.<br/>";

	        //

	        //$row = $query->fetch();


          //$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

          //print_r($sth->execute());

        /*  foreach($rows as $row) {
              //printf("$row[0] $row[1] $row[2]\n");
              print_r($row);
              //echo $row['UserId'];
              $isValid = true;
              $_SESSION['userName']=$row['Name'];
          }*/

          /*while($rows!==false) {
            echo $rows['UserId'];
            $isValid = true;
          }*/

	       	//$pdo = null;
	    }
	    catch(PDOException $e)
	    {
	    	//[TODO] Proper way of error handling.
	        echo 'ERROR: ' . $e->getMessage();
	    }

	    //return $isValid;
	    //return $userIdFromDB;
	}

?>
  <h1>Bulk User Upload</h1>

  <?php
    $users = array(
      "912518106007",
      "912518106014",
      "912518106018",
      "912518106002",
      "912518106017",
      "912518106015",
      "912518106010",
      "912518106005",
      "912518106016"
    );

    insertUsers($users);
  ?>

<?php

  require_once '../inc/footer.php';

?>
