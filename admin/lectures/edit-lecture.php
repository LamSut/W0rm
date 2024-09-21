<?php
require '../../vendor/autoload.php';
require_once "../../login/config.php";
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
    header("location: ../../login/index.php");
    exit;
  }  
}

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){
  header("location: ../../user/index.php");
  exit;
}

$style = "style.css";
$styleNDB = "style-NDB.css";
$logo = "Logo.png";
$settingBTN = "settings-icon.png";

if (isset($_SESSION['darkmode']) && $_SESSION['darkmode'] == 1) {
  $style = "style-dark.css";
  $styleNDB = "style-dark-NDB.css";
  $logo = "Dark-Logo.png";
  $settingBTN = "Dark-settings-icon.png";
}

  $id_lectures = $_GET['id_lectures'];
  $_SESSION['id_lectures'] = $id_lectures;
  $stmt = $db -> prepare('SELECT * from lectures where id_lectures = ?');
  $stmt -> bind_param("s", $id_lectures);
  $stmt -> execute();
  $result = $stmt -> get_result();
  $lecture = $result -> fetch_assoc();

?> 

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../<?php echo $style; ?>?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../../<?php echo $styleNDB; ?>?v=<?php echo time(); ?>">
<title>Lectures</title>
</head>

<body>
  <div id="header">
    <div id="top">
      <a href=""><img src="../../img/<?php echo $logo; ?>" alt="W0rm" style="height: 80px"></a>
      <div id="usermenu">
        <div style="float:right">
          <span><?php echo $_SESSION["name"];?></span>
          <button onclick="usermenu()" class="drop-btn"><img src="../../img/<?php echo $settingBTN; ?>" style="height: 25px;"></button>
        </div>
        <div class="dropdown">
          <div id="dropdownContent" class="dropdown-content">
            <a href="../profile/view.php">Profile</a>
            <a href="../comments/index.php">Comments</a>
            <a href="../settings/index.php">Settings</a>
            <a href="../logout.php" role="button">Log Out</a>
          </div>
        </div>  
      </div>
    </div>
    <div id="navbar">
      <a href="../index.php">Home</a>
      <a class="active" href="../lectures/view.php">Lectures</a>
      <a href="../challenges/view.php">CTF Challenges</a>
      <a href="../labs/view.php">Labs</a>
    </div>
  </div>

  <div id="content">
    <form action="edit-lecture-action.php" method="post" class="add-edit-group-container" enctype='multipart/form-data'>
      <div class="add-lecture">
        <h4 style="margin-bottom: 5px;">Edit Lecture</h4>
        <div>
          <p>
            Notice: You are editing "<b><?php echo $lecture['title'] ?></b>"
          </p>
        </div>
        <div class="title-lecture-container">
          <label for="" class='edit-add-title'>Title: </label> 
          <input type="text" name="title_lecture" id="title_lecture" class='input-edit-add-title' value="<?= $lecture['title'] ?>" required>
        </div>
        <div class="description-lecture-container">
          <label for="" class='edit-add-des'>Description: </label>
          <textarea name="description_lecture" id="description_lecture" class='input-edit-add-des' rows="10" required><?= $lecture['des'] ?></textarea>
        </div>
        <div class="button-cluster">
          <input type="submit" value="Edit Lecture" onclick="return confirm('Confirm to edit lecture?')">
          <button id="cancel-btn" type="button" onclick="location.href='./view.php'">Cancel</button>
        </div>
      </div>
    </form>
  </div>

  <script src="../../javascript.js"></script>
  <?php include '../../footer.php';?>
</body>

</html>