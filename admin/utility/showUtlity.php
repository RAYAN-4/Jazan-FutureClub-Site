<?php  
  
  function showUsers($tablename , $colName , $orderCol) {

    global $conn;
      $user = $_SESSION['userLoggedIn'];
      if (!$user) {
        header('location: ' . $BASE_URL . $redirect );
      }
  $sql = mysqli_query($conn , "SELECT * FROM $tablename WHERE $colName= '$user'  ");
  $row = mysqli_fetch_array($sql);
  $username = $row['user_name'];
  $profile = $row['profile_inc'];
   $role = $row['role'];
  
   $query = mysqli_query($connection , "SELECT * FROM tablename ORDER BY $orderCol DESC");
  
   if (mysqli_num_rows($query) > 0) {
      while($row = mysqli_fetch_array($query) ) {
          $str = "";
          $username = $row['user_name'];
          $useremail = $row['user_email'];
          $userid = $row['user_id'];
          $role = $row['role'];
          if ($role == "Admin") {
              $str = "<tr> " . "<td> $username </td>" . "<td> $useremail </td>" . "<td> <a class='btn btn-danger' href='?duid==$userid'> Delete </a> </td>" . "</tr>";
            
          } else {
             $str = "<tr> " . "<td> $username </td>" . "<td> $useremail </td> .  </tr>";
          }
          echo $str;
      }
   }
  
  
  
    }
    