<?php
require_once 'init.php';
adminOnly();
$pageTitle = "Manage Questions";
?>

<?php  


if(isset($_GET['page'])) {
  $_GET['page'] = is_numeric($_GET['page']) ? intval($_GET['page']) : 0 ; 

  if ($_GET['page'] == 0) {
    die;
  }
}

if (!isset($_GET['page'])) {
  die;
}


    $func = isset($_GET['func']);

    if ( $func == 'Delete' ) {
      $quesId = isset($_GET['quesid']) && is_numeric($_GET['quesid']) ? intval($_GET['quesid']) : 0;
      $tablename = "published_questions";
      $delete_id = deleteFromDb($tablename , $quesId  , 'ques_id');
      // $_SESSION['message'] = "Event deleted successfully";
      // $_SESSION['type'] = "success";
      // header("location: " . BASE_URL . "/admin/index.php"); 
      // exit();    


    }

?>


<div class="fluid-container">


<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
  <div class="d-flex flex-row justify-content-between">
      <h2 class="mt-5 mb-5">جميع الاسئلة</h2>
      <a class="btn btn-secondary align-self-center d-block" href="new-question.php">Add New Question</a>
  </div>
  
  <table class="table">
      <thead class="thead-dark">
          <tr>
          <th scope="col">الرقم</th>
          <th scope="col">اسم السؤال </th>
          <th scope="col"> محتوى السؤال </th>
          <th scope="col">الصورة</th>
          <th scope="col">النقاط</th>
         
        
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
          </tr>
      </thead>
      <tbody>
         
        <?php  
        $questions = selectAllWithPagination("published_questions");
        foreach($questions['results'][0] as $ques) { ?>
         <tr>
     <td > <?php echo $ques['ques_id'] ?> </td>
     <td  > <?php echo $ques['ques_name'] ?> </td>
     <td  > <?php echo  $ques['ques_desc'] ?> </td>
     <td  >
         <?php  
         if (!empty($ques['ques_image'])) { ?>
  <img class="img-fluid" style="max-height: 4rem; max-width: 4rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $ques['ques_image']  ?>" alt="">  
       <?php  }
         ?>
         
          </td>
   
     <td  > <?php echo $ques['ques_points'] ?> </td>
     
     <td> <a href="edit-question.php?func=Edit&quesid=<?php echo $ques['ques_id'] ?>"> <button class="btn_update_btn" >Edit</button> </a> </td>
     <td>  <a href="questions.php?questions&page=1&func=Delete&quesid=<?php echo $ques['ques_id'] ?>">  <button class="btn_delete_btn" >Delete</button> </a>  </td>
     </tr>
      <?php  }
        ?>
         
         
        
      </tbody>
  </table>

</section>

<ul class="pagination px-lg-5">
  <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
    
    <a class="page-link" href="posts.php?posts&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">Previous</a>
  </li>
  <?php  
  for ($i = 1; $i <= $questions['number_of_page'][0]; $i++) { ?>
 <li class="page-item"><a class="page-link" href="posts.php?posts&page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
   <?php }
  ?>
 
  
 
  <li class="page-item <?php echo $_GET['page'] >= $questions['number_of_page'][0] ? 'disabled' : '' ?> ">
    <a class="page-link" href="posts.php?posts&page=<?php echo intval($_GET['page'])  +1 ?>">Next</a>
  </li>
</ul>

</div>
