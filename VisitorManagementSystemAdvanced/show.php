<?php 
if ($_COOKIE["status"] != "ok")
   header("Location:index.php");
include("include/header.php"); 
?>
<h3>All Visitor</h3>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
       <table class="table table-dark table-hover">
        <thead>
          <tr>
<?php 
    $conn = new mysqli("localhost", "root", "", "test");
    $sql = "SELECT * FROM visitors";
    $result = $conn->query($sql);
    //for every table .Table created as automatic
    $fieldinfo = $result -> fetch_fields();
    $colspan = 0;
    foreach ($fieldinfo as $val) {
      echo "<th id=".$val -> name."\">".ucfirst($val -> name) ."</th>";
      $colspan++;
    }
?>
        </tr>
      </thead>
      <tbody>
  <?php 

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo "<tr>";
      foreach ($fieldinfo as $val) {
        echo "<td headers=\"".$val -> name."\">". $row[$val -> name]."</td>";
      }
      echo "</tr>";
    }

  } else {
      echo "<tr><td colspan='".$colspan."'>0 results</td></tr>";
  }
      echo "</tbody></table>";

  $conn -> close();

  ?>
       </tbody>
     </table>
   </div>
  </div>
</div>
<?php include("include/footer.php"); ?>