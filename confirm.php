<?php
require_once('db.php');
include('functions.php');

	if($_GET['ID']!='' && numeric($_GET['ID'])==TRUE && strlen($_GET['key'])==32 && alpha_numeric($_GET['key'])==TRUE){
		$sql = "SELECT id, random_key, active FROM users WHERE id = '".$_GET['ID']."'";
		$query = mysqli_query($cn, $sql);
		if(mysqli_num_rows($query)==1){
			$row = mysqli_fetch_assoc($query);
			if($row['active']==1){
				$error = 'Este membro já tem a conta activa !';
			}
			elseif($row['random_key']!=$_GET['key']){
				$error = 'A chave de confirmação não é valida para este membro !';
			}
			else{
				$sql = "UPDATE users SET active=1 WHERE id='".$row['id']."'";
				$update = mysqli_query($cn, $sql) or die(mysqli_error());
				$msg = 'Sucesso, conta confirmada !';
			}
		}
		else {
		
			$error = 'Utilizador inexistente !';
		
		}

	}
	else {

		$error = 'Não sei o que estás a fazer !';

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
	<?php include("head.php"); ?>
    <!-- end .header --></div>
  <div class="header">
	<?php include("menu.php"); ?>
  </div>
  <div class="content">
	<?php
	if(isset($error)){
		echo $error;
	}
	else {
		echo $msg;
	}
	?>
    <!-- end .content --></div>
  <div class="footer">
    <?php include("footer.php"); ?>
    <!-- end .footer --></div>
<!-- end .container --></div>
</body>
</html>