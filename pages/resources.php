
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
        <title>W0RM - Resources</title>
        <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>" />
        <link rel="icon" type="image/x-icon" href="../img/CTF-Logo.ico">
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>
    <body>
      <header>
         <?php include './components/navbar.php'; ?>
      </header>

      <section class="page-header">
         <div class="container">
            <div class="row">
               <h1 style="font-size: 30px;">Resources and Refferences</h1>
            </div>
            <div class="row">
               <p>W0RM-CTF is far more than a competition.
                  Learn and delve deeper into cyberspace here</p>
            </div>
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
                  <span> W0RM-CTF GYM</span>
                  gamifies learning hacking with capture-the-flag puzzles created 
                  by trusted computer security and privacy experts at <a href="https://www.ctu.edu.vn/">Can Tho University</a>
               </p>
            </div>
         </div>
      </section>

      <section class="resources">
         <h1>Learning Guides</h1>
         <p>These learning guides provide basic background information about Cybersecurity. For novice and cyber security enthusiasts alike, these guides can help you get prepared to solve challenge problems:</p>
         <div class="box-container">

               <div class="box">
                  <img src="img/skills.png">
                  <h3>Gerneral Skill</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>

               <div class="box">
                  <img src="img/forensics.png">
                  <h3>Forensics</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>

               <div class="box">
                  <img src="img/world-wide-web.png">
                  <h3>Web Exploitation</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>

               <div class="box">
                  <img src="img/magnifying-glass.png">
                  <h3>Binary Exploitation</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>

               <div class="box">
                  <img src="img/reverse-engineering.png">
                  <h3>Reversing</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>

               <div class="box">
                  <img src="img/decode.png">
                  <h3>Crytography</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
               </div>
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