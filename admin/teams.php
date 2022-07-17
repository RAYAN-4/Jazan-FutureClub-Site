<?php
require_once 'init.php';
adminOnly();
$pageTitle = "Manage Teams";

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
      $teamId = isset($_GET['teamid']) && is_numeric($_GET['teamid']) ? intval($_GET['teamid']) : 0;
      $tablename = "published_teams";
      $delete_id = deleteFromDb($tablename , $teamId  , 'team_id');
      // $_SESSION['message'] = "Post deleted successfully";
      // $_SESSION['type'] = "success";
      // header("location: " . BASE_URL . "/admin/index.php"); 
      // exit();    


    }

?>

<div class="fluid-container">


<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
 
      <h2 class="mt-5 mb-5 text-center">جميع الفرق</h2>

  
  <table class="table">
      <thead class="thead-dark">
          <tr>
          <th scope="col">الرقم</th>
          <th scope="col">اسم الفريق </th>
          <th scope="col"> نقاط الفريق </th>
        
          <th scope="col">  اعضاء الفريق </th>

        
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
          </tr>
      </thead>
      <tbody>
         
        <?php  
        $teams = selectAllWithPagination("published_teams");
     
       
        
        foreach($teams['results'][0] as $team) {
          $usersInTeam = selectAllOneCol("joinedteams" , "user_name" , array(
            'joined_team_id' => $team['team_id']
          ));
        
          ?>
         <tr>
     <td > <?php echo $team['team_id'] ?> </td>
     <td  > <?php echo $team['team_name'] ?> </td>
           
   
     <td  > <?php echo $team['team_score'] ?> </td>
     <td>
     <?php  
             foreach($usersInTeam as $teamUser) {
              
               if (count($usersInTeam) > 0) {
                echo "<p style='font-size: 14px;' >" . $teamUser['user_name'] . ", " . "</p>";
               } else {
                echo $teamUser['user_name'];
               }
         
             }
             ?>
     </td>
    
    
     <td> <a href="edit-team.php?func=Edit&teamid=<?php echo $team['team_id'] ?>"> <button class="btn_update_btn" >Edit</button> </a> </td>
     <td>  <a href="teams.php?teams&page=1&func=Delete&teamid=<?php echo $team['team_id'] ?>">  <button class="btn_delete_btn" >Delete</button> </a>  </td>
     </tr>
      <?php  }
        ?>
       
         
        
      </tbody>

    
  </table>

</section>

<ul class="pagination px-lg-5">
  <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
    
    <a class="page-link" href="teams.php?teams&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">Previous</a>
  </li>
  <?php  
  for ($i = 1; $i <= $teams['number_of_page'][0]; $i++) { ?>
 <li class="page-item"><a class="page-link" href="teams.php?teams&page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
   <?php }
  ?>
 
  
 
  <li class="page-item <?php echo $_GET['page'] >= $teams['number_of_page'][0] ? 'disabled' : '' ?> ">
    <a class="page-link" href="teams.php?teams&page=<?php echo intval($_GET['page'])  +1 ?>">Next</a>
  </li>
</ul>

</div>
