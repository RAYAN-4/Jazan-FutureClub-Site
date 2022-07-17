<?php
require_once 'init.php';
adminOnly();
$pageTitle = "Manage Events";
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
      $eventid = isset($_GET['eventid']) && is_numeric($_GET['eventid']) ? intval($_GET['eventid']) : 0;
      $tablename = "published_events";
      $delete_id = deleteFromDb($tablename , $eventid  , 'event_id');
      // $_SESSION['message'] = "Event deleted successfully";
      // $_SESSION['type'] = "success";
      // header("location: " . BASE_URL . "/admin/index.php"); 
      // exit();    


    }

?>


<div class="fluid-container">


<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
  <div class="d-flex flex-row justify-content-between">
      <h2 class="mt-5 mb-5">جميع الفعاليات</h2>
      <a class="btn btn-secondary align-self-center d-block" href="new-event.php">Add New Event</a>
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
        $events = selectAllWithPagination("published_events");
        foreach($events['results'][0] as $event) { ?>
         <tr>
     <td > <?php echo $event['event_id'] ?> </td>
     <td  > <?php echo $event['event_title'] ?> </td>
     <td  > <?php echo  $event['event_body'] ?> </td>
     <td  >
         <?php  
         if (!empty($event['event_image'])) { ?>
  <img class="img-fluid" style="max-height: 4rem; max-width: 4rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $event['event_image']  ?>" alt="">  
       <?php  }
         ?>
         
          </td>
   
     <td  > <?php echo $event['event_status'] ?> </td>
     <td  > <?php echo $event['event_location'] ?> </td>
     <td  > <?php echo $event['event_publishers'] ?> </td>
     <td  > <?php echo $event['event_author'] ?> </td>
     <td  > <?php echo $event['event_date'] ?> </td>
     <td> <a href="edit-event.php?func=Edit&eventid=<?php echo $event['event_id'] ?>"> <button class="btn_update_btn" >Edit</button> </a> </td>
     <td>  <a href="events.php?events&page=1&func=Delete&eventid=<?php echo $event['event_id'] ?>">  <button class="btn_delete_btn" >Delete</button> </a>  </td>
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
  for ($i = 1; $i <= $events['number_of_page'][0]; $i++) { ?>
 <li class="page-item"><a class="page-link" href="posts.php?posts&page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
   <?php }
  ?>
 
  
 
  <li class="page-item <?php echo $_GET['page'] >= $events['number_of_page'][0] ? 'disabled' : '' ?> ">
    <a class="page-link" href="posts.php?posts&page=<?php echo intval($_GET['page'])  +1 ?>">Next</a>
  </li>
</ul>

</div>
