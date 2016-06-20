<?php
require_once('includes/db.php');
include('includes/functions.php');
include('includes/config.php');

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
				$rand = random_string('alnum', 32);
				$_SESSION['token'] = $rand;
				$sql = "INSERT INTO `sessions` ( `user` , `token` , `sactive`) VALUES ('".mysqli_real_escape_string($cn,$row['id'])."', '".mysqli_real_escape_string($cn,$rand)."', 1)";
				$query = mysqli_query($cn, $sql);
				header("Location: index.php");
			}
			else {
				$error = $linactivemember;
			}
		}
		else {
			$error = $lloginfailled;
		}
	}
	else {
		$error = $lbothuserpass;
	}
}
$pname = $llogin;
include("includes/top.php");
if(isset($error)){ echo $error;}?>
<table>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<tr><td><?php echo $lusername; ?></td><td><input type="text" id="username" name="username" size="32" value="" /></td></tr>
		<tr><td><?php echo $lpassword; ?></td><td><input type="password" id="password" name="password" size="32" value="" /></td></tr>
		<tr><td><input type="reset" name="Repor" value="<?php echo $lreset; ?>" /></td><td><input type="submit" name="Login" value="<?php echo $llogin; ?>" /></td></tr>
	</form>
</table>
<?php include("includes/bottom.php"); ?>
