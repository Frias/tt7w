<?php
include('includes/db.php');
include('includes/functions.php');

session_start();
checkLogin('1 2');

include('includes/config.php');

include("includes/top.php"); ?>
    <h1>Bem-vindo</h1>
    <p>Esta página vai ser o layout base do &quot;projecto&quot;.</p>
<?php include("includes/bottom.php"); ?>
