<?php

  
function selectAll($tablename , $condection = [] , $limitStatus = false , $limit = '1' , $orderStatus = false , $orderBy = 'id' , $orderWith = 'DESC' ) {
    global $conn;
   
    $sql = "SELECT * FROM $tablename";
  
    if (empty($condection)) {
     
      if ($orderStatus) {
    $sql = $sql . " ORDER BY $orderBy $orderWith";
      }
      if ($limitStatus) {
        $sql = $sql . " LIMIT $limit";
      }

     
      $stat = $conn->prepare($sql);
      $stat->execute();
      $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
    } else {
      // IF ARGUMENTS PROVIDED
      $i = 0;
      foreach($condection as $key => $value) {
      if ($i === 0) {
        $sql = $sql . " WHERE $key=?";
      } else {
        $sql = $sql . " AND $key=?";
      }
        $i++;
      }
     ;
     if ($limitStatus) {
        $sql = $sql . " LIMIT $limit";
     }
     if ($orderStatus) {
      $sql = $sql . " ORDER BY $orderBy $orderWith";
        }
    
        // EXECTING QUERY
       $stat = exectureQuery($sql , $condection);
   $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
  }

  // $selected = selectAll("posts" );
  // dd($selected);

   function selectQueryTable($tablename , $condection = [] ) {
     global $conn;

     // MAIN SQL 
     $sql = "SELECT * FROM $tablename";
     if (empty($condection)) {
      $sql = "SELECT * FROM $tablename";
    } else {
      // LOOPING THROUGHT THE CONECTIONS
      
      $i = 0;
   
      
      foreach($condection as $key => $value) {
        
       if ($key === 'order' OR $key ==='orderBy' OR $key === 'limit' OR $key === 'WHERE'  OR $key === 'min'  OR $key === 'max' OR $key === 'selection' OR $key === 'null' OR $key === 'within'  OR $key === 'without' OR $key === 'whereaslike' OR $key === 'whereasnotlike' OR $key === 'between' ) {
         $typedArray = gettype($value);
        
          if ($key === 'null') {
           
            if ($value === 'false') {
              $value = "";
              $key = "IS NOT NULL";
            } else {
              $value = "";
              $key = "IS NULL";
            }
           
          }
           if ($key === 'between') {
             $key = "";
             $betweekd = 0;
             foreach($value as $betweenkey => $betweenval) {

              if ($betweekd === 0) {
              
               $sql = $sql . "WHERE $betweenkey BETWEEN ";
               $calcVal = implode(" AND " , $betweenval);
               $sql = $sql  . $calcVal;
                
        
              } else {
                $sql = $sql . " AND $betweenkey BETWEEN ";
                $calcVal = implode(" AND " , $betweenval);
                $sql = $sql  . $calcVal;
              }
              $betweekd++;
             }
             $value = "";
           }
          if ( $key === 'whereasnotlike') {
            $key = "";
            $withasliked = 0;
            
            foreach($value as $withaslikekey => $withaslikeval) {
              if ($withasliked === 0) {
                $sql = $sql . "WHERE ";
                $sql = $sql . $withaslikekey;
                $sql = $sql . " NOT LIKE ";
                $sql = $sql . $withaslikeval;
              } else {
                $sql = $sql . " AND ";
                $sql = $sql . "WHERE ";
                $sql = $sql . $withaslikekey;
                $sql = $sql . " NOT LIKE ";
                $sql = $sql . $withaslikeval;
              }
            
            
              $withasliked++;
            }
            $value = "";
          }

          if ($key === 'within' ) {
         $key = "";
        
         $withd = 0;
         $sql = $sql . "IN (";
         
         foreach($value as $withinkey => $withinval ) {
          $withinMatchVal = $withinval;
         
         
          if ($withinkey === array_key_last($value)) {
            
            $quote = "";
            $sql = $sql .  " $withinval$quote ";
        } else {
          $quote = ",";
          $sql = $sql .  " $withinval$quote ";
        }

        
          $withd++;
          $quote = "";
         }
         $sql = $sql . ")";
         $value = "";
          }

          if ($key === 'without' ) {
         $key = "";
        
         $withd = 0;
         $sql = $sql . "NOT IN (";
       
         
         foreach($value as $withinkey => $withinval ) {
          $withinMatchVal = $withinval;
         
         
          if ($withinkey === array_key_last($value)) {
            
            $quote = "";
            $sql = $sql .  " $withinval$quote ";
        } else {
          $quote = ",";
          $sql = $sql .  " $withinval$quote ";
        }

        
          $withd++;
          $quote = "";
         }
         $sql = $sql . ")";
         $value = "";
          }

          if ( $key === 'whereaslike') {
            $key = "";
            $withasliked = 0;
            
            foreach($value as $withaslikekey => $withaslikeval) {
              if ($withasliked === 0) {
                $sql = $sql . "WHERE ";
                $sql = $sql . $withaslikekey;
                $sql = $sql . " LIKE ";
                $sql = $sql . $withaslikeval;
              } else {
                $sql = $sql . " AND ";
                $sql = $sql . "WHERE ";
                $sql = $sql . $withaslikekey;
                $sql = $sql . " LIKE ";
                $sql = $sql . $withaslikeval;
              }
            
            
              $withasliked++;
            }
            $value = "";
            
          }
          
          
         if ($typedArray === 'string') {
         
        if ($key === 'orderBy')  {
          
          $value = "";
        }
         }
      
        if ($key === 'limit') {
          $key = strtoupper($key);
        }
     
      
       
        
        if ( $key === 'WHERE'  ) {
          $newVal = http_build_query($value );
        } else {
          $newVal = $value;
        }
       
       
        if ($key === 'order' ) {
          $key = "ORDER BY " . 'id' ;
        }
        if ($key === 'orderBy') {
        
          $key = "";

        }
        if ($key === 'min') {
          $key = "MIN";
          $d = 0;
          foreach($value as $x => $x_val) {
             
             
           $newVal = "($x) AS $x_val ";

           $sql = $sql . " $key$newVal";
          
            $d++;
          }
         
        }
        if ($key === 'max') {
          $key = "MAX";
          $d = 0;
          foreach($value as $x => $x_val) {
             
             
           $newVal = "($x) AS $x_val ";
           $sql = $sql . " $key$newVal";
            $d++;
          }
         
        }

       
       $sql = $sql . " $key $newVal";
       
        
          $i++;
       } else {
       
       die("SORRY WRONG ARGUEMNTS");
       }
        
         
    
      }
      dd($sql);
    }
     // HANDLEING CONECTIONS
   } 



function selectOne($table , $conditions) {
    global $conn;
    $sql = "SELECT * FROM $table";
   
    
      // RETURN RESULT THAT MATCH SONDTIONS
     // LOPPING THROUGHT THE ARRAY OF CONDTION
     $i = 0;
     foreach($conditions as $key => $value) {
       // ONLY IF INDEX 0 WE PREFORM THIS QUERY
       if ($i === 0) {
   // HERE WE SAY SELLECT * FROM $tabel WHERE KEY IN CASE ADMIN = VALUE IN CASE 1
     $sql = $sql . " WHERE $key=?";
       } 
       else {
         $sql = $sql . " AND $key=?";
       }
       $i++;
       
     }
     // LINITING QUERY FOR ONLY 1 RESULT
     $sql = $sql . " LIMIT 1";
     
     // EXECTING QUERY
     $stat = exectureQuery($sql , $conditions);
     // FETCHING ONE
     $records = $stat->get_result()->fetch_assoc();
     return $records;
    
    
  }
  
  // SEARCING FOR POSTS PUBLISHED AND USER WHO PUBLISHED IT
  function getPublishedPosts() {
    global $conn;
  
    // SELECT * FROM posts WHERE published
  
    // SELECT ALL COLUMNS ON SOME TABLE WITCH WE CALL P 
    // THEN SELECT ANOTHER COLUMN ON TABLE WE CALL U
    // FROM posts AS posts WE SHORT IT AS P THEN JOIN TWO RESULTS
    // SHORT IT AS u ON post.user_id = user.id WHERE IT p.PUBLISHED TRUE
  
  
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE published=?";
    
    // EXECUTING QUERY
    $stat = exectureQuery($sql , ['published' => 1]);
    $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  
  
  }

  
  function getNumsThings($tablename , $whereCol) {
    global $conn;
    $query = mysqli_query($conn , " SELECT $whereCol FROM $tablename ");
    if (mysqli_num_rows($query) > 0) {
  return mysqli_num_rows($query);
    } else {
        return "0";
    }

  //   global $conn;
  //  $sql = "SELECT COUNT($whereCol) FROM $tablename";
  



}


function countItems($item , $table) {
  global $conn;
 $sql = "SELECT $item FROM $table";

 $query = mysqli_query($conn , $sql);
 if (mysqli_num_rows($query) > 0) {
  return mysqli_num_rows($query);
} else {
  return "0";
}

 }
//  $stat = $conn->prepare($sql);
//  $stat->execute();
//  $records = $stat->fetchRows();
//  return $records;





// return $stmt2->fetchColumn();


function checkThingInDb($tablename , $col , $conditions) {
  global $conn;
  $sql = "SELECT * FROM $tablename";
  $i = 0;
  foreach($conditions as $key => $value ) {
    if ($i === 0) {
      // HERE WE SAY SELLECT * FROM $tabel WHERE KEY IN CASE ADMIN = VALUE IN CASE 1
        $sql = $sql . " WHERE $key=?";
          } 
          else {
            $sql = $sql . " AND $key=?";
          }
       $i++;
  }

  $sql = $sql . " LIMIT 1";
  // EXECTING QUERY
  $stat = exectureQuery($sql , $conditions);
 
  // FETCHING ONE
  $records = $stat->get_result()->fetch_assoc();

  return $records;


}

function selectAllOneCol($tablename , $colName , $condection = [] , $limitStatus = false , $limit = '1' , $orderStatus = false , $orderBy = 'id' , $orderWith = 'DESC' ) {
  global $conn;
  $sql = "SELECT $colName FROM $tablename";
  if (empty($condection)) {
    if ($orderStatus) {
      $sql = $sql . " ORDER BY $orderBy $orderWith";
        }
        if ($limitStatus) {
          $sql = $sql . " LIMIT $limit";
        }

        
    $stat = $conn->prepare($sql);
    $stat->execute();
    $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  } else {
    // IF ARGUMENTS PROVIDED
    $i = 0;
    foreach($condection as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " WHERE $key=?";
    } else {
      $sql = $sql . " AND $key=?";
    }
      $i++;
    }
      // EXECTING QUERY
     $stat = exectureQuery($sql , $condection);
 $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
  }
}

function selectAllMultiCol($tablename , $cols = [] , $condection = [] , $operator = '=' , $limitStatus = false , $limit = '1') {
  global $conn;
  $sql = "SELECT ";
  $y = 0;
  foreach($cols as $singleCol => $value) {
    if ($y == 0) {
      $sql = $sql . "$value";
    } else {
      $sql = $sql . ",$value";
    }

    $y++;
   
  }
  
  $sql = $sql . " FROM $tablename";

  
  if (empty($condection)) {
    if ($limitStatus) {
      $sql = $sql . " LIMIT $limit";
    }
    $stat = $conn->prepare($sql);
    $stat->execute();
    $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  } else {
    // IF ARGUMENTS PROVIDED
    $i = 0;
    foreach($condection as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " WHERE $key$operator?";
    } else {
      $sql = $sql . " AND $key$operator?";
    }
      $i++;
    }

    if ($limitStatus) {
      $sql = $sql . " LIMIT $limit";
    }  
      // EXECTING QUERY
     $stat = exectureQuery($sql , $condection);
 $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
  }
}

  
function selectAllLimitAndOrder($tablename , $condection = [] , $operator = '=', $order = 'ASC' , $limit = '1'  ) {
  global $conn;
  $sql = "SELECT * FROM $tablename";
  if (empty($condection)) {
    $stat = $conn->prepare($sql);
    $stat->execute();
    $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  } else {
    // IF ARGUMENTS PROVIDED
    $i = 0;
    foreach($condection as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " WHERE $key$operator?";
    } else {
      $sql = $sql . " AND $key$operator?";
    }
      $i++;
    }
  $sql = $sql . " ORDER BY $order";
    $sql = $sql . " LIMIT $limit";
   
      // EXECTING QUERY
     $stat = exectureQuery($sql , $condection);
 $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
  }
}


function searchDb($tablename , $whereCol , $condection = []  , $searchQuery, $limit = 'NULL') {
  global $conn;
  $sql = "SELECT * FROM $tablename WHERE $whereCol ";
  if (empty($condection)) {
    $sql = $sql . " LIKE  '%$searchQuery%'";
    $sql = $sql . " LIMIT $limit";
  
    $stat = $conn->prepare($sql);
    $stat->execute();
    $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  } else {
    // IF ARGUMENTS PROVIDED
    $i = 0;
    foreach($condection as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " WHERE $key$operator?";
    } else {
      $sql = $sql . " AND $key$operator?";
    }
      $i++;
    }
  $sql = $sql . " LIKE  %$searchQuery%";
    $sql = $sql . " LIMIT $limit";
   
      // EXECTING QUERY
     $stat = exectureQuery($sql , $condection);
 $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
  }


}

function selectAllWithPagination($tablename , $condection = [] , $results_per_page = '10'  ) {
  global $conn;
   $returnedArray = array(
     'number_of_page' => array(),
     'results' => array(),
   );
    $sql = "SELECT * FROM $tablename";
  
  
      
      $result = mysqli_query($conn , $sql);
      $number_of_results = mysqli_num_rows($result);
      // TOTAL NUMBER OF PAGES AVALIABLE
      $number_of_page = ceil($number_of_results / $results_per_page );
      array_push($returnedArray['number_of_page'] , $number_of_page  );
      if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = $_GET['page'];  
      }
      
      // THE LIMIT
      $page_first_result = ($page - 1) * $results_per_page;
      if (empty($condection)) {

    $sql2 =  "SELECT * FROM $tablename LIMIT " . $page_first_result . ',' . $results_per_page;
   
    $stat = $conn->prepare($sql2);
    $stat->execute();
    $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    array_push($returnedArray['results'] , $records  );
   // return $records;
   return $returnedArray;
     
    } else {
      // IF ARGUMENTS PROVIDED
      $sql2 =  "SELECT * FROM $tablename ";
      $i = 0;
      foreach($condection as $key => $value) {
      if ($i === 0) {
        $sql2 = $sql2 . " WHERE $key=?";
      } else {
        $sql2 = $sql2 . " AND $key=?";
      }
        $i++;
      };
      $sql2 = $sql2 . " LIMIT " . $page_first_result . ',' . $results_per_page;
     
     // $stat = $conn->prepare($sql2);
      $stat = exectureQuery($sql2 , $condection);
     
      $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      
       array_push($returnedArray['results'] , $records  );
     return $returnedArray;
     

     
    }
   

      

}


