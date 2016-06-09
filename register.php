<?php
require('includes/db.php');
include('includes/functions.php');


if(isset($_POST['register'])){
	if($_POST['username']!='' && $_POST['password']!='' && $_POST['password']==$_POST['password_confirmed'] && $_POST['email']!='' && valid_email($_POST['email']) == TRUE && checkUnique('users','username', $_POST['username']) == TRUE && checkUnique('users','email', $_POST['email']) == TRUE) {
			$rand = random_string('alnum', 32);
			$sql = "INSERT INTO users ( `username` , `regdate` , `password` , `email` , `random_key`) VALUES ('".mysqli_real_escape_string($cn,$_POST['username'])."', CURRENT_TIMESTAMP , SHA1('".mysqli_real_escape_string($cn,$_POST['password'])."'), '".mysqli_real_escape_string($cn,$_POST['email'])."', '".random_string('alnum', 32)."')";
			$query = mysqli_query($cn, $sql) or die(mysqli_error($cn));
			$sql = "SELECT `id` , `username` , `email` , `random_key` FROM `users` WHERE `username` = '".mysqli_real_escape_string($cn,$_POST['username'])."'";
			$getUser = mysqli_query($cn, $sql) or die(mysqli_error($cn));
			if(mysqli_num_rows($getUser)==1) {//by this time it should be 1//
				$row = mysqli_fetch_assoc($getUser);
				$headers = 	"From: ".$smail."" . "\r\n" .
	    					"Reply-To: ".$smail."" . "\r\n" .
	    					"X-Mailer: PHP/" . phpversion();
				$subject = "Email de confirmação";
				$message = "Caro ".$row['username'].", este é o teu link de activação. ".$surl."/confirm.php?ID=".$row['id']."&key=".$row['random_key']." ";
				if(mail($row['email'], $subject, $message, $headers)) {
					$msg = 'Conta criada, verifica o e-mail';
				}
				else {
					$error = 'Criei a conta mas não enviei o e-mail';
				}
			}
			else {
				$error = 'Como não é 1?';
			}

		}
		else {
			$error = 'Algo de errado com o formulario ou o entao e-mail e/ou username já em uso.';
		}
	}

include("includes/top.php");
if(isset($error)){ echo $error;}
if(isset($msg)){ echo $msg;} else { ?>
	<table>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<tr><td>Username: </td><td><input type="text" id="username" name="username" size="32" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" /><br /></td></tr>
		<tr><td>Password: </td><td><input type="password" id="password" name="password" size="32" value="" /><br /></td></tr>
		<tr><td>Re-password: </td><td><input type="password" id="password_confirmed" name="password_confirmed" size="32" value="" /><br /></td></tr>
		<tr><td>Email: </td><td><input type="text" id="email" name="email" size="32" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" /><br /></td></tr>
		<tr><td><input type="reset" name="reset" value="Repor" /><br /></td><td><input type="submit" name="register" value="Registar" /><br /></td></tr>
	</form>
	</table>
	<?php }
	include("includes/bottom.php"); ?>
