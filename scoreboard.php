<?php  
  
 

  $pageTitle = "Scoreboard صفحة";
  include 'init.php';
  
  ?>


        <!----------------- HEROAREA-------------------->
        <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/sigmund-By-tZImt0Ms-unsplash.jpg') center / cover no-repeat;" >
            <div class="flex-col">
                <h1 class="headline--main-bg"> Scoreboard  صفحة</h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->
       <div class="my-5"></div>
       <section class="main__scoreboard__div container py-5">
           <h1 class="headline--main-2 text-right">افضل الفرق</h1>
           <div class="mt-5"></div>
           <div class="main__section__scoreboard_teams">

           <?php  
           $teams = selectAll("published_teams" , array() , false , 1 ,true , 'team_score' , 'DESC'  );
          
            foreach($teams as $team ) { ?>

           <!------SIGNLE SCOREBOARD TEAM---->
           <div class="single__scoreboard_team f-sp d-flex-c">

<h1 class="headline_scoreboard"> <?php echo $team['team_name']  ?>  </h1>
<h6 class="headline_points"><?php echo $team['team_score']  ?></h6>
</div>
<!------END SIGNLE SCOREBOARD TEAM---->


            <?php }
           ?>



           </div>
       </section>


<?php  
 include $templates . '/footer.php';
?>