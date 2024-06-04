
<?php
require_once "../login/config.php";
session_start();

if (!isset($_SESSION['idacc'])){
  if(isset($_COOKIE["idacc"])){
    $username = $_COOKIE["idacc"];
    $_SESSION['idacc'] = $username;
    $stmt = $db->prepare("select * from acc where idacc = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $_SESSION['name']= $row['name'];
  }
  else{
      $username = '';
  }  
}

?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>W0RM Homepage</title>
        <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>" />
        <link rel="icon" type="image/x-icon" href="../img/CTF-Logo.ico">
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>
    <body>
        <header>
            <?php include './components/navbar.php'; ?>
        </header>
        
      <section class="hero">
         <div class="swiper hero-slider">
            <div class="swiper-wrapper">
               <div class="swiper-slide slide" 
               style="background-image:url('./img/AdobeStock_356426229-scaled.jpeg'); ">
                  <div class="content">
                     <span>W0rm Feature</span>
                     <h3>Feature 1</h3>
                     <a href="home.php" class="btn">Home</a>
                  </div>
                  <div class="description">
                     
                     <p> 
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                        Ad et perspiciatis nisi velit reiciendis numquam consequatur necessitatibus facilis iste aspernatur 
                        laudantium nulla ex libero beatae excepturi, ratione quas facere rerum.
                     </p>
                  </div>
               </div>
   
               <div class="swiper-slide slide"
               style="background-image:url('./img/what-is-cybersecurity.jpg'); ">
                  <div class="content">
                     <span>W0rm Feature</span>
                     <h3>Feature 2</h3>
                     <a href="lectures.php" class="btn">Lectures</a>
                  </div>
                  <div class="description">
                  <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                        Ad et perspiciatis nisi velit reiciendis numquam consequatur necessitatibus facilis iste aspernatur 
                        laudantium nulla ex libero beatae excepturi, ratione quas facere rerum.</p>
                  </div>
               </div>
   
               <div class="swiper-slide slide"
               style="background-image: url('./img/img-Federal-cybersecurity-image-iStock-1420039900.jpg'); ">
                  <div class="content">
                     <span>W0rm Feature</span>
                     <h3>Feature 3</h3>
                     <a href="about.php" class="btn">About</a>
                  </div>
                  <div class="description">
                  <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                        Ad et perspiciatis nisi velit reiciendis numquam consequatur necessitatibus facilis iste aspernatur 
                        laudantium nulla ex libero beatae excepturi, ratione quas facere rerum.</p>
                  </div>
               </div>
   
               <div class="swiper-slide slide"
               style="background-image:url('./img/giphy.gif'); ">
                  <div class="content">
                     <span>W0rm Feature</span>
                     <h3>Feature 4</h3>
                     <a href="practice.php" class="btn">Practice</a>
                  </div>
                  <div class="description">  
                     <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                        Ad et perspiciatis nisi velit reiciendis numquam consequatur necessitatibus facilis iste aspernatur 
                        laudantium nulla ex libero beatae excepturi, ratione quas facere rerum.</p>
                  </div>
               </div>
   
            </div>
            <br>
            <div class="swiper-pagination"></div>
         </div>
   
      </section>

      <section class="introduction">
         <h1>W0RM - Delve Deeper Into Cyberspace</h1>
         <div class="box-container">
            <div class="box">
               <img src="../img/CTF-Logo.png" alt="Worm logo">
            </div>
            <div class="box">
               <p>
                  <span> W0RM-CTF</span>
                  gamifies learning hacking with capture-the-flag puzzles created 
                  by trusted computer security and privacy experts at <a href="https://www.ctu.edu.vn/">Can Tho University</a>
               </p>
            </div>
         </div>
      </section>

      <section class="feature-box">
         <h1>Main Feature</h1>
         <div class="box-container">
               <div class="box">
                  <img src="img/gif/graduate.gif">
                  <h3>Learning</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>
               <div class="box">
                  <img src="img/gif/online-learning.gif">
                  <h3>Practicing</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>
               <div class="box">
                  <img src="img/gif/podium.gif">
                  <h3>Competing</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>
               <div class="box">
                  <img src="img/gif/presentation.gif">
                  <h3>Developing</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>
         </div>
      </section>


      <section class="introduction">
         <h1>W0RM GYM - Training with Cyberspace</h1>
         <div class="box-container">
            <div class="box">
               <img src="../img/CTF-Logo.png" alt="Worm logo">
            </div>
            <div class="box">
               <p>
                  <span>W0RM-CTF GYM</span> is a noncompetitive practice space where you can explore and solve challenges from previously released W0rm-CTF competitions, find fresh never before revealed challenges, and build a knowledge base of cybersecurity skills in a safe environment.
                  Whether you are a cybersecurity professional, competitive hacker or new to CTFs you will find interesting challenges in the W0rm-CTF that you can solve at your own pace. 
                  Team W0rm-CTF will regularly update this challenge repository so visit the W0rm-Gym often.
               </p>
            </div>
      </section>
      <?php include './components/info.php'; ?>
      <?php include './components/footer.php'; ?>

   </body>
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script>
        var swiper = new Swiper(".hero-slider", {
         loop:true,
         grabCursor: true,
         effect: "fade",
         crossFade: true,
         pagination: {
            el: ".swiper-pagination",
            clickable:true,
         },
         autoplay: {
            delay: 5000,
         },
        });
   </script>
   
</html>