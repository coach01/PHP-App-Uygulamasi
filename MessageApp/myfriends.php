<?php 
if ($_COOKIE["status"] != "ok")
   header("Location:index.php");
include("include/header.php"); 
?>
<div class="container mt-3">

<?php 
    $conn = new mysqli("localhost", "root", "", "messageapp");
    $sql = "SELECT MemberID,FriendID FROM friends WHERE MemberID=".$_COOKIE['memberid'];
    $result = $conn->query($sql);
    $friends = $result->fetch_all(MYSQLI_NUM);

    for ($i=0; $i < count($friends); $i++) { 
      $sql = "SELECT MemberID,FirstName, LastName, ImagePath FROM members WHERE MemberID=".$friends[$i][1];
      if ($result = $conn -> query($sql)) {
       while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
         //print_r($row);
         echo  '<div class="row mt-3" style="cursor:pointer;border-bottom:1px solid gray;" onclick="showMessage('.$row['MemberID'].')">';
         echo '<div class="col-12">';
         echo '<img src="memberImage/'.$row['ImagePath'].'" alt="'.$row['FirstName']." ".$row['LastName'].'" class="rounded-circle float-right" style="width:40px;">';

         echo '<p>'.$row['FirstName']." ".$row['LastName'].'</p>';
         echo '</div>';     
         echo '</div>'; 
        }
       $result -> free_result();
      }


    }

?>
<div class="row mt-3">
  <div class="col-12">
    <h2>Add Friend</h2>
  </div>
</div>
</div>
<script type="text/javascript">
  function addFriend(txt) {
    // body...
  }

  function showMessage(txt) {
  var d = new Date();
  d.setTime(d.getTime() + (30*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = "myfriend=" + txt + ";" + expires + ";path=/";
  window.location.assign("message.php");
  }
</script>
<?php include("include/footer.php"); ?>