<?php
	include('includes/db.php');
	include('includes/functions.php');
	session_start();
	checkLogin('1 2');
  $sql = "SELECT username, regdate, email, active FROM users WHERE id = '".mysqli_real_escape_string($cn,$_GET['id'])."'";
  $query = mysqli_query($cn, $sql);
  $row = mysqli_fetch_assoc($query);
  $username = $row['username'];
  $regdate = $row['regdate'];
  $email = $row['email'];
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
    <table width="100%">
    	<tr align="center">
    		<td colspan="2">
    			<p><?php echo $row['username']; ?> <?php echo $row['active']; ?><p>
    		</td>
    	</tr>
      <tr>
    		<td align="right">
    			<p>Membro desde:<p>
    		</td>
        <td align="left">
    			<p><?php echo $row['regdate']; ?><p>
    		</td>
    	</tr>
      <tr>
    		<td align="right">
    			<p>E-mail:<p>
    		</td>
        <td align="left">
    			<p><?php echo $row['email']; ?><p>
    		</td>
    	</tr>
    </table>
    <!-- end .content --></div>
  <div class="footer">
    <?php include("includes/footer.php"); ?>
    <!-- end .footer --></div>
<!-- end .container --></div>
</body>
</html>
