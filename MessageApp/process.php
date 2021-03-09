<?php
if ($_COOKIE["status"] != "ok")
   header("Location:login.php");

if(!empty($_COOKIE['memberid']) && !empty($_COOKIE['myfriend']) && !empty($_POST['message'])){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "messageapp";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    echo "<div class='alert alert-warning alert-dismissible fade show'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Warning!</strong> Connection error
    </div>";    
    die();
  }

  $sql = "INSERT INTO messages (Sender, Receiver, Content)
  VALUES ('".$_COOKIE['memberid']."', '".$_COOKIE['myfriend']."', '".$_POST['message']."')";

  if ($conn->query($sql) === TRUE) {
    header("Location:message.php");
  } else {
    echo "<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Failed!</strong> Couldn't create record
    </div>";
  }
$conn -> close();
}
?>
