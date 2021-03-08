<?php
session_start();
error_reporting(0);

if (!isset($_SESSION["basket"])) {
    $_SESSION["basket"] = "0";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $price = clear($_POST["price"]);
  $process = clear($_POST["process"]);
  if(empty($price) || !is_numeric($price)){
    $price = 0;
  }
  calculate($price,$process);
}

function clear($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function calculate($product,$proc) {
$basket = floatval($_SESSION["basket"]);
$product = floatval($product);

switch ($proc) {
    case 'Add':
        $basket += $product;
        break;
     case "Remove":
        $basket -= $product;
        if($basket < 0){
            $basket += $product;
            header("location:".$_SERVER["PHP_SELF"]."?result=$basket&error=Basket cannot be less than zero");
            exit();
        }
        break;    
    default:
           header("location:".$_SERVER["PHP_SELF"]."?result=$basket&error=An unknown error has occurred");
        break;
 }
$_SESSION["basket"] = $basket;
header("location:".$_SERVER["PHP_SELF"]."?result=$basket");
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Price Calculation</title>
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

        input[value="Add"] {
            width: 100%;
            background-color: hsl(120,100%,30%);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[value="Add"]:hover {
                background-color: hsl(120,100%,10%);
        }

        input[value="Remove"] {
            width: 100%;
            background-color: hsl(0,100%,30%);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[value="Remove"]:hover {
                background-color: hsl(0,100%,10%);
        }


        div {
            border-radius: 7px;
            background-color: hsl(0,0%,90%);
            padding: 20px;
            width: 50%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div>
        <h3>Product Price Calculation</h3>
        <form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <label for="price">Price</label>
            <input type="number" id="price" name="price">
            <input type="submit" name="process" value="Add">
            <input type="submit" name="process" value="Remove">
        </form>
        <p id="result">
            <?php if(isset($_GET["result"])) echo "<b>Total = </b>$" .$_GET["result"]; ?>
        </p>
        <p id="error">
            <?php if(isset($_GET["error"])) echo "<strong>Error = </strong>" .$_GET["error"]."!"; ?>
        </p>

    </div>
</body>
</html>
