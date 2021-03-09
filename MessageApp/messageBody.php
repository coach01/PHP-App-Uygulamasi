<?php 
    $conn = new mysqli("localhost", "root", "", "messageapp");

    $sql = 'SELECT messages.Date,messages.Sender,messages.Receiver,messages.Content,members.FirstName,members.LastName,members.ImagePath FROM messages INNER JOIN members ON messages.Sender = members.MemberID ORDER BY messages.Date DESC';
      if ($result = $conn -> query($sql)) {
       while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        if($row['Sender'] == $_COOKIE['memberid'] && $row['Receiver'] == $_COOKIE['myfriend'] ){
          echo '<div class="media border p-3 mt-3">';
          echo '<img src="memberImage/'.$row['ImagePath'].'" alt="'.$row['FirstName'].' '.$row['LastName'].'" class="mr-3 mt-3 rounded-circle" style="width:56px;">';
          echo '<div class="media-body">';
          echo '<h4>'.$row['FirstName'].' '.$row['LastName'].' <small><i>'.$row['Date'].'</i></small></h4>';
          echo '<p>'.$row['Content'].'</p>';
          echo '</div>';
          echo '</div>';         
        }else if($row['Sender'] == $_COOKIE['myfriend'] && $row['Receiver'] == $_COOKIE['memberid']){
           echo '<div class="media border p-3 mt-3">';
          echo '<img src="memberImage/'.$row['ImagePath'].'" alt="'.$row['FirstName'].' '.$row['LastName'].'" class="mr-3 mt-3 rounded-circle" style="width:56px;">';
          echo '<div class="media-body">';
          echo '<h4>'.$row['FirstName'].' '.$row['LastName'].' <small><i>'.$row['Date'].'</i></small></h4>';
          echo '<p>'.$row['Content'].'</p>';
          echo '</div>';
          echo '</div>';            
        }else{
          
        }


      }
       $result -> free_result();
    }

    $conn->close();
?>