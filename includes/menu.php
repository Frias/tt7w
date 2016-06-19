<?php
$sql = "SELECT * FROM users WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
$query = mysqli_query($cn, $sql);
$row = mysqli_fetch_assoc($query);
?>
<table width="100%">
	<tr>
		<td align="left">
			<?php echo $lhi; ?><a href="userdetails.php?id=<?php echo $row['id']?>"><?php echo $row['username']?></a>
		</td>
		<td align="right">
			<?php echo $lmessages; ?>
		</td>
		<td align="right">
			<a href="logout.php"><?php echo $llogout; ?></a>
		</td>
	</tr>
</table>
<table width="100%">
	<tr align="center">
		<td>
			<a href="index.php"><?php echo $lhome; ?></a>
		</td>
		<td>
			<a href="profile.php"><?php echo $profile; ?></a>
		</td>
		<td>
			link3
		</td>
	</tr>
</table>
