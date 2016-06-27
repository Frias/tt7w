<?php
include('includes/db.php');
include('includes/functions.php');
include('includes/checksession.php');
include('includes/config.php');
$pname = $lsessions;
include("includes/top.php");
$sql = "SELECT * FROM sessions WHERE sactive = 1 AND user = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
$query = mysqli_query($cn, $sql);
?>
<table width="100%">
  <tr align="center">
    <td><?php echo $lsid; ?></td>
    <td><?php echo $lsdate; ?></td>
    <td><?php echo $lsip; ?></td>
  </tr>
<?php while ($colum = mysqli_fetch_array($query)) { ?>
  <tr align="center">
    <td>
      <?php echo $colum['sessionid']; ?>
    </td>
    <td>
      <?php echo $colum['stime']; ?>
    </td>
    <td>
      <?php echo $colum['ip']; ?>
    </td>
  </tr>
<?php } ?>
</table>
<?php include("includes/bottom.php"); ?>
