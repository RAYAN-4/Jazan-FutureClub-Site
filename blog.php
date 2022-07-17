<?php  
  
 

  $pageTitle = "صفحة المدونة";
  include 'init.php';


  
  
  ?>

        <!----------------- HEROAREA-------------------->
        <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/literary-01.jpg') center / cover no-repeat ;" >
            <div class="flex-col">
                <h1 class="headline--main-bg">صفحة المدونة</h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->

     <!----------------- Search Results-------------------->
     <div class="mt-5"></div>
     <!----------------- End Search Results-------------------->

     <!----------------- BLOG PAGE-------------------->
     <div class="mt-5"></div>
     <section class="main--blog__div container-sm">
         <div class="d-grid grid-blog">
             <div class="g-col-2 ">
                 <?php    
               
                 $posts = selectAll("published_posts");
                 if (!empty($posts)) {

                
                 $randomPostNum = array_rand($posts);
              
                 ?>
                <div class="img--div__info">
                    <img src="<?php  echo $posts[$randomPostNum]['image_post'] ? BASE_URL . '/admin/assets/images/' . $posts[$randomPostNum]['image_post'] : './images/blog/flat-illustration-people-04.jpg'  ?>" alt="">
                </div>

                <div class="info--div__info">
                    <h1 class="headline--blog__main"> <?php  echo $posts[$randomPostNum]['title_post']    ?> </h1>
                    <p class="mian--paragraph mt-1">  <?php  echo $posts[$randomPostNum]['body_post']    ?> </p>

                    <div class="author__post d-flex-c mt-1">
               
                 <div class="user__info"> 
                     <h1 class="headline--userauthor">  <?php  echo $posts[$randomPostNum]['author_post']    ?>  نشر بواسطة </h1>
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
                     <button type="submit" name="search_blog" value="Search" class="search_query-btn">Search</button>
                 </div>
                 </form>
                
             </div>
             <div class="mt-4"></div>
             <div class="d-grid grid-blogging">
                 <div class="g-col-3">
                     <?php  
                     $searchedQuery;

                     if (isset($_POST['search_blog']  ) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                         $searchQu =  $_POST['search_query'];
                       $searchedQuery = searchDb("published_posts" , "title_post" , array() , $searchQu , '5' );
                       
                     }

                       if (!empty($searchedQuery)) {
                          foreach($searchedQuery as $postQuery) {
                             
                               ?>
        <!--------SIGNLE POST---------->
                            <div class="single__post-blog"  >
                                <div class="background-thum__div" style="background: linear-gradient(rgba(0,0,0,0.8) , rgba(0,0,0,0.2)) ,url(<?php echo $postQuery['image_post'] ? BASE_URL . '/admin/assets/images/' . $postQuery['image_post'] : './images/posts/anthony-delanoix-CFi7_hCXecU-unsplash.jpg'  ?>) center / cover no-repeat;" >
                                   <div class="inside__bloginfo flex-col">
                                       <h1 class="headline--main__post"> <?php echo $postQuery['title_post']  ?> </h1>
                                       <p class="subheadline--mian__post mt-1"><?php echo substr($postQuery['body_post'], 0 , 200) . '...';   ?></p>
                                       <a href="single-post.php?postId=<?php echo $postQuery['id_post']  ?>">
                                       <button class="btn-heroarea-btn mt-1">See More</button>
                                   </a>
                                      
                                   </div>
                               </div>
                           </div>
       
                  <!--------END SIGNLE POST---------->
                         <?php }
                     
                    } else {
                        
                        foreach($posts as $post) { 
                            
                            ?>

                            <!--------SIGNLE POST---------->
                            <div class="single__post-blog"  >
                                <div class="background-thum__div" style="background: linear-gradient(rgba(0,0,0,0.8) , rgba(0,0,0,0.2)) ,url(<?php echo $post['image_post'] ? BASE_URL . '/admin/assets/images/' . $post['image_post'] : './images/posts/anthony-delanoix-CFi7_hCXecU-unsplash.jpg'  ?>) center / cover no-repeat;" >
                                   <div class="inside__bloginfo flex-col">
                                       <h1 class="headline--main__post"> <?php echo $post['title_post']  ?> </h1>
                                       <p class="subheadline--mian__post mt-1"><?php echo substr($post['body_post'] , 0 , 200 ) . '...'; ?></p>
                                       <a href="single-post.php?postId=<?php echo $post['id_post']  ?>">
                                       <button class="btn-heroarea-btn mt-1">See More</button>
                                   </a>
                                      
                                   </div>
                               </div>
                           </div>
       
                  <!--------END SIGNLE POST---------->
       
       
                        <?php     }
                    }
                    
                }
                     ?>

              
            
         </div>
     </section>
     <!----------------- END BLOG PAGE-------------------->


     <?php  
 include $templates . '/footer.php';
?>