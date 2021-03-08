<?php
error_reporting(0);   
$fname = $lname = $job = $salary = "";
$title = "Create Person Object";

class Employees {
  public $firstName;
  public $lastName;
  public $job;
  public $salary;

  public function __construct($firstName, $lastName,$job) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->job = $job;
  }
  
  public function setSalary($salary){
    if($salary < 0){
        $this->salary = 0;
    }else{
        $this->salary = $salary;
    }
  }

  public function getSalary(){
    return $this->salary;
  }

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = clear($_POST["fname"]);
    $lname = clear($_POST["lname"]);
    $job = clear($_POST["job"]); //as string
    $salary = floatval(clear($_POST["salary"]));//clear and convert to float
  }  

function clear($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8" />
    <meta name="author" content="https://github.com/coach01" />
    <style>
        input[type=text], input[type=number], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: dodgerblue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

            input[type=button]:hover {
                background-color: #4c79a4;
            }

        div {
            border-radius: 7px;
            background-color: #f3f3f3;
            padding: 22px;
            width: 50%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div>
        <h3><?php echo $title; ?></h3>
        <form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <label for="fname">Firstname</label>
            <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>">

            <label for="lname">Lastname</label>
            <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>">

            <label for="job">Job</label>
            <select id="job" name="job">
<?php 
$works = array("Engineer","Programer","Teacher","Architect");//from database as example
for ($i=0; $i < count($works); $i++) { 
    echo "<option value='".$works[$i]."'>".$works[$i]."</option>";
}

?>
            </select>
            <label for="salary">Salary</label>
            <input type="number" id="salary" name="salary" value="<?php echo $salary; ?>">

            <input type="submit"  value="Update">
        </form>
        <hr/>
<?php 

    $newEmployee = new Employees($fname,$lname,$job);
    if(!is_null($newEmployee)){
        $newEmployee->setSalary($salary);
        echo "<p>Firstname : <b>".$newEmployee->firstName."</b></p>";
        echo "<p>Lastname : <b>".$newEmployee->lastName."</b></p>";
        echo "<p>Job : <b>".$newEmployee->job."</b></p>";
        echo "<p>Salary : <b>".$newEmployee->salary."</b></p>";        
    }

    $newEmployee = null;

 ?>

    </div>
</body>
</html>
