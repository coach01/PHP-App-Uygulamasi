<?php
include("include/header.php");
$emailErr = $userPswdErr = "";
$email = $userPswd = "";
$process = "yes";
$_COOKIE["status"] = "no";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"]) && isset($_POST["email"])) {
    $emailErr = "Email is required";
    $process = "no";
  } else {
    $email = clear($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $process = "no";
    }
  }
  
  if (empty($_POST["password"])) {
    $userPswdErr = "password is required";
    $process = "no";
  } else {
    $userPswd = clear($_POST["password"]);
/*    if (is_numeric($password)) {
      $passwordErr = "Only letters and white space allowed";
    }*/
  }

    if($process = "yes"){
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
    $sql = "SELECT MemberId,FirstName,LastName,Email,Password FROM members";
    $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
          if($row["Email"] == $email && $row["Password"] == $userPswd){
              setcookie("status", "ok",time() + (86400 * 30), "/"); 
              setcookie("memberid",$row['MemberId'] ,time() + (86400 * 30), "/"); 
              setcookie("user",$row['FirstName']." ".$row['LastName'] ,time() + (86400 * 30), "/"); 


              $conn -> close();
              header("Location:myfriends.php");
          }
        }

   }
}

function clear($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<h3>System User</h3>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="email">Email: </label><span class="badge badge-danger"><?php echo $emailErr;?></span>
      <input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>">
    </div>
    <div class="form-group">
      <label for="password">Password: </label><span class="badge badge-danger"><?php echo $userPswdErr;?></span>
      <input type="password" class="form-control" id="password" name="password" value="<?php echo $userPswd;?>">
    </div>
    <input type="submit" value="Login" class="btn btn-primary">
  </form>

<?php include("include/footer.php"); ?>
