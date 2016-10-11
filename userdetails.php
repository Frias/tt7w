<?php
include('includes/db.php');
include('includes/functions.php');
include('includes/checksession.php');
include('includes/config.php');
$pname = $userdetails." ".$row['username'];
include("includes/top.php"); ?>
<table width="100%">
  <tr align="center">
    <td colspan="2">
    	<p><?php echo $row['username']; ?> <?php echo $row['active']; ?> <img src="includes/icons/flags/<?php echo $row['cflag']; ?>" alt="country" name="<?php echo $row['cname']; ?>" width="16" height="10"><p>
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
