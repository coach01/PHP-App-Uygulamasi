<?php
if ($_COOKIE["status"] != "ok")
   header("Location:index.php");
   
include("include/header.php");
$fnameErr = $lnameErr = $titleErr =$phoneErr = $noteErr = "Required";
$fname = $lname = $title = $note = $phone = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"]) && isset($_POST["fname"])) {
    $fnameErr = "First name is required";
  } else {
    $fname = clear($_POST["fname"]);
    if (is_numeric($fname)) {
      $fnameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["lname"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = clear($_POST["lname"]);
    if (is_numeric($lname)) {
      $lnameErr = "Only letters and white space allowed";
    }
  }
  if (empty($_POST["title"])) {
    $titleErr = "Title is required";
  } else {
    $title = clear($_POST["title"]);
    if (is_numeric($title)) {
      $titleErr = "Only letters and white space allowed";
    }
  }
    
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required";
  } else {
    $phone = clear($_POST["phone"]);
    if (!preg_match("/[0-9]/",$phone)) {
      $phoneErr = "Invalid Phone";
    }
  }

  if (empty($_POST["note"])) {
    $note = "";
  } else {
    $note = clear($_POST["note"]);
  }
}

function clear($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<h3>Add Visitor</h3>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="fname">First name: </label><span class="badge badge-danger"><?php echo $fnameErr;?></span>
      <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname;?>">
    </div>
    <div class="form-group">
      <label for="lname">Last name: </label><span class="badge badge-danger"><?php echo $lnameErr;?></span>
      <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname;?>">
    </div>
    <div class="form-group">
      <label for="phone">Phone: </label><span class="badge badge-danger"><?php echo $phoneErr;?></span>
      <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>">
    </div>
    <div class="form-group">
      <label for="title">Title: </label><span class="badge badge-danger"><?php echo $titleErr;?></span>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo $title;?>">
    </div>
    <div class="form-group">
      <label for="note">Note:</label>
      <textarea class="form-control" rows="5" id="note" name="note"><?php echo $note;?></textarea>
    </div>
    <input type="submit" value="Save" class="btn btn-primary">
  </form>



<div class="row mt-3">
  <div class="col">    

<?php
if(!empty($fname) && !empty($lname) && !empty($phone) && !empty($title)){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

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

  $sql = "INSERT INTO visitors (FirstName, LastName, Title, Note)
  VALUES ('$fname', '$lname', '$title', '$note')";

  if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success alert-dismissible fade show'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Success!</strong> New record created
    </div>";
  } else {
    echo "<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Failed!</strong> Couldn't create record
    </div>";
  }
$conn -> close();
}
?>
    </div>
  </div>
<?php include("include/footer.php"); ?>