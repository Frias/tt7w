<?php
if(isset($_SESSION['user'])){
  $sql = "SELECT * FROM `users`, `langs`, `styles`, `countries` WHERE `country` = `ccode` AND `lang` = `lid` AND `style` = `sname` AND `id` = '".mysqli_real_escape_string($cn,$_SESSION['user'])."'";
  $query = mysqli_query($cn, $sql);
  $row = mysqli_fetch_assoc($query);
  $style = "includes/styles/".$row['sfile'];
  $lang = "includes/lang/".$row['lfile'];
  include($lang);
}
else {
  $style = "includes/styles/default.css";
  include('includes/lang/pt-PT.php');
}
?>
