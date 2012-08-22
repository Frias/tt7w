<?php
require_once('includes/db.php');
include('includes/functions.php');

	$sql = "SELECT * FROM users WHERE id = '".$_GET['ID']."'";
	$query = mysqli_query($cn, $sql);

	if(mysqli_num_rows($query)==1){
		$row = mysqli_fetch_assoc($query);
		if($row['temp_pass']==$_GET['new'] && $row['temp_pass_active']==1){
			$sql = "UPDATE users SET password = '".SHA1($_GET['new'])."', temp_pass_active=0 WHERE id = '".$_GET['ID']."'";
			$update = mysqli_query($cn, $sql);
			$msg = 'Password confirmada, já a podes usar';
		}
		else
		{
			$error = 'A password já foi confirmada ou o pedido está incorrecto';
		}
	}
	else {
		$error = 'Estás a tentar confirmar uma passord de um membro que não existe.';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>tt7w</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header">
	<?php include("includes/head.php"); ?>
    <!-- end .header --></div>
  <div class="header">
	<?php include("includes/menu.php"); ?>
  </div>
  <div class="content">
    <?php
	if(isset($error))
	{
		echo $error;
	}
	else {
		echo $msg;
	}
    ?>
    <!-- end .content --></div>
  <div class="footer">
    <?php include("includes/footer.php"); ?>
    <!-- end .footer --></div>
<!-- end .container --></div>
</body>
</html>