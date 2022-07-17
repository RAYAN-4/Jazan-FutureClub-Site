
  <?php  
  
 
  $conenctPath = 'C:\xampp\htdocs\myPhpProjects\futureClubWebsite\admin';
include $conenctPath . '/connect.php';



  include_once 'createUtlity.php';
  include_once 'deleteUtlity.php';
  include_once 'getUtlity.php';
  include_once 'middlewareUtlity.php';
  include_once 'showUtlity.php';
  include_once 'updateUtility.php';
  include_once 'uploadUtlity.php';
  include_once 'validateUtlity.php';


// printing value
    function dd($value) {
        echo '<pre>'. print_r($value , true) . '</pre>' ;
        die();
          }
      //FUNCTION FOR EXECTUNG THE QUERY
  function exectureQuery($sql , $data) {
    global $conn;
 
    $stat = $conn->prepare($sql);
  
    // array of values user pass in query condition
    $values = array_values($data);
    $types = str_repeat('s' , count($values));

    // I STANDS FOR INTEGER AND S FOR STRING
    // PREVENT SQL HACKING
 
    $stat->bind_param($types , ...$values );
   
    $stat->execute();
   
    return $stat;
   }


  // create and made CONNECTION TO DB
  function CreateAndConnectDB($host , $user , $password , $dbname , $tablename, $condection = []) {
  
    $conn = mysqli_connect($host , $user , $password);
    // IF THERE IS NO CONENCTION
    if (!$conn) {
        die("CONNECTION FAILED: " . mysqli_connect_error());
    }  else {
        // IF CONNECTION SUCCESS CREATE THE DATABASE
        // SQL
       $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
       // CREATE NEW CONENCTION
       if (mysqli_query($conn, $sql)) {
           $conn = mysqli_connect($host , $user , $password , $dbname);
           if ($conn ) {
       // IF CONNECTION MADED THEN CREATE TABLE
       if (empty($condection)) {
           die("YOU SHOULD PROVIDE ARGUEMTN IN ORDER TO CREATE DATABASE TABLE");
       }
       $sql = "CREATE TABLE IF NOT EXISTS $tablename(";
       $i = 0;
       foreach($condection as $key => $value) {
      
          
      $valueCount = count($value);
      $d = 0;
      if ($valueCount === 0) {
          
        $myArray = "$value[0]";
        $sql = $sql . "$key $myArray";
      } else {
        
        if ($i !== 0) {
            $sql = $sql . ",$key";
        } else {
            $sql = $sql . "$key";
        }
         
          while($d < $valueCount) {
            $myArray = "$value[$d]";
            if (is_numeric($myArray)) {
             $myArray = "($myArray)";
            }
            $d++;
      
            $sql = $sql . " $myArray";
          }
        
      }
     
  $i++;      
       }
       $sql = "$sql)";
       
      // $sql = "CREATE TABLE IF NOT EXISTS $tablename (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(25) NOT NULL, product_price FLOAT, product_image VARCHAR(100) )";
       if (!mysqli_query($conn , $sql)) {
        echo "ERROR CREATING TABLE: " .mysqli_error($conn);
       }
           
        } 
        // IF NO CONNECTION SUCCESS
        else {
            die("CONNECTION FAILED: " . mysqli_connect_error());
           }
       } else {
           return false;
       }

    }
  }

//  $createdData = CreateAndConnectDB('localhost' , 'root' , '' , 'testingphp123' , 'hellophp12343SD2323',[
//      'id' => ['INT' , 12 , 'NOT NULL' , 'AUTO_INCREMENT' , 'PRIMARY KEY']
//  ] );

  //dd($createdData);

   




   


   //$createdPost = selectQueryTable('posts' , [
    // 'selection' => ['users' , 'ids' , 'posts'],
    //'WHERE' => ['postname' => 'LALALA', 'postbody' => 'LALALA' ] ,
  //    'order' => 'ASC',
  //    'orderBy' => 'id',
  //    'limit' => '5',
  //  'null' => 'false',
  //  'within' => ['Germany' , 'France' , 'UK'],
  // 'without' => ['dsd' , 'sdsd'],
  // 'between' => ['price' => [10 , 23], 'users' => [43 , 122] , 'laopind' => [12 , 32 , 12] ],
  // 'whereaslike' => ['CUM' => 'Bnadon' , 'laop' => 'dse' , 'city' => 'gemar'],
  // 'whereasnotlike' => ['sad' => 'lapt' , 'rapit' => 'sd' , 'city' => 'gemsdsar'],
  //    'min' => ['like' , 24],
  //   'min' => ['like' => 24 , 'posts' => 32 , 'users' => 42],
  //   'max' => ['like' => 24 , 'posts' => 32 , 'users' => 42],
    
   //]);

  // dd($createdPost);
 


  
  ?>