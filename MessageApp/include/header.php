<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Message App</title>
  <meta charset="utf-8">
  <meta name="author" content="https://github.com/coach01">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="https://github.com/coach01/">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">

  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">
    <?php 
       if (isset($_COOKIE["user"]) && !empty($_COOKIE["user"])){
        echo urldecode( $_COOKIE["user"]);
      }else{
        echo "Message App";
      }  
      ?>        
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
  <?php  if ($_COOKIE["status"] == "ok"):?>
      <li class="nav-item">
        <a class="nav-link" href="message.php">Messages</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link" href="myfriends.php">My Friends</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Setting</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>    
  <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Login</a>
      </li>
  <?php endif; ?>  
    </ul>
  </div>  
</nav>