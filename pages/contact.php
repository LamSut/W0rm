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
        <meta charset="utf-8"/>
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

        <section class="page-header">
            <div class="container">
                <div class="row">
                <h1>Contact For More</h1>
                </div>
                <div class="row">
                <p>We are always here to help and would love to hear from you—feel free to reach out anytime!</p>
                </div>
            </div>
        </section>
        <section class="contact">
            <div class="row">
                <div class="image">
                <img src="img/message.gif" alt="msg gif">
                </div>
                <form method="POST">
                    <h3>Tell us something!</h3>
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="phone" name="phone" placeholder="Phone Number" required>
                    <textarea name="msg" class="box" required placeholder="Enter your message" maxlength="500" cols="30" rows="10"></textarea>
                    <p class="caution">Please <a href="../login/index.php">login</a> or <a href="signup.php">register</a> an account before sending any message </p>
                    <input type="submit" value="send message" name="send" class="btn">
                </form>
            </div>
        </section>
        <footer>
            <?php include './components/footer.php'; ?>
        </footer>
    <body>
</html>
