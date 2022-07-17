<?php
require_once 'init.php';
adminOnly();
$pageTitle = "Manage Competions";
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
    $compId = isset($_GET['compid']) && is_numeric($_GET['compid']) ? intval($_GET['compid']) : 0;
    $tablename = "published_competions";
    $delete_id = deleteFromDb($tablename , $compId  , 'comp_id');
    // $_SESSION['message'] = "Event deleted successfully";
    // $_SESSION['type'] = "success";
    // header("location: " . BASE_URL . "/admin/index.php"); 
    // exit();    


  }

?>


<div class="fluid-container">


<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
<div class="d-flex flex-row justify-content-between">
    <h2 class="mt-5 mb-5">جميع المسابقات</h2>
    <a class="btn btn-secondary align-self-center d-block" href="new-competion.php">Add New Competion</a>
</div>

<table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">الرقم</th>
        <th scope="col">العنوان </th>
        <th scope="col"> المحتوى </th>
        <th scope="col">الصورة</th>
        <th scope="col">الحالة</th>
        <th scope="col">المكان</th>
        <th scope="col">برعاية</th>
        <th scope="col">الناشر</th>
        <th scope="col">التاريخ </th>
      
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        
      <?php  
      $compentions = selectAllWithPagination("published_competions");
      foreach($compentions['results'][0] as $comp) { ?>
        <tr>
    <td > <?php echo $comp['comp_id'] ?> </td>
    <td  > <?php echo $comp['comp_title'] ?> </td>
    <td  > <?php echo  $comp['comp_content'] ?> </td>
    <td  >
        <?php  
        if (!empty($comp['comp_image'])) { ?>
<img class="img-fluid" style="max-height: 4rem; max-width: 4rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $comp['comp_image']  ?>" alt="">  
      <?php  }
        ?>
        
        </td>
  
    <td  > <?php echo $comp['comp_status'] ?> </td>
    <td  > <?php echo $comp['comp_location'] ?> </td>
    <td  > <?php echo $comp['comp_publishers'] ?> </td>
    <td  > <?php echo $comp['comp_author'] ?> </td>
    <td  > <?php echo $comp['comp_date'] ?> </td>
    <td> <a href="edit-competion.php?func=Edit&compid=<?php echo $comp['comp_id'] ?>"> <button class="btn_update_btn" >Edit</button> </a> </td>
    <td>  <a href="competion.php?competions&page=1&func=Delete&compid=<?php echo $comp['comp_id'] ?>">  <button class="btn_delete_btn" >Delete</button> </a>  </td>
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
  for ($i = 1; $i <= $compentions['number_of_page'][0]; $i++) { ?>
 <li class="page-item"><a class="page-link" href="posts.php?posts&page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
   <?php }
  ?>
 
  
 
  <li class="page-item <?php echo $_GET['page'] >= $compentions['number_of_page'][0] ? 'disabled' : '' ?> ">
    <a class="page-link" href="posts.php?posts&page=<?php echo intval($_GET['page'])  +1 ?>">Next</a>
  </li>
</ul>

</div>
