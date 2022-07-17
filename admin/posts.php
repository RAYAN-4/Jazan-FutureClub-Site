<?php
require_once 'init.php';
adminOnly();
$pageTitle = "Manage Posts";

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
  
 if (isset($_GET['func'])) {
  $func = isset($_GET['func']);

    
  if ( $func == 'Delete' ) {
    $postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;
    $tablename = "published_posts";
   
    $delete_id = deleteFromDb($tablename , $postid  , 'id_post');
   


}
 }


?>

<div class="fluid-container">


<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
  <div class="d-flex flex-row justify-content-between">
      <h2 class="mt-5 mb-5">جميع المنشورات</h2>
      <a class="btn btn-secondary align-self-center d-block" href="new-post.php">Add New Post</a>
  </div>
  
  <table class="table">
      <thead class="thead-dark">
          <tr>
          <th scope="col">الرقم</th>
          <th scope="col">العنوان </th>
          <th scope="col"> المحتوى </th>
          <th scope="col">الصورة</th>
          <th scope="col">الحالة</th>
          <th scope="col">الناشر</th>
          <th scope="col">تاريخ النشر</th>
        
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
          </tr>
      </thead>
      <tbody>
         
        <?php  
        $posts = selectAllWithPagination("published_posts");
        
        foreach($posts['results'][0] as $post) { ?>
         <tr>
     <td > <?php echo $post['id_post'] ?> </td>
     <td  > <?php echo $post['title_post'] ?> </td>
     <td  > <?php echo  $post['body_post'] ?> </td>
     <td  >
         <?php  
         if (!empty($post['image_post'])) { ?>
  <img class="img-fluid" style="max-height: 4rem; max-width: 4rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $post['image_post']  ?>" alt="">  
       <?php  }
         ?>
         
          </td>
   
     <td  > <?php echo $post['status_post'] ?> </td>
     <td  > <?php echo $post['author_post'] ?> </td>
     <td  > <?php echo $post['date_post'] ?> </td>
     <td> <a href="edit-post.php?posts&func=Edit&postid=<?php echo $post['id_post'] ?>"> <button class="btn_update_btn" >Edit</button> </a> </td>
     <td>  <a href="posts.php?posts&page=1&func=Delete&postid=<?php echo $post['id_post'] ?>">  <button class="btn_delete_btn" >Delete</button> </a>  </td>
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
  for ($i = 1; $i <= $posts['number_of_page'][0]; $i++) { ?>
 <li class="page-item"><a class="page-link" href="posts.php?posts&page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
   <?php }
  ?>
 
  
 
  <li class="page-item <?php echo $_GET['page'] >= $posts['number_of_page'][0] ? 'disabled' : '' ?> ">
    <a class="page-link" href="posts.php?posts&page=<?php echo intval($_GET['page'])  +1 ?>">Next</a>
  </li>
</ul>

</div>
