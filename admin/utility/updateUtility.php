<?php

   
 function update($table , $id , $updateData , $whereCol = 'user_id') {
    global $conn;
    // EXAMPLES
   
    // we chhose this -> $SQL = UPDATE users SET username?,admin?,email?,password? WHERE id=?
    $sql = "UPDATE $table SET ";
 
     // RETURN RESULT THAT MATCH SONDTIONS
     // LOPPING THROUGHT THE ARRAY OF CONDTION
     $i = 0;
     foreach($updateData as $key => $value) {
       // ONLY IF INDEX 0 WE PREFORM THIS QUERY
       if ($i === 0) {
   // HERE WE SAY SELLECT * FROM $tabel WHERE KEY IN CASE ADMIN = VALUE IN CASE 1
     $sql = $sql . " $key=?";
       } 
       else {
        $sql = $sql . ", $key=?";
       }
       $i++;
       
     }
 
     $sql = $sql . " WHERE $whereCol=?";
  
     $updateData['id'] = $id;

     $stat = exectureQuery($sql , $updateData);
     // dd($stat);
     
     return $stat->affected_rows;
 
    
 
 }

 function updateUserPassword($colPassword , $tablename , $whereCol) {
    $oldPwd = $_POST['oldPwd'];
    $newPwd = $_POST['pwd'];
    $email = $_SESSION['userLoggedIn'];
    $query = mysqli_query($connection ,  "SELECT $colPassword FROM $tablename WHERE $whereCol = '$email' ") ;
    $data = mysqli_fetch_array($query);
    $pwdfromdb = $data['user_password'];
    $hashPws = md5($oldPwd);
    if ($pwdfromdb == $hashPws ) {
        $newHashPwd = md5($newPwd);
        $query = mysqli_query($connection,  " UPDATE $tablename SET $colPassword = '$newHashPwd' WHERE $whereCol = '$email' ");
        // CHECKI QUERY
        if ($query) {
          //  header("Location: profile.php?password_updated ");
        }
    }
  }

  