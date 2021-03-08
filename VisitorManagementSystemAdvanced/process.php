<?php 
setcookie("status", "", time() - 3600, '/');
header("Location:index.php");

 ?>