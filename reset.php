<?php
require_once('includes/db.php');
include('includes/functions.php');

	if(isset($_POST['Submit'])){
		if($_POST['email']!='' && valid_email($_POST['email'])==TRUE){
			$sql = "SELECT id, username, temp_pass, email FROM users WHERE email = '".mysqli_real_escape_string($cn,$_POST['email'])."'";
			$getUser = mysqli_query($cn, $sql);
			if(mysqli_num_rows($getUser)==1){

				$temp_pass = random_string('alnum', 12);
				$row = mysqli_fetch_assoc($getUser);
				$sql = "UPDATE users SET temp_pass='".$temp_pass."', temp_pass_active=1 WHERE `email`='".$row['email']."'";
				$query = mysqli_query($cn, $sql);

				$headers = 	"From: ".$smail."" . "\r\n" .
	    					"Reply-To: ".$smail."" . "\r\n" .
	    					"X-Mailer: PHP/" . phpversion();
				$subject = "Recuperação da password";
				$message = "Caro ".$row['username'].", Pediste a reposição da tua password, colocou-se esta:  $temp_pass . Para confirmar este pedido visita o link: ".$surl."/confirm_password.php?ID=".$row['id']."&new=".$temp_pass.".";


				if(mail($row['email'], $subject, $message, $headers)){
					$msg = 'Password enviada, verifica o e-mail para mais informações';
				}
				else {
					$error = 'Não enviei o e-mail';
				}
			}
			else {
				$error = 'Não existe nenhum membro com esse e-mail.';
			}
		}
		else {
			$error = 'E-mail inválido !';
		}
	}

include("includes/top.php");
if(isset($error)){
		echo $error;
		}
		if(isset($msg)){
			echo $msg;
			}
		else {
		?>
    <table>
    	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<tr><td>E-mail:</td><td><input type="text" id="email" name="email" size="32" value="" /></td></tr>
			<tr><td><input type="reset" name="Reset" value="Repor" /></td><td><input type="submit" name="Submit" value="Submeter" /></td></tr>
		</form>
    </table>
	<?php }
	include("includes/bottom.php"); ?>
