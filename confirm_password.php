<?php
require_once('includes/db.php');
include('includes/functions.php');

	$sql = "SELECT * FROM users WHERE id = '".mysqli_real_escape_string($cn,$_GET['ID'])."'";
	$query = mysqli_query($cn, $sql);

	if(mysqli_num_rows($query)==1){
		$row = mysqli_fetch_assoc($query);
		if($row['temp_pass']==$_GET['new'] && $row['temp_pass_active']==1){
			$sql = "UPDATE users SET password = '".SHA1(mysqli_real_escape_string($cn,$_GET['new']))."', temp_pass_active=0 WHERE id = '".mysqli_real_escape_string($cn,$_GET['ID'])."'";
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
	<?php include("includes/top.php"); ?>
    <?php
	if(isset($error))
	{
		echo $error;
	}
	else {
		echo $msg;
	}
    ?>
    <?php include("includes/bottom.php"); ?>
