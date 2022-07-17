<?php  

function create($table  ,$createData) {
    global $conn;
    // EXAMPLES
    // $SQL = INSERT INTO users (username , admin , email , password) VALUE (?,?,?)
    // we chhose this -> $SQL = INSERT INTO users SET username?,admin?,email?,password?
    $sql = "INSERT INTO $table SET ";

     // RETURN RESULT THAT MATCH SONDTIONS
     // LOPPING THROUGHT THE ARRAY OF CONDTION
     $i = 0;
     
     foreach($createData as $key => $value) {
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
   
    
    
     $stat = exectureQuery($sql , $createData);
   
     // GETTING ID OF THE INSERTED RECORD
     $id = $stat->insert_id;
     return $id;

    

 }
 