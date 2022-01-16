<?php
  require_once 'inc/header.php';
  //echo "Login Page";

  $userName = $_POST['userName'];
  $password = $_POST['password'];

  /*echo "<h3>Input Data : </h3>";
  echo "<ul>";
  echo "<li>UserName : " . $userName . "</li>";
  echo "<li>Password : " . $password . "</li>";
  echo "</ul>";*/

  //if(strcmp($userName, "912517114301")==0 && strcmp($password, "912517114301")==0) {
  if(checkUserExists($userName, $password)) {
  //if(strcmp($userName, $password)==0) {
    //echo "Login Successful!";
    $_SESSION['user']=$userName;
    header('Location: home.php');
  } else {
    echo "Login failed!";
    $_SESSION['errMsg']="Invalid Username/Password. Try again!";
    header('Location: index.php');
  }

  function checkUserExists($userId, $password)
	{
	    global $pdo;

	    $isValid = false;
	    $userIdFromDB = '';

		//Not required because we use PreparedStatement bind() method. However sanitize() uses other cleaning as well.
	   // $userId = $this->sanitize($userId);
	   // $password = $this->sanitize($password);

	    //$sql = "SELECT * from TblUser where UserId=:userId and Password=:password";
      $sql = "SELECT Name from TblUser a, TblStudent b where a.UserId=b.RegnNo AND a.UserId=:userId and a.Password=:password";
	    //$sql = "SELECT * from TblMember where UserId=:userId";

	    try
	    {
	        $statement = $pdo->prepare($sql);

	        $statement->bindParam(":userId", $userId);
	       	$statement->bindParam(":password", $password);

	        $statement->execute();

	        //$row = $query->fetch();
          /*
          while (($row = $statement->fetchAll(PDO::FETCH_ASSOC)) !== false) {
              echo $row['UserId'] . '<br>';
              $isValid = true;
          }
          */

          $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

          //print_r($sth->execute());

          foreach($rows as $row) {
              //printf("$row[0] $row[1] $row[2]\n");
              print_r($row);
              //echo $row['UserId'];
              $isValid = true;
              $_SESSION['userName']=$row['Name'];
          }

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

	    return $isValid;
	    //return $userIdFromDB;
	}

  require_once 'inc/footer.php';
?>
