<?php

  
function deleteFromDb($table , $id , $whereCol = 'id' ) {
    global $conn;
    // EXAMPLES
   
    // we chhose this -> $SQL = "DELETE FROM users WHERE id=?"
    $sql = "DELETE FROM $table WHERE $whereCol=?";
 

     $stat = exectureQuery($sql , [$whereCol => $id ]);
     // dd($stat);
     // RETURNING NUMBER OF THE AFFTECTED ROWS
     return $stat->affected_rows;
 
    
 
 }

 function deleteFromDatabase($tablename , $condection = []) {
    global $conn;
   
  }