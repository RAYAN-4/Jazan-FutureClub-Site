<?php
require_once 'init.php';
adminOnly();
$pageTitle = "Manage Users";
?>

<?php  

if(isset($_GET['page'])) {
  if (!(intval($_GET['page']))) {
    die;
  }
  if ($_GET['page'] == 0) {
    die;
  }
}

if (!isset($_GET['page'])) {
  die;
}


    $func = isset($_GET['func']);

    if ( $func == 'Delete' ) {
     
      $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;
      
      $tablename = "joinedusers";
      $delete_id = deleteFromDb($tablename , $userId  );
      
      // $_SESSION['message'] = "Event deleted successfully";
      // $_SESSION['type'] = "success";
      // header("location: " . BASE_URL . "/admin/index.php"); 
      // exit();    


    }

?>


<div class="fluid-container">


<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
  <div class="d-flex flex-row justify-content-between">
      <h2 class="mt-5 mb-5">جميع المستخدمين</h2>
      <a class="btn btn-secondary align-self-center d-block" href="new-user.php">Add New User</a>
  </div>
  
  <table class="table">
      <thead class="thead-dark">
          <tr>
          <th scope="col">الرقم</th>
          <th scope="col">اسم المستخدم </th>
          <th scope="col"> الايميل </th>
          <th scope="col">الصورة</th>
          <th scope="col">الحالة</th>
          <th scope="col">العضوية</th>
          <th scope="col">التاريخ </th>
        
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
          </tr>
      </thead>
      <tbody>
         
        <?php  
        $users = selectAllWithPagination("joinedusers");
        foreach($users['results'][0] as $user) { ?>
         <tr>
     <td > <?php echo $user['user_id'] ?> </td>
     <td > <?php echo $user['user_name'] ?> </td>
     <td  > <?php echo $user['user_email'] ?> </td>
     <td  ><img src=" <?php echo $user['user_image'] ? BASE_URL . '/admin/assets/images/' . $user['user_image'] : '' ?>" style="max-height: 5rem; max-width: 5rem;" alt=""> </td>
     <td  > <?php echo $user['user_status'] == 0 ? "غير مسموح" : "مسموح" ?> </td>
     <td  > <?php echo  $user['user_group_id'] == 1 ? "ادمن" : "مستخدم" ?> </td>
    
   
     <td  > <?php echo $user['user_joined_date'] ?> </td>
     
     <td> <a href="edit-user.php?func=Edit&userId=<?php echo $user['user_id'] ?>"> <button class="btn_update_btn" >Edit</button> </a> </td>
     <td>  <a href="users.php?users&page=1&func=Delete&userId=<?php echo $user['user_id'] ?>">  <button class="btn_delete_btn" >Delete</button> </a>  </td>
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
  for ($i = 1; $i <= $users['number_of_page'][0]; $i++) { ?>
 <li class="page-item"><a class="page-link" href="posts.php?posts&page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
   <?php }
  ?>
 
  
 
  <li class="page-item <?php echo $_GET['page'] >= $users['number_of_page'][0] ? 'disabled' : '' ?> ">
    <a class="page-link" href="posts.php?posts&page=<?php echo intval($_GET['page'])  +1 ?>">Next</a>
  </li>
</ul>

</div>
