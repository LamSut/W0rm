
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
        <title>W0RM - Community</title>
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
               <h1>Our Community</h1>
            </div>
            <div class="row">
               <p>Our community is a place where you can connect 
               and meet with people for the new possibilities in cybersecurity education.</p>
            </div>
         </div>
      </section>
        
      <section class="communication">
         <h1>W0RM-CTF x <span style="color:#5B209A;">Discord<span></h1>
         <div class="box-container">
            <div class="box">
               <img src="img/gif/chat.gif" style="width: 60%;" alt="Worm discord">
            </div>
            <div class="box">
               <p>
                  <span> W0RM-CTF Discord Server</span> -
                  A community Discord server for general conversation around W0RM-CTF, team recruitment for competitors, discussion about W0RM-CTF open-source development, or casual chat.
                  <a href="#"> Click here to join the server.</a>
               </p>
            </div>
         </div>
      </section>

      <section class="communication">
         <h1>W0RM-CTF Forum</h1>
         <div class="box-container">
            <div class="box">
               <img src="img/gif/forum.gif" style="width: 60%;" alt="Worm discord">
            </div>
            <div class="box">
               <p>
                  <span> W0RM-CTF Forum</span> -
                  We invite you to visit and join our forum, where your insights and experiences are always welcome!
                  <a href="#"> Click here to visit our forum.</a>
               </p>
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