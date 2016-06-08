<?php
require_once('includes/db.php');
include('includes/functions.php');

	if(isset($_POST['Login'])){
		if($_POST['username']!='' && $_POST['password']!=''){
			$sql = "SELECT id, username, active FROM users WHERE username = '".mysqli_real_escape_string($cn,$_POST['username'])."' AND password = '".SHA1(mysqli_real_escape_string($cn,$_POST['password']))."'";
			$query = mysqli_query($cn, $sql);

			if(mysqli_num_rows($query) == 1){
				$row = mysqli_fetch_assoc($query);
				if($row['active'] == 1){
					session_start();
					$_SESSION['user'] = $row['id'];
					$_SESSION['logged'] = TRUE;
					header("Location: index.php");
				}
				else {
					$error = 'Membro não ativo';
				}
			}
			else {
				$error = 'Login falhou !';
			}
		}
		else {
			$error = 'Usa ambos, username e password, para aceder';
		}
	}

include("includes/top.php");
if(isset($error)){ echo $error;}?>
    <table>
    	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<tr><td>Username:</td><td><input type="text" id="username" name="username" size="32" value="" /></td></tr>
			<tr><td>Password:</td><td><input type="password" id="password" name="password" size="32" value="" /></td></tr>
			<tr><td><input type="reset" name="Repor" value="Repor" /></td><td><input type="submit" name="Login" value="Login" /></td></tr>
		</form>
    </table>
<?php include("includes/bottom.php"); ?>
