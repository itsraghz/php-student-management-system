<?php
  $_SESSION['booleanTrue'] = true;
  $_SESSION['booleanTrueCaps'] = True;
  $_SESSION['booleanTrueExpr'] = (1==1);

  $_SESSION['booleanFalse'] = false;
  $_SESSION['booleanFalseCaps'] = False;
  $_SESSION['booleanFalseExpr'] = (1==2);
?>
<html>
  <head>Boolean Tests in PHP</head>
  <body>
    <p>
      <span style="border: 1px dotted black; background-color: yellow;">
        <b>booleanTrue in Session : </b> <?php var_dump($_SESSION['booleanTrue']); ?> <br/>
        <b>booleanTrueCaps in Session : </b> <?php var_dump($_SESSION['booleanTrueCaps']); ?> <br/>
        <b>booleanTrueExpr in Session : </b> <?php var_dump($_SESSION['booleanTrueExpr']); ?> <br/>
      </span>
      <hr/>
      <span style="border: 1px dotted black; background-color: yellow;">
        <b>booleanFalse var_dump in Session : </b> <?php var_dump($_SESSION['booleanFalse']); ?> <br/>
        <b>booleanFalseCaps var_dump in Session : </b> <?php var_dump($_SESSION['booleanFalseCaps']); ?> <br/>
        <b>booleanFalseExpr var_dump in Session : </b> <?php var_dump($_SESSION['booleanFalseExpr']); ?> <br/>
      </span>
      <hr/>
      <span style="border: 1px dotted black; background-color: yellow;">
        <b>booleanFalse print_r in Session : </b> <?php print_r($_SESSION['booleanFalse']); ?> <br/>
        <b>booleanFalseCaps print_r in Session : </b> <?php print_r($_SESSION['booleanFalseCaps']); ?> <br/>
        <b>booleanFalseExpr print_r in Session : </b> <?php print_r($_SESSION['booleanFalseExpr'], 1); ?> <br/>
      </span>
      <hr/>
      <span style="border: 1px dotted black; background-color: yellow;">
        <b>booleanFalse echo in Session : </b> <?php echo($_SESSION['booleanFalse']); ?> <br/>
        <b>booleanFalseCaps echo in Session : </b> <?php echo($_SESSION['booleanFalseCaps']); ?> <br/>
        <b>booleanFalseExpr echo in Session : </b> <?php echo($_SESSION['booleanFalseExpr']); ?> <br/>
      </span>
    </p>
  </body>
</html>
