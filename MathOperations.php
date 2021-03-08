<?php
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fnum = clear($_POST["fnum"]);
  $snum = clear($_POST["snum"]);
  $process = $_POST["process"];
   calculate($fnum,$snum,$process);

}

function clear($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function calculate($x,$y,$pro) {
$x = floatval($x);
$y = floatval($y);
$result = 0;
switch ($pro) {
    case '+':
        $result = $x + $y;
        break;
     case '-':
        $result = $x - $y;
        break;
     case '*':
        $result = $x * $y;
        break;
     case '/':
        if($x == 0 && $y == 0){
            $result = "Warning : Zero divided by zero is uncertain";
        }elseif($y == 0){
            $result = "Warning : Any number divided by zero is undefined";
        }else{
            $result = $x / $y;            
        }
        break;
     case '**':
        if($x == 0 && $y == 0){
            $result =  "Warning : The zeroth power of zero is uncertain";
        }elseif($y < 0){
            $result = "Warning : Negative forces of zero are uncertain";
        }else{
            $result = $x ** $y;            
        }
        break;
    
    default:
        # code...
        break;
 }
header("location:".$_SERVER["PHP_SELF"]."?result=$result");
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Math Operations</title>
    <meta charset="utf-8" />
    <meta name="author" content="AA" />
    <style>
        input[type=number], select {
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
                background-color: #45a049;
            }

        div {
            border-radius: 7px;
            background-color: #f2f2f2;
            padding: 20px;
            width: 50%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div>
        <h3>Math Process</h3>
        <form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="fnum">1.Number</label>
            <input type="number" id="fnum" name="fnum" value="4">

            <label for="snum">2.Number</label>
            <input type="number" id="snum" name="snum" value="3">

            <label for="process">Process</label>
            <select id="process" name="process">
                <option value="+">Addition</option>
                <option value="-">Subtraction</option>
                <option value="*">Multiplication</option>
                <option value="/">Division</option>
                <option value="**">Exponentiation </option>
            </select>

            <input type="submit" value="Calculate">
        </form>
        <p id="result">
            <?php if(isset($_GET["result"])) echo $_GET["result"]; ?>
        </p>
    </div>
</body>
</html>
