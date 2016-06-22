<?php
include('includes/db.php');
include('includes/functions.php');
include('includes/checksession.php');
include('includes/config.php');
$sql = "SELECT * FROM users WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
$query = mysqli_query($cn, $sql);
$row = mysqli_fetch_assoc($query);

if(isset($_POST['Alterar'])){
	if(sha1($_POST['password']) == $row['password']){

		if($_POST['password2'] != '' && $_POST['password2'] == $_POST['password3']){
			$sql = "UPDATE users set password = SHA1('".mysqli_real_escape_string($cn,$_POST['password2'])."') WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
			$query = mysqli_query($cn, $sql);
			$pass = $lpasschanged;
		}
		else {
			$pass = $lpassunchanged;
		}
		if($_POST['email'] == $_POST['email2'] && $_POST['email'] != $row['email'] && valid_email($_POST['email']) == TRUE){
			if(checkUnique('users','email', $_POST['email']) == TRUE){
			$sql = "UPDATE users set email = '".mysqli_real_escape_string($cn,$_POST['email'])."' WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
			$query = mysqli_query($cn, $sql);
			$mail = $lmailchanged;
			}
			else {
				$mail = $lmailunchngedx;
			}
		}
		else {
			$mail = $lmailunchnged;
		}
	}
	else {
		$error = $lpasswrong;
	}
}
$pname = $profile;
include("includes/top.php");
if(isset($error)){ echo $error;}
if(isset($pass) or isset($mail)){
	echo '<p>'.$pass.'</p>';
	echo '<p>'.$mail.'</p>';
}
else { ?>
<table width="100%">
	<tr align="center"><td colspan="2"><?php echo $row['username']; ?> <?php echo $row['active']; ?></td></tr>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <tr><td align="right"><?php echo $lmembersince; ?></td><td align="left"><?php echo $row['regdate']; ?></td></tr>
    <tr><td align="right"><?php echo $lmail; ?></td><td align="left"><input type="text" id="email" name="email" size="32" value="<?php echo $row['email']; ?>" /></td></tr>
		<tr><td align="right"><?php echo $lconfnewmail; ?></td><td align="left"><input type="text" id="email2" name="email2" size="32" value="<?php echo $row['email']; ?>" /></td></tr>
		<tr><td align="right">País</td><td align="left"><select name="country">
			<?php
			$sql = "SELECT * FROM countries";
			$query = mysqli_query($cn, $sql);
			while ($colum = mysqli_fetch_array($query)) {
    		echo "<option value='" . $colum['ccode'] ."'>" . $colum['cname'] ."</option>";
			}
			?>
		</select></td></tr>
		<tr><td align="right"><?php echo $lnewpass; ?></td><td align="left"><input type="password" id="password2" name="password2" size="32" value="" /></td></tr>
		<tr><td align="right"><?php echo $lconfnewpass; ?></td><td align="left"><input type="password" id="password3" name="password3" size="32" value="" /></td></tr>
    <tr><td align="right"><?php echo $lactualpass; ?></td><td align="left"><input type="password" id="password" name="password" size="32" value="" /></td><tr>
    <tr><td align="right"><input type="reset" name="Repor" value="<?php echo $lreset; ?>" /></td><td><input type="submit" name="Alterar" value="<?php echo $lchange; ?>" /></td></tr>
  </form>
</table>
<?php }
include("includes/bottom.php"); ?>
