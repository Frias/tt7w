<?php
	include('includes/db.php');
	include('includes/functions.php');

	session_start();
	checkLogin('1 2');

	include('includes/config.php');
  $sql = "SELECT username, regdate, email, active FROM users WHERE id = '".mysqli_real_escape_string($cn,$_GET['id'])."'";
  $query = mysqli_query($cn, $sql);
  $row = mysqli_fetch_assoc($query);

include("includes/top.php"); ?>

    <table width="100%">
    	<tr align="center">
    		<td colspan="2">
    			<p><?php echo $row['username']; ?> <?php echo $row['active']; ?><p>
    		</td>
    	</tr>
      <tr>
    		<td align="right">
    			<p><?php echo $lmembersince; ?><p>
    		</td>
        <td align="left">
    			<p><?php echo $row['regdate']; ?><p>
    		</td>
    	</tr>
      <tr>
    		<td align="right">
    			<p><?php echo $lmail; ?><p>
    		</td>
        <td align="left">
    			<p><?php echo $row['email']; ?><p>
    		</td>
    	</tr>
    </table>
<?php include("includes/bottom.php"); ?>
