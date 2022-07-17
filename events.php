<?php  
  
 

  $pageTitle = "صفحة الفعاليات";
  include 'init.php';
  
  ?>


        <!----------------- HEROAREA-------------------->
        <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/literary-05.jpg') center / cover no-repeat;" >
            <div class="flex-col">
                <h1 class="headline--main-bg">صفحة الفعاليات</h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->

     <!----------------- BLOG PAGE-------------------->
     <div class="mt-5"></div>
     <section class="main--blog__div container-sm">
         <div class="d-grid grid-blog">
             <div class="g-col-2 ">
             <?php    
               
               $events = selectAll("published_events");
               if (!empty($events)) {

              
               $randomEventNum = array_rand($events);
            
               ?>
              <div class="img--div__info">
                    <img src="<?php  echo $events[$randomEventNum]['event_image'] ? BASE_URL . '/admin/assets/images/' . $events[$randomEventNum]['event_image'] : './images/blog/flat-illustration-people-04.jpg'  ?>" alt="">
                </div>

                <div class="info--div__info">
                    <h1 class="headline--blog__main"> <?php  echo $events[$randomEventNum]['event_title']    ?> </h1>
                    <p class="mian--paragraph mt-1">  <?php  echo $events[$randomEventNum]['event_body']    ?> </p>

                    <div class="author__post d-flex-c mt-1">
               
                 <div class="user__info"> 
                     <h1 class="headline--userauthor">  <?php  echo $events[$randomEventNum]['event_author']    ?> نشر بواسطة </h1>
                    <!-- <p class="subheadline--userauthor">Adiminstrator At Publ</p> -->
                    </div>
                    </div>
                </div>
             </div>
             
         </div>


         <div class="mt-5"></div>
         <div class="blogpost__div">
             <div class="text-center searching__div">
             <form method="POST" >
                 <div class="search__single--div">
                     <input name="search_query" type="text" class="search-input">
                     <button type="submit" name="search_event" value="Search"  class="search_query-btn">Search</button>
                 </div>
            </form>     
             </div>
             <div class="mt-5"></div>
             <div class="main--events__div ">
             <div class="mt-4"></div>
                 <h1 class="mb-4 headline--main-2 text-right" > الفعاليات </h1>
                <div class="d-grid">
                    
                 <!-------SINGLE EVENT---------->
                 <?php  
                  $searchedQuery;

                  if (isset($_POST['search_event']  ) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                      $searchQu =  $_POST['search_query'];
                    $searchedQuery = searchDb("published_events" , "event_title" , array() , $searchQu , '5' );
                    
                  }
                  if (!empty($searchedQuery)) {
              foreach($searchedQuery as $eventSing) {       ?>
          <div class="event-col-2">
             

            
                      <div class="single--event__div">
                          <img src="<?php echo $eventSing['event_image'] ? BASE_URL . '/admin/assets/images/' . $eventSing['event_image'] : './images/events/diana-parkhouse-BOoPffmIwKA-unsplash.jpg'  ?>" alt="" class="single--event__img">

                          <div class="event__info--div p-1  mt-3">
                              <h1 class="headline--main-2"> <?php echo $eventSing['event_title'] ?> </h1>
                              
                              <p class="mian--paragraph-md mt-1"> <?php echo $eventSing['event_body'] ?> </p>
                              <a href="single-event.php?eventId=<?php echo $eventSing['event_id']  ?>">
                              <button class="btn-heroarea-btn mt-1" style="cursor:pointer;" > لرؤية المزيد </button>
                              </a>
                          </div>
               
                           </div>
        <?php  if ($eventSing['event_status'] == 'published') { ?>
                  <div class="single--event__timeleft">
                      <div class="flex-row">

                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="day_event_count_<?php echo $eventSing['event_id'] ?>" >00</h1>
                              </div>
                              <p class="text-white" >Days</p>
                          </div>
                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="hour_event_count_<?php echo $eventSing['event_id'] ?>" >00</h1>
                                  
                              </div>
                              <p class="text-white" >Hours</p>
                          </div>
                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="mins_event_count_<?php echo $eventSing['event_id'] ?>" >00</h1>
                                 
                              </div>
                              <p class="text-white" >Minitues</p>
                          </div>

                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="secs_event_count_<?php echo $eventSing['event_id'] ?>" >00</h1>
                                
                              </div>
                              <p class="text-white" >Seconds</p>
                          </div>


                      </div>

                      
                  </div>
                 <?php  } ?>
                   </div>

                   <?php 
                 
                 $evntId = 'event_id';
                 $evntDate = 'event_date';
                 $evntStatus = 'event_status';
              $correctCal =   $eventSing[$evntStatus] == 'published' ? "$eventSing[$evntDate]" : null;
             
              
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
                   document.getElementById('day_event_count_$eventSing[$evntId]').innerText = textDay;
                }
                if (textHour > 0) {
                   document.getElementById('hour_event_count_$eventSing[$evntId]').innerText = textHour;
                }
                if (textMin > 0) {
                   document.getElementById('mins_event_count_$eventSing[$evntId]').innerText = textMin;
                }
                if (textSec > 0) {
                   document.getElementById('secs_event_count_$eventSing[$evntId]').innerText = textSec;
                }

              
              
                
                
               
                 } , 1000)
    </script>"; ?>

           <?php   }
                  } else {
                    $events = selectAll("published_events" );
                    foreach($events as $event) { 
                        if ($event['event_status'] == 'published') { ?>
                       
                      
                      <div class="event-col-2">
                     
                      <div class="single--event__div">
                          <img src="<?php echo $event['event_image'] ? BASE_URL . '/admin/assets/images/' . $event['event_image'] : './images/events/diana-parkhouse-BOoPffmIwKA-unsplash.jpg'  ?>" alt="" class="single--event__img">

                          <div class="event__info--div p-1  mt-3">
                         
                              <h1 class="headline--main-2"> <?php echo $event['event_title'] ?> </h1>
                             
                              <p class="mian--paragraph-md mt-1"> <?php echo $event['event_body'] ?> </p>
                              <a href="single-event.php?eventId=<?php echo $event['event_id']  ?>">
                              <button class="btn-heroarea-btn mt-1" style="cursor:pointer;" >لرؤية المزيد </button>
                              </a>
                          </div>
               
                           </div>
              <?php  
              if ($event['event_status'] == 'published') { ?>
                      <div class="single--event__timeleft">
                      <div class="flex-row">

                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="day_event_count_<?php echo $event['event_id'] ?>" >00</h1>
                              </div>
                              <p class="text-white" >Days</p>
                          </div>
                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="hour_event_count_<?php echo $event['event_id'] ?>">00</h1>
                                  
                              </div>
                              <p class="text-white" >Hours</p>
                          </div>
                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="mins_event_count_<?php echo $event['event_id'] ?>">00</h1>
                                 
                              </div>
                              <p class="text-white" >Minitues</p>
                          </div>

                          <div class="single--timeleft__div">
                              <div class="circle--time__div">
                                  <h1 class="headline--main-2" id="secs_event_count_<?php echo $event['event_id'] ?>">00</h1>
                                
                              </div>
                              <p class="text-white" >Seconds</p>
                          </div>


                      </div>

                      
                  </div>
       <?php       }
              ?>
              
                
                   </div>
                  <?php 
                 
                  $evntId = 'event_id';
                  $evntDate = 'event_date';
                  $evntStatus = 'event_status';
               $correctCal =   $event[$evntStatus] == 'published' ? "$event[$evntDate]" : null;
              
               
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
                    document.getElementById('day_event_count_$event[$evntId]').innerText = textDay;
                 }
                 if (textHour > 0) {
                    document.getElementById('hour_event_count_$event[$evntId]').innerText = textHour;
                 }
                 if (textMin > 0) {
                    document.getElementById('mins_event_count_$event[$evntId]').innerText = textMin;
                 }
                 if (textSec > 0) {
                    document.getElementById('secs_event_count_$event[$evntId]').innerText = textSec;
                 }

               
               
                 
                 
                
                  } , 1000)
     </script>"; ?>
          

                  <?php  }
                    }
                 
                  
                     
                        ?>

                    
                 <!-------END SINGLE EVENT---------->
                    
                 
                
                </div>
                <div class="mt-4"></div>
                 <h1 class="mb-4 headline--main-2 text-right" > الفعاليات القديمة</h1>

                  <?php  
          foreach($events as $event) {
             if ($event['event_status'] == 'draft') { ?>
                 <div class="event-col-2">
                     
                     <div class="single--event__div">
                         <img src="<?php echo $event['event_image'] ? BASE_URL . '/admin/assets/images/' . $event['event_image'] : './images/events/diana-parkhouse-BOoPffmIwKA-unsplash.jpg'  ?>" alt="" class="single--event__img">

                         <div class="event__info--div p-1  mt-3">
                        
                             <h1 class="headline--main-2"> <?php echo $event['event_title'] ?> </h1>
                            
                             <p class="mian--paragraph-md mt-1"> <?php echo $event['event_body'] ?> </p>
                             <a href="single-event.php?eventId=<?php echo $event['event_id']  ?>">
                             <button class="btn-heroarea-btn mt-1" style="cursor:pointer;" >لرؤية المزيد </button>
                             </a>
                         </div>
              
                          </div>
             <?php  
             if ($event['event_status'] == 'published') { ?>
                     <div class="single--event__timeleft">
                     <div class="flex-row">

                         <div class="single--timeleft__div">
                             <div class="circle--time__div">
                                 <h1 class="headline--main-2" id="day_event_count_<?php echo $event['event_id'] ?>" >00</h1>
                             </div>
                             <p class="text-white" >Days</p>
                         </div>
                         <div class="single--timeleft__div">
                             <div class="circle--time__div">
                                 <h1 class="headline--main-2" id="hour_event_count_<?php echo $event['event_id'] ?>">00</h1>
                                 
                             </div>
                             <p class="text-white" >Hours</p>
                         </div>
                         <div class="single--timeleft__div">
                             <div class="circle--time__div">
                                 <h1 class="headline--main-2" id="mins_event_count_<?php echo $event['event_id'] ?>">00</h1>
                                
                             </div>
                             <p class="text-white" >Minitues</p>
                         </div>

                         <div class="single--timeleft__div">
                             <div class="circle--time__div">
                                 <h1 class="headline--main-2" id="secs_event_count_<?php echo $event['event_id'] ?>">00</h1>
                               
                             </div>
                             <p class="text-white" >Seconds</p>
                         </div>


                     </div>

                     
                 </div>
      <?php       }
             ?>
             
               
                  </div>
                 <?php 
                
                 $evntId = 'event_id';
                 $evntDate = 'event_date';
                 $evntStatus = 'event_status';
              $correctCal =   $event[$evntStatus] == 'published' ? "$event[$evntDate]" : null;
             
              
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
                console.log(textDay)
                const textHour = Math.floor((gapDate % day) / hour);
                const textMin = Math.floor((gapDate % hour) / minute);
                const textSec = Math.floor((gapDate % minute) / second);
   
                if (textDay > 0) {
                   document.getElementById('day_event_count_$event[$evntId]').innerText = textDay;
                }
                if (textHour > 0) {
                   document.getElementById('hour_event_count_$event[$evntId]').innerText = textHour;
                }
                if (textMin > 0) {
                   document.getElementById('mins_event_count_$event[$evntId]').innerText = textMin;
                }
                if (textSec > 0) {
                   document.getElementById('secs_event_count_$event[$evntId]').innerText = textSec;
                }

              
              
                
                
               
                 } , 1000)
    </script>"; ?>
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