<?php
  
  
  $pageTitle = "Single Event";
  include 'init.php';

  $eventid = isset($_GET['eventId']) && is_numeric($_GET['eventId']) ? intval($_GET['eventId']) : 0;

   $selectedEvent = selectOne("published_events" , array(
       'event_id' => $eventid
   ));
   $relatedGalleyImages = selectAll("publsihed_gallery" , array(
    'img_rel_id' => $eventid,
    'img_rel_type' => 'event'
));

   if ( $selectedEvent ) { ?>
 <!----------------- HEROAREA-------------------->
 <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/literary-01.jpg') center / cover no-repeat ;" >
            <div class="flex-col">
                <h1 class="headline--main-bg">  <?php  echo $selectedEvent['event_title']  ?> </h1>
            </div>
        </section>

        <div class="mt-5"></div>
     <section class="main--blog__div container-sm">
         <div class="d-grid grid-blog">
             <div class="g-col-2 ">
                 <div class="single--post__div">
                 <div class="img--div__info">
                    <img src="<?php echo $selectedEvent['event_image'] ? BASE_URL . '/admin/assets/images/' .  $selectedEvent['event_image'] : './images/blog/flat-illustration-people-04.jpg'  ?>" alt=""  >
                </div>

                <div class="info--div__info mt-1">
                    <h1 class="headline--blog__main"> <?php echo $selectedEvent['event_title']  ?> </h1>
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

                    <p class="mian--paragraph mt-1"> <?php echo $selectedEvent['event_body']  ?>  </p>

                    <div class="author__post d-flex-c mt-1">
                   
                 <div class="user__info"> 
                     <h1 class="headline--userauthor">  <?php echo $selectedEvent['event_author']  ?> نشر بواسطة </h1>
                    <!-- <p class="subheadline--userauthor">Adiminstrator At Publ</p> -->
                    </div>
                    </div>
                </div>
                
                
                 </div>
                
            <div class="single--sidebar__posts">
                <div class="card__single--div">
                <h1 class="headline--card"> الفعاليات الشعبية </h1>
                <?php  
                $popularEvents = selectAllLimitAndOrder("published_events" , array(
                    'event_id' => $eventid
                ) , '!=' , 'RAND()' , 5);
                foreach($popularEvents as $popEvent) { ?>
                <a href="single-event.php?eventId=<?php echo $popEvent['event_id']  ?>">
  <div class="card--childs__div mt-3">
                    <div class="d-flex">
                    <img src="<?php echo $popEvent['event_image'] ? BASE_URL . '/admin/assets/images/' .  $popEvent['event_image'] : './images/blog/flat-illustration-people-04.jpg'  ?>" alt="" class="popular__post--img">
                    <div class="info__about--post mx-2">
                        <h1 class="subheadline--card"> <?php echo $popEvent['event_title'] ?> </h1>
                        <p class="mian--paragraph"> <?php echo substr($popEvent['event_body'] , 0 , 100) . '...' ?> </p>
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

       