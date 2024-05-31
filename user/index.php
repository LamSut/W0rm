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
    $_SESSION['admin']= $row['admin'];
    $_SESSION['darkmode']= $row['darkmode'];
  }
  else{
    header("location: ../login/index.php");
    exit;
  }  
}

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
  header("location: ../admin/index.php");
  exit;
}

$style = "style.css";
$logo = "Logo.png";
$home = "Home.png";
$settingBTN = "settings-icon.png";

if (isset($_SESSION['darkmode']) && $_SESSION['darkmode'] == 1) {
  $style = "style-dark.css";
  $logo = "Dark-Logo.png";
  $home = "Dark-Home.png";
  $settingBTN = "Dark-settings-icon.png";
}
?> 


<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../<?php echo $style; ?>?v=<?php echo time(); ?>">
<style>
    td, th {
      padding: 4px 0px 2px 10px;
    }
    span {
      font-size: 1.4rem;
    }
</style>
<title>Welcome to W0rm!</title>
</head>

<body>

  <div id="header">
    <div id="top">
      <a href=""><img src="../img/<?php echo $logo; ?>" alt="W0rm" style="height: 80px"></a>
      <div id="usermenu">
        <div style="float:right">
          <span><?php echo $_SESSION["name"];?></span>
          <button onclick="usermenu()" class="drop-btn"><img src="../img/<?php echo $settingBTN; ?>" style="height: 25px;"></button>
        </div>
        <div class="dropdown">
          <div id="dropdownContent" class="dropdown-content">
            <a href="./profile/view.php">Profile</a>
            <a href="./comments/index.php">Comments</a>
            <a href="./settings/index.php">Settings</a>
            <a href="./logout.php" role="button">Log Out</a>
          </div>
        </div>  
      </div>
    </div>
    <div id="navbar">
      <a class="active" href="" style="border-bottom-left-radius:8px; border-top-left-radius:8px">Home</a>
      <a href="./lectures/view.php">Lectures (in coming)</a>
      <a href="./challenges/view.php">CTF Challenges</a>
      <a href="./labs/view.php">Labs (in coming)</a>
    </div>
  </div>
  
  <div id="content">
    <div id="welcome-container" style="margin:auto; width:94%">
      <img style="float:left" src="../img/<?php echo $home; ?>">
      <div>
        <h1 style="margin-top: 40px; margin-bottom: 8px;">Welcome to W0rm!</h1>
        <p style="margin-top:8px; margin-bottom: 40px; font-size:1.2rem;"><i>A cloud-based hacking practice environment</i></p>
        <table>
          <tr>
            <td rowspan="4" style="vertical-align: top; text-align: left; padding: 0px">
              <h3 style="margin-top: 0px;">Including: </h3>
            </td>
          <tr>
            <td>
              <li style="font-size: 1.4rem;"><b>Lectures</b> on Information Security. </li>
            </td>
          <tr>
              <td>
              <li style="font-size: 1.4rem;">Interesting <b>CTF Challenges</b>. </li>
              </td>
          <tr>
              <td>
              <li style="font-size: 1.4rem;">Exquisite <b>Labs</b> for attacking pratices.</li>
              </td>
          </tr>
        </table>
      </div>
    </div>

    <br>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
    <h2>ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ</h2>
  </div>
  
  <script src="../javascript.js"></script>
  
</body>

</html>
