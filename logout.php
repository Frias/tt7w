<?php
session_start(); //inicia as variaveis de sessão
session_destroy(); //destrói as variaveis de sessão
header("location:login.php"); //redireciona para a página de login
?>