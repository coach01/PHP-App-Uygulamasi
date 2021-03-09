<?php 
if ($_COOKIE["status"] != "ok" && isset($_COOKIE["memberid"])&&isset($_COOKIE["myfriend"]))
   header("Location:login.php");
include("include/header.php"); 
?>
<div class="container mt-3">
  <div class="row" style="height:400px;overflow: auto;">
    <div class="col" id="messageBody">




    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <form action="process.php" method="post">
       <div class="form-group">
        <label for="message"><b>Your Message:</b></label>
        <textarea class="form-control" rows="5" id="message" name="message" oninput="addMessage(this)"></textarea>
       </div>
      <button type="submit" class="btn btn-primary" onkeyup="loadMessage()">Send</button>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  setInterval(loadMessage,1000);
  function loadMessage() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("messageBody").innerHTML = this.responseText;


    }
  };
  xhttp.open("GET", "messageBody.php", true);
  xhttp.send();
}

</script>
<?php include("include/footer.php"); ?>