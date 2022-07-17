<?php
require_once 'init.php';
adminOnly();
$pageTitle = "Manage Questions";
?>

<?php  




    $func = isset($_GET['func']);

    if ( $func == 'Delete' ) {
      $answid = isset($_GET['answid']) && is_numeric($_GET['answid']) ? intval($_GET['answid']) : 0;
      $tablename = "published_answers";
      $delete_id = deleteFromDb($tablename , $answid  , 'answ_id');   

    }

    if (isset($_POST['answ_false'])) {
      if (isset($_POST['answ_id'])) {
        $answId = is_numeric($_POST['answ_id']) ? intval($_POST['answ_id']) : 0 ; 
        if ($answId > 0) {
          $updatedData = array(
            'answ_rated' => 1
          );
          update("published_answers" ,  $answId , $updatedData , 'answ_id');
          
        }
      }
      
    }

    if (isset($_POST['answ_true'])) {
      if (isset($_POST['answ_id'])) {
        $answId = is_numeric($_POST['answ_id']) ? intval($_POST['answ_id']) : 0 ; 
        $quesPoints = is_numeric($_POST['ques_points']) ? intval($_POST['ques_points']) : 0 ; 
        $teamId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

        if ($answId > 0 && $teamId > 0 && $quesPoints > 0) {
          $updatedAnsData = array(
            'answ_rated' => 1
          );
          $updatedTeamData = array(
            'team_score' => $quesPoints
          );
          update("published_answers" ,  $answId , $updatedAnsData , 'answ_id');
          update("published_teams" ,  $teamId , $updatedTeamData , 'team_id');
          
        }
      }
      
    }

?>

<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
          
<div class="d-flex flex-row justify-content-between">
<h2 class="mt-5 mb-5 text-center">جميع الاجابات</h2>
      <a class="btn btn-secondary align-self-center d-block" href="answers.php?answers&do=ManageTeam&page=1">ادارة الاجابات </a>
  </div>
    
     
      <div class="container">
  <div class="row align-items-start">
    <?php 
    $getTeamsName = selectAllMultiCol("published_teams" , array("team_name" , "team_score" , "team_id"));
    
    foreach($getTeamsName as $team) { ?>

<div class="col m-2">
       <!------SIGNLE CARD----->
       <a href="answers.php?answers&do=ShowTeam&id=<?php echo $team['team_id'] ?>" style="color: #000" > 

      
       <div class="single__card__team d-flex flex-column align-items-center justify-content-center">
         <img src="../images/icons/account.png" alt="" style="max-height: 8rem;  max-width: 8rem;" class="team_icon_img">
         <h6 class="mt-1 headline__team">  
           
         اسم الفريق
       <span class="team_name" >    <?php echo $team['team_name'] ?></span>
        </h6>
         <h6 class="mt-1 subheadline__team"> <?php echo $team['team_score'] ?>  :نقاط الفريق</h6>
       </div>
       <!------END SIGNLE CARD----->
       </a>
     </div>

  <?php  } 
    ?>
     
  </div>

  <div class="mt-5"></div>
  <!-------SHOW TEAM DONE AREA------->
    <?php  
    if (isset($_GET['do']) && $_GET['do'] == 'ShowTeam'  ) {
     if (isset($_GET['id'])) {
      $teamId = is_numeric($_GET['id']) ? intval($_GET['id']) : 0 ; 
     $getAnswers = selectAll("published_answers" , array(
       'answ_ref_team' => $teamId,
       'answ_rated' => 0
     ));
     $questionRes = array();
     ?>
     <script>
       let DOM_img;
       let imageArea;
       let imageElm;
       let imageAppendedElm;
     </script>
     <div class="g-col-2">
       <?php
       $answId = "answ_id";
    foreach($getAnswers as $answ) {
      $getQuestions = selectAll("published_questions" , array(
        'ques_id' =>  $answ['answ_ref_ques']
      ));
     
     ?>
    
    
     <?php foreach($getQuestions as $ques) { ?>
   

     <div class="single--grid__div flex-col ">
                         <?php  
                         if (!empty($ques['ques_image'])) { ?>
                 <img src="<?php  echo $ques['ques_image'] ? BASE_URL . '/admin/assets/images/' . $ques['ques_image'] : '' ?>" alt="" class="question__image">
                         <?php }
                         ?>
                        
                         <div class="mt-3"></div>
                         <h1 class="headline--question"> <?php echo $ques['ques_name']  ?>  </h1>
                         <h5 class="subheadline--question "><?php echo $ques['ques_desc']  ?></h5>
                        
                             <h4 class="small-headline__question mt-1">عدد النقاط: <?php echo $ques['ques_points']  ?></h4>
                           
  
                             <div class="popup_div_sing">
                             
                                <h1 class="headline--main-2-sm mt-2"> اجابة السؤال</h1>
                               
                                <div class="mt-2"></div>
                                <img src="<?php  echo $answ['answer_image'] ? BASE_URL . '/admin/assets/images/' . $answ['answer_image'] : '' ?>" id="image_elem_<?php echo $answ['answ_id'] ?>" alt="" class="question__image">
                                <h4 class="small-headline__question mt-1"> <?php echo $answ['answ_author']  ?> :تمت الاجابة من قبل  </h4>
                             </div>
                             <div class="image__area__div" id="image_area">
                           
                             </div>
                   <div class="answers__action mt-1 d-flex">
                     <form method="POST" >
                       <input type="hidden" name="answ_id" value="<?php echo $answ['answ_id'] ?>" >
                     <button type="submit" name="answ_false" class="btn_uncorrect">اجابة خاطئة</button>
                     </form>
                 <form method="POST" >
                 <input type="hidden" name="answ_id" value="<?php echo $answ['answ_id'] ?>" >
                 <input type="hidden" name="ques_points" value="<?php echo $ques['ques_points'] ?>" >
                 <button type="submit" name="answ_true" class="btn_correct">اجابة صحيحة</button>
                 </form>
                    
                    
                   </div>
  
                      </div>
                
                      <script>
                      imageArea = document.getElementById('image_area');
                      imageAppendedElm = document.getElementById('image_appeded_elem_<?php echo $answ[$answId] ?>');
                      imageElm = document.querySelector('#image_elem_<?php echo $answ[$answId] ?>');
                     
                     
                      imageElm.addEventListener('click' , (e) => {
                      
                         DOM_img = document.createElement('img');
                        DOM_img.src = "<?php echo BASE_URL . '/admin/assets/images/' . $answ['answer_image'] ?>"
                        DOM_img.style.width = "100%";
                        DOM_img.style.height = "100%";
                        DOM_img.style.padding = "1rem";
                        imageArea.appendChild(DOM_img)
                     
                      
                     
                        imageArea.classList.toggle('active');
                        if ( !(imageArea.classList.contains('active') )) {
                          imageArea.innerHTML = "";
                        }
                       
                      })
                    
                    
                      

                      </script>
                
      
   <?php  } } ?>
     </div>
  
   
    
  

   
    <?php }
    }
    ?>
  <!-------END SHOW TEAM DONE AREA------->


  <!------- MANAGE TEAM DONE AREA------->
  <?php  

   if (isset($_GET['do']) && $_GET['do'] == 'ManageTeam'  ) { 
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
     ?>
      <div>
        
  <table class="table">
      <thead class="thead-dark">
          <tr>
          <th scope="col">الرقم</th>
          <th scope="col">صاحب الاجابة </th>
          <th scope="col"> صورة السؤال </th>
          <th scope="col">الفريق الناشر</th>
          <th scope="col"> السؤال المرتبط</th>
          <th scope="col">Delete</th>
          </tr>
      </thead>
      <tbody>
         
        <?php  
        $answers = selectAllWithPagination("published_answers" , array(
          'answ_rated' => 1
        ));
        
        foreach($answers['results'][0] as $answ) { ?>
         <tr>
     <td > <?php echo $answ['answ_id'] ?> </td>
     <td  > <?php echo $answ['answ_author'] ?> </td>
    
     <td  >
         <?php  
         if (!empty($answ['answer_image'])) { ?>
  <img class="img-fluid" style="max-height: 4rem; max-width: 4rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $answ['answer_image']  ?>" alt="">  
       <?php  }
         ?>
         
          </td>
   
     <td  > <?php echo $answ['answ_ref_team'] ?> </td>
     <td  > <?php echo $answ['answ_ref_ques'] ?> </td>
  
     <td>  <a href="answers.php?func=Delete&answid=<?php echo $answ['answ_id'] ?>">  <button class="btn_delete_btn" >Delete</button> </a>  </td>
     </tr>
      <?php  }
        ?>
         
         
        
      </tbody>
  </table>
 
  <?php  
  if (isset($_GET['page'])) { ?>
  
  <ul class="pagination px-lg-5">
  <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
    
    <a class="page-link" href="answers.php?answers&do=ManageTeam&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">Previous</a>
  </li>
  <?php  
  for ($i = 1; $i <= $answers['number_of_page'][0]; $i++) { ?>
 <li class="page-item"><a class="page-link" href="answers.php?answers&do=ManageTeam&page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
   <?php }
  ?>
 
  
 
  <li class="page-item <?php echo $_GET['page'] >= $answers['number_of_page'][0] ? 'disabled' : '' ?> ">
    <a class="page-link" href="answers.php?answers&do=ManageTeam&page=<?php echo intval($_GET['page'])  +1 ?>">Next</a>
  </li>
</ul>


 <?php }
  ?>


      </div>
  <?php }
  ?>

  <!------- END MANAGE TEAM DONE AREA------->


</div>
     
  </section>