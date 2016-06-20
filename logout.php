<?php
include('includes/db.php');
include('includes/functions.php');
include('includes/checksession.php');
$sql = "UPDATE sessions set sactive = 0 WHERE user = '".mysqli_real_escape_string($cn,$_SESSION['user'])."' AND token = '".mysqli_real_escape_string($cn,$_SESSION['token'])."'";
$query = mysqli_query($cn, $sql);
session_destroy(); //destrói as variaveis de sessão
header("location:login.php"); //redireciona para a página de login
?>
