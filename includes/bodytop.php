<body>
<div class="container">
  <div class="header">
	<?php include("banner.php"); ?>
    <!-- end .header --></div>
  <div class="header">
	<?php
  if(isset($_SESSION['user'])){
    include("menu.php");
  }
  else{
    include("menulo.php");
  }
  ?>
  </div>
  <div class="content">
