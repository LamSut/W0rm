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
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>W0RM - About</title>
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
                    <h1 style="font-size: 25px;">About W0RM-CTF</h1>
                    <img src="img/logo white.png" style="width: 50%;" alt="Worm logo">
                </div>
                <div class="row">
                <p>Putting education ahead of competition.
                The largest high school hacking competition now provides year-round cyber</p>
                </div>
            </div>
        </section>

        <section class="introduction">
            <h1>W0RM - Delve Deeper Into Cyberspace</h1>
            <div class="box-container">
                <div class="box">
                <img src="img/category-diagram.png" style="width:75%;" alt="Worm diagram">
                </div>
                <div class="box">
                <p>
                    Participants learn to overcome sets of challenges from six domains of cybersecurity including general skills,
                    cryptography, web exploitation, forensics, etc. The challenges are all set up with the intent of being hacked, 
                    making it an excellent, legal way to get hands-on experience.
                </p>
                </div>
            </div>
        </section>

        <section class="about">
            <div class="member">
                <h1> Our Members </h1>
                <div class="member-container">

                    <div class="member-box">
                        <div class="member-img">
                            <a href="https://scholar.google.com.tw/citations?user=0V1HxNUAAAAJ&hl=en">
                                <img src="img/member-img/thai_tuan.jpg" alt="cict TMTuan">
                            </a>
                        </div>
                        <div class="member-intro">
                            <span>Dr. Thai Minh Tuan</span>
                            <h3>Project Instructor</h3>
                        </div>
                    </div>


                    <div class="member-box">
                        <div class="member-img">
                            <img src="./img/member-img/LS.png" alt="member-img">
                        </div>
                        <div class="member-intro">
                            <span>Truong Dang Truc Lam</span>
                            <h3>Leader of The Project</h3>
                        </div>
                    </div>

                    <div class="member-box">
                        <div class="member-img">
                            <img src="./img/member-img/XT.JPG" alt="member-img">
                        </div>
                        <div class="member-intro">
                            <span>Le Xuan Thanh</span>
                            <h3>Member of The Project</h3>
                        </div>
                    </div>

                    <div class="member-box">
                        <div class="member-img">
                            <img src="./img/member-img/BTT.jpg" alt="member-img">
                        </div>
                        <div class="member-intro">
                            <span>Dang Hoang Hung</span>
                            <h3>Member of The Project</h3>
                        </div>
                    </div>

                    <div class="member-box">
                        <div class="member-img">
                            <img src="./img/member-img/DB.JPG" alt="member-img">
                        </div>
                        <div class="member-intro">
                            <span>Nguyen Duy Bang</span>
                            <h3>Member of The Project</h3>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php include './components/info.php'; ?>
        <footer>
            <?php include './components/footer.php'; ?>
        </footer>
    <body>
</html>
