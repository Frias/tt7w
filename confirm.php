<?php
require_once('includes/db.php');
include('includes/functions.php');
include('includes/lang/pt-pt.php');

	if($_GET['ID']!='' && numeric($_GET['ID'])==TRUE && strlen($_GET['key'])==32 && alpha_numeric($_GET['key'])==TRUE){
		$sql = "SELECT id, random_key, active FROM users WHERE id = '".mysqli_real_escape_string($cn,$_GET['ID'])."'";
		$query = mysqli_query($cn, $sql);
		if(mysqli_num_rows($query)==1){
			$row = mysqli_fetch_assoc($query);
			if($row['active']==1){
				$error = $laccalreadyactive;
			}
			elseif($row['random_key']!=$_GET['key']){
				$error = $linvalidkey;
			}
			else{
				$sql = "UPDATE users SET active=1 WHERE id='".$row['id']."'";
				$update = mysqli_query($cn, $sql) or die(mysqli_error());
				$msg = $laccconfirmed;
			}
		}
		else {

			$error = $luserdontexist;

		}

	}
	else {

		$error = $ldunnowhatyoudoin;

	}

include("includes/top.php");

	if(isset($error)){
		echo $error;
	}
	else {
		echo $msg;
	}

include("includes/bottom.php"); ?>
