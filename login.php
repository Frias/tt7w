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
    <table>
    	<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
			<tr><td>Username:</td><td><input type="text" id="username" name="username" size="32" value="" /></td></tr>
			<tr><td>Password:</td><td><input type="password" id="password" name="password" size="32" value="" /></td></tr>
			<tr><td><input type="reset" name="Repor" value="Repor" /></td><td><input type="submit" name="Login" value="Login" /></td></tr>
		</form>
    </table>
    <!-- end .content --></div>
  <div class="footer">
    <?php include("footer.php"); ?>
    <!-- end .footer --></div>
<!-- end .container --></div>
</body>
</html>