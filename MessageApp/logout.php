<?php 
setcookie("status", "", time() - 3600, '/');
setcookie("memberid", "", time() - 3600, '/');
setcookie("user", "", time() - 3600, '/');
header("Location:index.php");

 ?>