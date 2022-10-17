<?php
//for best results to use the search functionality, your video files should be descriptive and clean text no special characters

//ffmpeg.php script must be run to create thumbnails. This system uses three thumbnails of each video randomly selected each time it loads.

//the github source code has the directory folders configured properly to use the code as it exists here


//get next data from request if load more button was pushed
if($_REQUEST){
    if(isset($_REQUEST['next'])) {
         $next = intval($_REQUEST['next']);
    }
    
}
//set arbitrary value for next
else $next = 1;
//variables limitUp and limitDown are set to allow PHP to show a maximum of 50 files based on the next variable
//next variable increases with each file that is successfully shown via the count variable
$limitUp = $next + 50;
if ($next > 50){
$limitDown = $next;
}
else $limitDown = 1;

//Locate the files
$arrFiles = array();
$newestFiles = array();
$arrFiles = glob('assets/video/*.mp4'); //regular files
$newestFiles = glob('assets/video/new/*.mp4'); //new files

//names for certain things
$title = "New World Next Week Video Archive Site";
$descr = " Video CMS built by Jason Nobles for Alternative Media News Program New World Next Week Videos With James Corbett and James Evan Pilato";
$keywords = "video cms, james corbett, james evan pilato, new world next week";
$icon ="assets/img/icon.png";
$heading ="New World  <i class='fa-solid fa-earth-americas'></i>  Next Week";
$subheading ="With James Corbett & James Evan Pilato";

?>

<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta id="testViewport" name="viewport" content="">
        <title><?php echo $title; ?></title>
        <meta name="author" content="Jason Nobles">
        <meta name="description" content="<?php echo $descr; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>">
        <link rel="shortcut icon" href="<?php echo $icon; ?>" >
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/jqueryconfirm.min.css" rel="stylesheet">
        <link href="assets/css/cover.css" rel="stylesheet">

        

    </head>
    
    <body class="d-flex h-100 text-center text-white bg-dark">
    
      <header class="mb-auto"></header>

    <!--Page Title-->

    <main class="container py-5">
       <noscript>
           <div class="alert alert-dark" role="alert">
                This Site is More Enjoyable with Javascript Enabled. While It Works Without Javascript, We Use Javascript To Make It More Cozy and Succinct. Kindly Consider Enabling Javascript for the Very Best Experience.
           </div>
        </noscript>
        <!--Info Bar -->
        <nav class="navbar bg-dark">
          <div class="container">
            <a id="info" class="navbar-brand" style="text-decoration: none;
          color: #008CBA;" href="#">
                <i class="fa-solid fa-hand-wave"></i>
              </a>
          </div>
        </nav>

        
      <a href="/" style="text-decoration:none;" class="text-light"><h1><?php echo $heading; ?></h1>
        <p class="lead"><?php echo $subheading; ?></p></a>

        
            <!--search bar-->
            <div class="row height d-flex justify-content-center align-items-center">

              <div class="col-md-6">
                <form method="post">
                    <div class="search text-dark">
                      <i  class="fa fa-search"></i>
                      <input id="searchTxt" name='searchTxt' type="text" class="form-control" placeholder="Type Your Query">
                      <input type='hidden' name='type' value="search" >
                      <button id="searchBtn" class="btn btn-primary">Search</button>
                    </div>
                  </form>
                                        


              </div>

            </div>
        <style>
            
            .row {
                margin: 0 auto;
                }
        
        </style>

        
      <!-- dynamically provided content-->

      <div id="videoContent" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" data-masonry='{"percentPosition": true }'>
          
        
          
        <?php
          // this area is concerned with new files
          $loopCount = 1;
          $count = 1;
          foreach ($newestFiles as $file) {
            
                $folder = rand(1,3);
                $id = $count;
                $fileName = str_replace('.mp4','', $file); // dumping mp4
                $fileName = str_replace('assets/video/new/','', $fileName); //dumping directories
                $fileText = str_replace('-',' ', $fileName); //description of video
                $thumb = "thumb/$folder/$fileName"; //pretty urls rewritten in nginx
                $mp4 = "mp4/new/$fileName"; //pretty urls rewritten in nginx

              
                //checking if a search is occuring. Searching the fileText
                if ($_POST && $_POST['type'] === 'search'){
                $searchTxt = $_POST['searchTxt'];
                $pos = stripos($fileText, $searchTxt);
                if ($pos !==false) {
              
              ?>
          
              <div id="<?php echo $id; ?>" class="col-sm-6 col-lg-3 mb-4">
                  <a href="<?php echo $mp4; ?>" class="text-decoration-none text-dark ">          
                    <div class="text-center">
                        <div class="card">
                            <img src="<?php echo $thumb; ?>" class="card-img-top" alt="..." >
                            <div class="card-body">
                                <h4 class="card-title">New Episode</h4>
                                <p class="card-text" data-id='<?php echo $id; ?>'><?php echo $fileText; ?></p>
                            </div>
                        </div>
                    </div>
                  </a>  
                </div>
            <?php
                }
                }
              else{ 
          
                        if ($next < 50){ ?>
                
                          <div id="<?php echo $id; ?>" class="col-sm-6 col-lg-3 mb-4">
                              <a href="<?php echo $mp4; ?>" class="text-decoration-none text-dark ">          
                                <div class="text-center">
                                    <div class="card">
                                        <img src="<?php echo $thumb; ?>" class="card-img-top" alt="..." >
                                        <div class="card-body">
                                            <h5 class="card-title">New Episode</h5>
                                            <p class="card-text" data-id='<?php echo $id; ?>'><?php echo $fileText; ?></p>
                                        </div>
                                    </div>
                                </div>
                              </a>  
                            </div>
          
            <?php
              $count++;
              $next++;
              $loopCount++;
                    }
              }
          }
          ?>

          
          
          <?php

          //this area displays regular files
          foreach ($arrFiles as $file) {
              

            
                $folder = rand(1,3);
                $id = $count;
                $fileName = str_replace('.mp4','', $file); // dumping mp4
                $fileName = str_replace('assets/video/','', $fileName); //dumping directories
                $fileText = str_replace('-',' ', $fileName); //description of video
                $thumb = "thumb/$folder/$fileName"; //pretty urls rewritten in nginx actual location is different
                $mp4 = "mp4/$fileName"; //pretty urls rewritten in nginx actual location is different

              
            //checking if a search is occuring. Searching the fileText
            if ($_POST && $_POST['type'] === 'search'){
                $searchTxt = $_POST['searchTxt'];
                $pos = stripos($fileText, $searchTxt);
                if ($pos !==false) {
              ?>

                    <div id="<?php echo $id; ?>" class="col-sm-6 col-lg-3 mb-4">
                      <a href="<?php echo $mp4; ?>" class="text-decoration-none text-dark ">          
                        <div class="text-center">
                            <div class="card">
                                <img src="<?php echo $thumb; ?>" class="card-img-top" alt="..." >
                                <div class="card-body">
                                    <p class="card-text" data-id='<?php echo $id; ?>'><?php echo $fileText; ?></p>
                                </div>
                            </div>
                        </div>
                      </a>  
                    </div>
            <?php
              }
              }
            else { 
          
                if ($id > $limitUp){            
                    $count++;
                    continue;
                }
                else if ($id < $limitDown) {            
                    $count++;
                    continue;
                }
                else if ($loopCount > 50) {            
                    $count++;
                    continue;
                }
                else{
          
          
          ?>

                    <div id="<?php echo $id; ?>" class="col-sm-6 col-lg-3 mb-4">
                      <a href="<?php echo $mp4; ?>" class="text-decoration-none text-dark ">          
                        <div class="text-center">
                            <div class="card">
                                <img src="<?php echo $thumb; ?>" class="card-img-top" alt="..." >
                                <div class="card-body">
                                    <p class="card-text" data-id='<?php echo $id; ?>'><?php echo $fileText; ?></p>
                                </div>
                            </div>
                        </div>
                      </a>  
                    </div>
          <?php
                }
            }
            $count++;
            $next++;
           } 
          
          ?>
        
</div>
        <style>
        
            .container {
                  position: relative;
                }

            .center {
              position: absolute;
              top: 50%;
              width: 100%;
              text-align: center;
              font-size: 18px;
            }



            
        </style>

                <?php if (!$_POST && $_POST['type'] !== 'search'){ ?>
                    <div class="col-md-12">
                    <form style="padding: 33px;" method="get" action="https://nwnw.one">
                        <div class="text-dark">`
                          <input type='hidden' name='next' value="<?php echo $next; ?>" >
                            <div>
                                <button class="btn btn-primary btn-lg" <?php if ($next >= 407) echo "disabled";  ?> >Load More</button>
                            </div>
                        </div>
                      </form>
                </div>
            
            <?php }?>

                
        
          
        </main>
        


        <footer class="mt-auto text-white-50"><p></p></footer>
<!--      </div>-->
        
    
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/masonry.js"></script>
        <script src="assets/js/fontawesome.js"></script>
        <script src="assets/js/jqueryconfirm.js"></script>
        <script src="assets/js/imgsloaded.js"></script>
        <script> 
            
        $(document).ready(function () {
            var $container = $("#videoContent");

            //once all images are loaded refire masonry to redisplay things correctly
            $container.imagesLoaded(function () {
                $container.masonry();
            });
            
            //info bar
            $('#info').click(function (e){

                e.preventDefault();
                $.alert({
                    theme: 'dark',
                    title: 'Welcome!',
                    content: "This website is a modern searchable archive of the legendary news telecast aptly named : New World Next Week. You can reach the hosts at their respective websites. James Corbett at www.corbettreport.com and James Evan Pilato at mediamonarchy.com. The episodes are alphabetically presented based on the title of the file as was originally captured from the now defunct Corbett Report You Tube Channel. New episodes are entered manually as they become available. This application was built using PHP, Javascript and HTML5 without middleware, frameworks or platforms. For questions, concerns, comments, please email me, Jason Nobles, the developer at everydayjason@gmail.com.",
                    });
          
            });  
            
            //screen size adjustment for mobile device
            var sw = screen.width;
            var sh = screen.height;
            if ( window.matchMedia("(orientation: landscape)").matches ) {
              var fw = sh;
            } else {
              var fw = sw;
            }
            if (fw < 768) {
                var mvp = document.getElementById("testViewport");
                mvp.setAttribute("content","width=device-width,initial-scale=1");
                $container.masonry();
            }


                    });

        
            
        </script>   


    
  </body>
     
    
</html>

