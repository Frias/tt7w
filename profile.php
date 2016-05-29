<?php
	include('includes/db.php');
	include('includes/functions.php');
	session_start();
	checkLogin('1 2');
  $sql = "SELECT * FROM users WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
  $query = mysqli_query($cn, $sql);
  $row = mysqli_fetch_assoc($query);

	if(isset($_POST['Alterar'])){
		if(sha1($_POST['password']) == $row['password']){

			if($_POST['password2'] != '' && $_POST['password2'] == $_POST['password3']){
				$sql = "UPDATE users set password = SHA1('".mysqli_real_escape_string($cn,$_POST['password2'])."') WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
				$query = mysqli_query($cn, $sql);
				$pass = "Password Alterada";
			}
			else {
				$pass = 'Password inalterada';
			}
			if($_POST['email'] == $_POST['email2'] && $_POST['email'] != $row['email'] && valid_email($_POST['email']) == TRUE){
				$sql = "UPDATE users set email = '".mysqli_real_escape_string($cn,$_POST['email'])."' WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
				$query = mysqli_query($cn, $sql);
				$mail = "E-mail Alterado";
			}
			else {
				$mail = 'E-mail inalterado';
			}
		}
		else {
			$error = 'Password Actual Errada';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $sname; ?></title>
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
		<?php if(isset($error)){ echo $error;}?>
		<?php if(isset($pass) or isset($mail)){
			echo $pass;
			echo $mail;
		}
		else { ?>
    <table width="100%">
    	<tr align="center"><td colspan="2"><?php echo $row['username']; ?> <?php echo $row['active']; ?></td></tr>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <tr><td align="right">Membro desde:</td><td align="left"><?php echo $row['regdate']; ?></td></tr>
      <tr><td align="right">E-mail:</td><td align="left"><input type="text" id="email" name="email" size="32" value="<?php echo $row['email']; ?>" /></td></tr>
			<tr><td align="right">Confirmar E-mail:</td><td align="left"><input type="text" id="email2" name="email2" size="32" value="<?php echo $row['email']; ?>" /></td></tr>
			<tr><td align="right">Nova Password:</td><td align="left"><input type="password" id="password2" name="password2" size="32" value="" /></td></tr>
			<tr><td align="right">Confirmar nova password:</td><td align="left"><input type="password" id="password3" name="password3" size="32" value="" /></td></tr>
        <tr><td align="right">Password actual:</td><td align="left"><input type="password" id="password" name="password" size="32" value="" /></td><tr>
        <tr><td align="right"><input type="reset" name="Repor" value="Repor" /></td><td><input type="submit" name="Alterar" value="Alterar" /></td></tr>
          </form>
    </table>
		<?php } ?>
    <!-- end .content --></div>
  <div class="footer">
    <?php include("includes/footer.php"); ?>
    <!-- end .footer --></div>
<!-- end .container --></div>
</body>
</html>
