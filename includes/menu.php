<?php
$sql = "SELECT * FROM users WHERE id = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
$query = mysqli_query($cn, $sql);
$row = mysqli_fetch_assoc($query);
?>
<table width="100%">
	<tr>
		<td align="left">
			Ola, <a href="userdetails.php?id=<?php echo $row['id']?>"><?php echo $row['username']?></a>
		</td>
		<td align="right">
			Mensagens
		</td>
		<td align="right">
			<a href="logout.php">Sair</a>
		</td>
	</tr>
</table>
<table width="100%">
	<tr align="center">
		<td>
			<a href="index.php">Início</a>
		</td>
		<td>
			link2
		</td>
		<td>
			link3
		</td>
	</tr>
</table>
