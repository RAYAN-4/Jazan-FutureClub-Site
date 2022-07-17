<?php  
  
 

  $pageTitle = "صفحة المسابقات";
  include 'init.php';
  
  ?>


        <!----------------- HEROAREA-------------------->
    <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/pexels-pixabay-277124.jpg') center / cover no-repeat;" >
            <div class="flex-col">
                <h1 class="headline--main-bg">صفحة المسابقات</h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->

     <!----------------- BLOG PAGE-------------------->
     <div class="mt-5"></div>
     <section class="main--blog__div container-sm">
         <div class="d-grid grid-blog">
             <div class="g-col-2 flex-row">
             <?php    
               
               $competions = selectAll("published_competions"  );
               if (!empty($competions)) {

             
               $randomCompNum = array_rand($competions);
            
               ?>
              <div class="img--div__info">
                    <img src="<?php  echo $competions[$randomCompNum]['comp_image'] ? BASE_URL . '/admin/assets/images/' . $competions[$randomCompNum]['comp_image'] : './images/blog/flat-illustration-people-04.jpg'  ?>" alt="">
                </div>

                <div class="info--div__info">
                    <h1 class="headline--blog__main"> <?php  echo $competions[$randomCompNum]['comp_title']    ?> </h1>
                    <p class="mian--paragraph mt-1">  <?php  echo $competions[$randomCompNum]['comp_content']    ?> </p>

                    <div class="author__post d-flex-c mt-1">
              
                 <div class="user__info"> 
                     <h1 class="headline--userauthor">  <?php  echo $competions[$randomCompNum]['comp_author']    ?> نشر بواسطة </h1>
                    <!-- <p class="subheadline--userauthor">Adiminstrator At Publ</p> -->
                    </div>
                    </div>
                </div>
             </div>
             
         </div>

         <div class="mt-5"></div>
         <div class="blogpost__div">
             <div class="text-center searching__div">
                 <div class="search__single--div">
                 <form method="POST" >
                 <div class="search__single--div">
                     <input name="search_query" type="text" class="search-input">
                     <button type="submit" name="search_comp" value="Search"  class="search_query-btn">Search</button>
                 </div>
            </form>     
                    
                 </div>
             </div>
             <div class="mt-5"></div>

             <div class="d-grid grid-challenges py-5">
                <h1 class=" headline--main-2 text-right" > المسابقات </h1>
                <p class="mian--paragraph text-right mb-4">  للمشاركة في المسابقات يجب عليك انشاء فريق للدخول <a href="teams.php">اضغط هنا</a></p>
                 <div class="g-col-2 ">
                 <?php  
                   $searchedQuery;

                   if (isset($_POST['search_comp']  ) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                       $searchQu =  $_POST['search_query'];
                     $searchedQuery = searchDb("published_competions" , "comp_title" , array() , $searchQu , '5' );
                     
                   }

                   if (!empty($searchedQuery)) {
                       foreach($searchedQuery as $compSing) { ?>
                 <!-----SIGNLE CHALLENGE----------->
                 
                 <div class="single-challege__div">
                       <div class="d-flex challenge__div">
                       <a href="single-challenge.php?compId=<?php echo $compSing['comp_id']  ?>">
                          <img src="<?php echo $compSing['comp_image'] ? BASE_URL . '/admin/assets/images/' . $compSing['comp_image'] : './images/challenges/dino-reichmuth-A5rCN8626Ck-unsplash.jpg'   ?>" alt="" class="challenge__img--div">
                          </a>
                          <div>
                              
                          </div>

                          <?php     if ($compSing['comp_status'] == 'published') {    ?>
                          <div class="dating__challenge">
                              <div class="single--event__timeleft">
                                  <div class="flex-col-c">
           
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="day_comp_count_<?php echo $compSing['comp_id'] ?>" >00</h1>
                                          </div>
                                          <p class="text-white" >Days</p>
                                      </div>
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="hour_comp_count_<?php echo $compSing['comp_id'] ?>" >00</h1>
                                              
                                          </div>
                                          <p class="text-white" >Hours</p>
                                      </div>
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="mins_comp_count_<?php echo $compSing['comp_id'] ?>" >00</h1>
                                             
                                          </div>
                                          <p class="text-white" >Mins</p>
                                      </div>
          
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="secs_comp_count_<?php echo $compSing['comp_id'] ?>" >00</h1>
                                            
                                          </div>
                                          <p class="text-white" >Secd</p>
                                      </div>
          
          
                                  </div>
          
                                  
                              </div>
                          </div>
                          <?php } ?>
                       </div>

                       <div class="info__challenge--div mt-1">
                           <h1 class="headline--main-2"> <?php echo $compSing['comp_title']  ?> </h1>
                           <p class="mian--paragraph mt-1"><?php echo $compSing['comp_content']  ?></p>
                       </div>

                       <?php 
                 
                 $compDate = 'comp_date';
                
                 $compStatus = 'comp_status';
               //  $correctCal =   $eventSing[$evntStatus] == 'published' ? "$eventSing[$evntDate]" : null;
              $correctCal =   $compSing[$compStatus] == 'published' ? "$compSing[$compDate]" : null;
               $compId = 'comp_id';
              
                 //echo "'$event[$evntDate]'";
                echo  "<script>
              
              
                setInterval(function() { 
                  
                   const countDate = new Date(".   "'$correctCal'" . ").getTime();
          
                const now = new Date().getTime();
                const gapDate = countDate - now;
                const second = 1000;
                const minute = second * 60;
                const hour = minute * 60;
                const day = hour * 24;
               
                // CACULATING
                const textDay = Math.floor(gapDate / day);
                const textHour = Math.floor((gapDate % day) / hour);
                const textMin = Math.floor((gapDate % hour) / minute);
                const textSec = Math.floor((gapDate % minute) / second);
               
                if (textDay > 0) {
                  
                
                    document.getElementById('day_comp_count_$compSing[$compId]').innerText = textDay;
                }
                if (textHour > 0) {
                    
                   document.getElementById('hour_comp_count_$compSing[$compId]').innerText = textHour;
                }
                if (textMin > 0) {
                    
                   document.getElementById('mins_comp_count_$compSing[$compId]').innerText = textMin;
                }
                if (textSec > 0) {
                   
                   document.getElementById('secs_comp_count_$compSing[$compId]').innerText = textSec;
                }

              
              
                
                
               
                 } , 1000)
    </script>"; ?>

                     
                   </div>
                      
                   <!-----END SIGNLE CHALLENGE----------->
                     <?php  }
                   } else {
                    $publishedcompetions = selectAll("published_competions" );
                      
                 
                     foreach($publishedcompetions as $comp) {  
                         if ($comp['comp_status'] == 'published') {   ?>
                             <!-----SIGNLE CHALLENGE----------->
                    
                   <div class="single-challege__div">
                       <div class="d-flex challenge__div">
                       <a href="single-challenge.php?compId=<?php echo $comp['comp_id']  ?>">
                          <img src="<?php echo $comp['comp_image'] ? BASE_URL . '/admin/assets/images/' . $comp['comp_image'] : './images/challenges/dino-reichmuth-A5rCN8626Ck-unsplash.jpg'   ?>" alt="" class="challenge__img--div">
                          </a>
                          <div>
                              
                          </div>
                          <?php  
                           if ($comp['comp_status'] == 'published') {
                          ?>
                          <div class="dating__challenge">
                              <div class="single--event__timeleft">
                                  <div class="flex-col-c">
           
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="day_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                          </div>
                                          <p class="text-white" >Days</p>
                                      </div>
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="hour_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                              
                                          </div>
                                          <p class="text-white" >Hours</p>
                                      </div>
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="mins_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                             
                                          </div>
                                          <p class="text-white" >Mins</p>
                                      </div>
          
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="secs_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                            
                                          </div>
                                          <p class="text-white" >Secd</p>
                                      </div>
          
          
                                  </div>
          
                                  
                              </div>
                          </div>
                          <?php } ?>
                       </div>

                       <div class="info__challenge--div mt-1">
                           <h1 class="headline--main-2"> <?php echo $comp['comp_title']  ?> </h1>
                           <p class="mian--paragraph mt-1"><?php echo $comp['comp_content']  ?></p>
                       </div>
                       <?php 
                 
                 $compDate = 'comp_date';
                
                 $compStatus = 'comp_status';
               //  $correctCal =   $eventSing[$evntStatus] == 'published' ? "$eventSing[$evntDate]" : null;
              $correctCal =   $comp[$compStatus] == 'published' ? "$comp[$compDate]" : null;
               $compId = 'comp_id';
              
                 //echo "'$event[$evntDate]'";
                echo  "<script>
              
              
                setInterval(function() { 
                  
                   const countDate = new Date(".   "'$correctCal'" . ").getTime();
          
                const now = new Date().getTime();
                const gapDate = countDate - now;
                const second = 1000;
                const minute = second * 60;
                const hour = minute * 60;
                const day = hour * 24;
               
                // CACULATING
                const textDay = Math.floor(gapDate / day);
                const textHour = Math.floor((gapDate % day) / hour);
                const textMin = Math.floor((gapDate % hour) / minute);
                const textSec = Math.floor((gapDate % minute) / second);
                console.log(textHour)
                if (textDay > 0) {
                  
                
                    document.getElementById('day_comp_count_$comp[$compId]').innerText = textDay;
                }
                if (textHour > 0) {
                    
                   document.getElementById('hour_comp_count_$comp[$compId]').innerText = textHour;
                }
                if (textMin > 0) {
                    
                   document.getElementById('mins_comp_count_$comp[$compId]').innerText = textMin;
                }
                if (textSec > 0) {
                   
                   document.getElementById('secs_comp_count_$comp[$compId]').innerText = textSec;
                }

              
              
                
                
               
                 } , 1000)
    </script>"; ?>
                   </div>
                  
                   <!-----END SIGNLE CHALLENGE----------->
                       <?php  }  ?>
                        

                     
                  
                    <?php }

                    
                   
                   
                      ?>
                   

                     
                 </div>
                 <div class="mt-4"></div>
                 <h1 class="mb-4 headline--main-2 text-right" > المسابقات القديمة</h1>
          <?php  
          foreach($publishedcompetions as $comp) {
             if ($comp['comp_status'] == 'draft') { ?>
                  <!-----SIGNLE CHALLENGE----------->
                    
                  <div class="single-challege__div">
                       <div class="d-flex challenge__div">
                       <a href="single-challenge.php?compId=<?php echo $comp['comp_id']  ?>">
                          <img src="<?php echo $comp['comp_image'] ? BASE_URL . '/admin/assets/images/' . $comp['comp_image'] : './images/challenges/dino-reichmuth-A5rCN8626Ck-unsplash.jpg'   ?>" alt="" class="challenge__img--div">
                          </a>
                          <div>
                              
                          </div>
                          <?php  
                           if ($comp['comp_status'] == 'published') {
                          ?>
                          <div class="dating__challenge">
                              <div class="single--event__timeleft">
                                  <div class="flex-col-c">
           
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="day_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                          </div>
                                          <p class="text-white" >Days</p>
                                      </div>
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="hour_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                              
                                          </div>
                                          <p class="text-white" >Hours</p>
                                      </div>
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="mins_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                             
                                          </div>
                                          <p class="text-white" >Mins</p>
                                      </div>
          
                                      <div class="single--timeleft__div-sm">
                                          <div class="circle--time__div-sm">
                                              <h1 class="headline--main-2" id="secs_comp_count_<?php echo $comp['comp_id'] ?>" >00</h1>
                                            
                                          </div>
                                          <p class="text-white" >Secd</p>
                                      </div>
          
          
                                  </div>
          
                                  
                              </div>
                          </div>
                          <?php } ?>
                       </div>

                       <div class="info__challenge--div mt-1">
                           <h1 class="headline--main-2"> <?php echo $comp['comp_title']  ?> </h1>
                           <p class="mian--paragraph mt-1"><?php echo $comp['comp_content']  ?></p>
                       </div>
                       <?php 
                 
                 $compDate = 'comp_date';
                
                 $compStatus = 'comp_status';
               //  $correctCal =   $eventSing[$evntStatus] == 'published' ? "$eventSing[$evntDate]" : null;
              $correctCal =   $comp[$compStatus] == 'published' ? "$comp[$compDate]" : null;
               $compId = 'comp_id';
              
                 //echo "'$event[$evntDate]'";
                echo  "<script>
              
              
                setInterval(function() { 
                  
                   const countDate = new Date(".   "'$correctCal'" . ").getTime();
          
                const now = new Date().getTime();
                const gapDate = countDate - now;
                const second = 1000;
                const minute = second * 60;
                const hour = minute * 60;
                const day = hour * 24;
               
                // CACULATING
                const textDay = Math.floor(gapDate / day);
                const textHour = Math.floor((gapDate % day) / hour);
                const textMin = Math.floor((gapDate % hour) / minute);
                const textSec = Math.floor((gapDate % minute) / second);
                console.log(textHour)
                if (textDay > 0) {
                  
                
                    document.getElementById('day_comp_count_$comp[$compId]').innerText = textDay;
                }
                if (textHour > 0) {
                    
                   document.getElementById('hour_comp_count_$comp[$compId]').innerText = textHour;
                }
                if (textMin > 0) {
                    
                   document.getElementById('mins_comp_count_$comp[$compId]').innerText = textMin;
                }
                if (textSec > 0) {
                   
                   document.getElementById('secs_comp_count_$comp[$compId]').innerText = textSec;
                }

              
              
                
                
               
                 } , 1000)
    </script>"; ?>
                   </div>
                  
                   <!-----END SIGNLE CHALLENGE----------->
         <?php    }
          }

        }
    }
          ?>
                 
             </div>

     </section>
     <!----------------- END BLOG PAGE-------------------->



     <?php  
 include $templates . '/footer.php';
?>