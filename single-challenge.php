<?php
  
  
  $pageTitle = "Single Challenge";
  include 'init.php';

  $compid = isset($_GET['compId']) && is_numeric($_GET['compId']) ? intval($_GET['compId']) : 0;

   $selectedComp = selectOne("published_competions" , array(
       'comp_id' => $compid
   ));
   

   if (isset($_POST['add_answer'])) {
    
     if (empty($_SESSION['join_team_id'])) {
       array_push($errors , "No Team Assigned");
     }
    //  if (empty($_SESSION['answ_author'])) {
    //    array_push($errors , "No Username Assigned");
    //  }
    $checkAlreadyAns = selectOne("published_answers" , array(
        'answ_ref_team' =>  $_SESSION['join_team_id'],
        'answ_ref_ques' => $_POST['answ_ref_ques'] 
    ));
  if (!empty($checkAlreadyAns)) {
        array_push($errors , "You Have Already Answered This Question");
    }
  if (empty($_FILES['answer_image']['name'])) {
      array_push($errors , "No Image Uplaoded");
  }
    if (!empty($_FILES['answer_image']['name'])) {
        $image_name = time() . '_' . $_FILES['answer_image']['name'];
        $destination = ROOT_PATH_MAIN . "/admin/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['answer_image']['tmp_name'], $destination);

        if ($result) {
           $_POST['answer_image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    }  else {
        unset($_POST['answer_image']);
    } 
  if (count($errors) == 0) {
      unset($_POST['add_answer']);
      
      $_POST['answ_ref_team'] = $_SESSION['join_team_id'];
      $_POST['answ_author'] =  $_SESSION['username'];
     
     
    $post_id = create("published_answers", $_POST);
  }

   }

   $relatedGalleyImages = selectAll("publsihed_gallery" , array(
    'img_rel_id' => $compid,
    'img_rel_type' => 'competion'
));

   if ( $selectedComp ) { ?>
 <!----------------- HEROAREA-------------------->
 <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/literary-01.jpg') center / cover no-repeat ;" >
            <div class="flex-col">
                <h1 class="headline--main-bg">  <?php  echo $selectedComp['comp_title']  ?> </h1>
            </div>
        </section>

        <div class="mt-5"></div>
     <section class="main--blog__div container-sm">
         <div class="d-grid grid-blog">
             <div class="g-col-2 ">
                 <div class="single--post__div">
                 <div class="img--div__info">
                    <img src="<?php echo $selectedComp['comp_image'] ? BASE_URL . '/admin/assets/images/' .  $selectedComp['comp_image'] : './images/blog/flat-illustration-people-04.jpg'  ?>" alt=""  >
                </div>

                <div class="info--div__info mt-1">
                    <h1 class="headline--blog__main"> <?php echo $selectedComp['comp_title']  ?> </h1>
                    <?php  
                if (!empty( $relatedGalleyImages)) { ?>
                                  <!------SLIDER JS-------->
                                  <div class="body__div__slider">
                    <div class="container-slider">

                <!-- Slider Container with images...  -->
                <div class="slides"></div>

                <!--  Previous Button  -->
                <button class="btn-slide prev">
                <img src="https://imgur.com/SUyRJqI.png" alt="prevBtn" />
                </button>

                <!--  Next Button  -->
                <button class="btn-slide next">
                <img src=" https://imgur.com/M6rDsRR.png" alt="nextBtn" />
                </button>

                <!--  Container for dots  -->
                <div class="container-dots"></div>
                </div>
                    </div>
<!------END SLIDER JS-------->
            <?php    }
                ?>
                
                    <p class="mian--paragraph mt-1"> <?php echo $selectedComp['comp_content']  ?>  </p>

                    <div class="author__post d-flex-c mt-1">
                
                 <div class="user__info"> 
                     <h1 class="headline--userauthor">  <?php echo $selectedComp['comp_author']  ?> نشر بواسطة </h1>
                    <!-- <p class="subheadline--userauthor">Adiminstrator At Publ</p> -->
                    </div>
                    </div>
                </div>
                
                
                 </div>
                
            <div class="single--sidebar__posts mt-2">
                <div class="card__single--div">
                <h1 class="headline--card">المسابقات الشعبية  </h1>
                <?php  
                $popularCompetions = selectAllLimitAndOrder("published_competions" , array(
                    'comp_id' => $compid
                ) , '!=' , 'RAND()' , 5);
                foreach($popularCompetions as $popCompetion) { ?>
                <a href="single-challenge.php?compId=<?php echo $popCompetion['comp_id']  ?>">
  <div class="card--childs__div mt-3">
                    <div class="d-flex">
                    <img src="<?php echo $popCompetion['comp_image'] ? BASE_URL . '/admin/assets/images/' .  $popCompetion['comp_image'] : './images/blog/flat-illustration-people-04.jpg'  ?>" alt="" class="popular__post--img">
                    <div class="info__about--post mx-2">
                        <h1 class="subheadline--card"> <?php echo $popCompetion['comp_title'] ?> </h1>
                        <p class="mian--paragraph"> <?php echo substr($popCompetion['comp_content'] , 0 , 100) . '...'; ?> </p>
                    </div>
                    </div>
                </div>
                </a>
           <?php     }
                ?>
              
                </div>
               
            </div>
                 
 
             </div>
             
             
         </div>

         <div class="mt-5"></div>
      <!-------------QUESTIONS AREA START--------------->
        <h1 class="text-center headline--main-2">الاسئلة الخاصة بالمسابقة</h1>
        <?php  include  ROOT_PATH_MAIN . '/includes/templates/formErrors.php'  ?>
        <div class="py-5"></div>
        <div class="main--question__div py-2">
            <div class="d-grid grid_questions">
                <div class="g-col-3">
            <?php  
             $userId =     is_numeric($_SESSION['id']) ? intval($_SESSION['id']) : 0;
            $userJOinedTeam = selectAllOneCol("joinedusers" , "user_joined_team" , array(
                'user_id' => $userId,
                'user_joined_team' => 1
            ) );
          
            
            if (!empty($userJOinedTeam)) {
                $questions = selectAll('published_questions' , array(
                    'ques_rel_comp' => $compid
                ));
    ?>
         
            <?php   foreach($questions as $ques) { ?>
     
                  <!----------SINGLE QUESITON------------>
                  <div class="single--grid__div flex-col ">
                         
                           <img src="<?php echo $ques['ques_image'] ? BASE_URL . '/admin/assets/images/' . $ques['ques_image'] : './images/challenges/chall_image.jpg'  ?>" alt="" class="question__image">
                           <div class="mt-3"></div>
                           <h1 class="headline--question"> <?php echo $ques['ques_name']  ?>  </h1>
                           <h5 class="subheadline--question "><?php echo $ques['ques_desc']  ?></h5>
                          
                               <h4 class="small-headline__question mt-1">عدد النقاط: <?php echo $ques['ques_points']  ?></h4>
                             
    
                               <div class="popup_div_sing">
                               
                                  <h1 class="headline--main-2-sm mt-2">تحميل اجابة السؤال</h1>
                                 
                                  <div class="mt-2"></div>
                                  <form action="" method="POST"  enctype="multipart/form-data"  >
    
                                      <input type="hidden" name="answ_ref_ques" value="<?php echo $ques['ques_id'] ?>"  >
                                      <input type="file" name="answer_image" class="upload_input_file" > <br>
                                      <input type="submit" value="ارسال"  class="question_input" name="add_answer" >
                                  </form>
                               </div>
    
                        </div>
                        
                        <?php  
                        
                        ?>
     <!----------END SINGLE QUESITON------------>
    
             <?php  }
            }  
            
            else { ?>
           <p class="mian--paragraph mb-4">  للمشاركة في المسابقات يجب عليك انشاء او الانضمام فريق  للدخول <a href="teams.php">اضغط هنا</a></p>
          <?php  }
         

            ?>
               
                    
               </div>
            </div>
               
        </div>

          <!-------------QUESTIONS AREA END--------------->
       <!-----------------END HEROAREA-------------------->
   <?php }
    else { ?>
   

   
         <!----------------- HEROAREA-------------------->
 <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/literary-01.jpg') center / cover no-repeat ;" >
            <div class="flex-col">
                <h1 class="headline--main-bg"> This Id Does Not Exist </h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->
       <?php }

  ?>

<script>
      
      const slides = document.querySelector(".slides");
const containerDots = document.querySelector(".container-dots");

var slideIndex = 1;

// Images container
const images = [
    <?php
    $imgLink = "img_link";
    $Base_Url = BASE_URL;
    foreach($relatedGalleyImages as $postImg) { 
        echo "{src:  '$Base_Url/admin/assets/images/$postImg[$imgLink]' },";
     }?>
 // { src: "https://rb.gy/ohx0bd" },
//   { src: "https://rb.gy/gggxy8" },
//   { src: "https://rb.gy/z2a0fy" },
//   { src: "https://rb.gy/nsefjh" },
//   { src: "https://rb.gy/dssu2a" }
];

// Adding images and dots to the Respective Container
images.map((img) => {
  // Creating Image Element and adding src of that image
  var imgTag = document.createElement("img");
  imgTag.src = img.src;

  // Creating Dot (div) Element adding 'dot' class to it
  var dot = document.createElement("div");
  dot.classList.add("dot");

  //  Appending the image and dots to respective container
  slides.appendChild(imgTag);
  containerDots.appendChild(dot);
});

// Adding EventListener to All dots so that when user click on it trigger move dots;
const dots = containerDots.querySelectorAll("*").forEach((dot, index) => {
  dot.addEventListener("click", () => {
    moveDot(index + 1);
  });
});

// It helps to move the dot, it take "index" as parameter and update the slideIndex
function moveDot(index) {
  slideIndex = index;
  updateImageAndDot();
}

// Update Image And Slide Dot according to the [data-active]
function updateImageAndDot() {
  /* ...........Updating Image.............. */
  const activeSlide = slides.querySelector("[data-active]");
  slides.children[slideIndex - 1].dataset.active = true;
  activeSlide && delete activeSlide.dataset.active;

  /* ...........Updating Dots.............. */
  const activeDot = containerDots.querySelector("[data-active]");
  containerDots.children[slideIndex - 1].dataset.active = true;
  activeDot && delete activeDot.dataset.active;
}

// Slide Next Button Click Event
const nextSlide = () => {
  // it will update the slideIndex on the basis of the images.length as it gets greater than images.length, this will initialize to the 1
  if (slideIndex !== images.length) {
    ++slideIndex;
  } else if (slideIndex === images.length) {
    slideIndex = 1;
  }
  updateImageAndDot();
};

const nextBtn = document.querySelector(".next");
nextBtn.onclick = nextSlide;

// Slide Previous Button Click Event
const prevSlide = () => {
  // It will check if the slideIndex is less equal to 1 then change it to the images.legnth, it will enable infinite scrolling
  if (slideIndex !== 1) {
    --slideIndex;
  } else if (slideIndex === 1) {
    slideIndex = images.length;
  }
  updateImageAndDot();
};

const prevBtn = document.querySelector(".prev");
prevBtn.onclick = prevSlide;

// Show the Image as the Page Loads;
updateImageAndDot();

window.onload = function () {
  var loadTime =
    window.performance.timing.domContentLoadedEventEnd -
    window.performance.timing.navigationStart;
  console.log("Page load time is " + loadTime);
};
  </script>
  
  <?php  
 include $templates . '/footer.php';
?>

       