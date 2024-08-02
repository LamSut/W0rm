<?php
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
$styleLXT = "style-LXT.css";
$logo = "Logo.png";
$settingBTN = "settings-icon.png";

if (isset($_SESSION['darkmode']) && $_SESSION['darkmode'] == 1) {
  $style = "style-dark.css";
  $styleLXT = "style-dark-LXT.css";
  $logo = "Dark-Logo.png";
  $settingBTN = "Dark-settings-icon.png";
}

  $id_lectures = $_GET['id_lectures'];

  $stmt = $db->prepare("SELECT * from acc where idacc = ?");
  $stmt->bind_param("s", $_SESSION['idacc']);
  $stmt->execute();

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $avatar = base64_encode($row['avatar']);
?> 

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh">
  <link rel="stylesheet" href="../../<?php echo $style; ?>?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../../<?php echo $styleLXT; ?>?v=<?php echo time(); ?>">
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
  
  <div id="news-content">
    <?php

      $stmtLecture = $db -> prepare ("SELECT title FROM lectures WHERE id_lectures = ?");
      $stmtLecture -> bind_param("s", $id_lectures);
      $stmtLecture -> execute(); // Execute the query and store the result
      $resultLecture = $stmtLecture -> get_result(); 

      // Check if there are any results
      if ($resultLecture->num_rows > 0) {
        $row = $resultLecture->fetch_assoc(); // Fetch the first row as an associative array
        $title = $row['title']; // Extract the 'title' value from the row
        echo "<h3> $title </h3>";
      } else {
        echo "<h3> No lecture found with id: $id_lectures <h3>"; // Handle no results case
      }

      // Close the result set (optional, recommended practice)
      $resultLecture->close();
    ?>

    <!-- Back to view tab -->
    
    <?php
     $id_lectures = $_GET['id_lectures'];
     $_SESSION['id_lectures'] = $id_lectures;
     echo <<< data
        <div style="margin-left: 40%">
            <a href="./news.php?id_lectures=$id_lectures" id="add-btn" style="background-color: #aaaaaa; color: #eaeaea">News</a>
            <a href="" id="add-btn">Chats</a>
        </div>
      data;
     ?>
   
  <!-- print message -->
  <?php
      $stmtXXX = $db -> prepare("SELECT ch.*, a.avatar, a.name
        FROM chats ch
        INNER JOIN acc a ON ch.idacc = a.idacc
        WHERE ch.id_lectures_chats = ?
        ORDER BY ch.timeSend ASC");
      $stmtXXX -> bind_param("s", $id_lectures);
      $stmtXXX -> execute();
      $resultXXX = $stmtXXX -> get_result();

      if($resultXXX->num_rows > 0){
        while($row = $resultXXX->fetch_assoc()){
          $avatar1 = base64_encode($row['avatar']);
          echo <<< data
            <div id="boxchat">
              <div class="author">
                <img src="data:image/png;base64,$avatar1" style="border-radius: 50%; height: 50px; width: 50px">
                <p style="margin: 5px 10px 0px 15px">
                  <b style="font-size: 22px">$row[name]</b>
                <br>
                  <i style="font-size: 15px">$row[timeSend]</i>
                </p>
                <a href='./delete-chat-action.php?del=$row[idchats]' id="removeBtn" data-title="Delete message">
                    X
                </a>
              </div>
              <div class="message" style="font-size: 18px; margin-left:4px">
                $row[textChats]
              </div>
            </div>
          data;
        }
      }
    ?>
    <!-- Add news box -->
    <div id="addBox" class="box-add" style="margin-bottom: 60px; margin-top: 20px; position: -webkit-sticky; position: sticky; bottom: 10px">
      <img src="data:image/png;base64,<?php echo $avatar; ?>" style="border-radius: 50%; height: 50px; width: 50px">
      <button id="addNewsBtn" class="button" onclick=submitForm()>Send message</button>
    </div>
  </div>
  
  <script src="../../javascript.js"></script>
  <script>
    function submitForm() {
      const btnChange = document.getElementById('addNewsBtn');
      const replacement = document.createElement('form'); // Create form element to replace button

      replacement.setAttribute('id', 'addChatsForm'); // Set form ID
      replacement.setAttribute('method', 'post');
      replacement.setAttribute('class', 'form');
      btnChange.replaceWith(replacement);

      const textEle = document.createElement('textarea');
      textEle.setAttribute('id', 'textChats');
      textEle.setAttribute('name', 'textChats');
      textEle.setAttribute('rows', '3');
      textEle.setAttribute('cols', '120');
      textEle.setAttribute('placeholder', 'Enter message');
      replacement.appendChild(textEle);

      const submitEle = document.createElement('input');
      submitEle.setAttribute('id', 'submit-btn');
      submitEle.setAttribute('name', 'sendForm');
      submitEle.setAttribute('type', 'submit');
      submitEle.innerHTML = 'Submit';
      submitEle.addEventListener('submit', event => {
        event.preventDefault();
        replacement.replaceWith(btnChange);
      });
      replacement.appendChild(submitEle);

      const cancelEle = document.createElement('button');
      cancelEle.setAttribute('id', 'cancel-btn');
      cancelEle.setAttribute('type', 'button');
      cancelEle.innerHTML = 'Cancel';
      cancelEle.addEventListener('click', () => {
        replacement.replaceWith(btnChange); // Replace form with button on cancel
      });
      replacement.appendChild(cancelEle);
    }
    
    
  </script>
    <?php
      if(isset($_GET['id_lectures'])) {
        if (isset($_POST['sendForm']) && !empty($_POST['textChats'])) {
          $textChats = $_POST['textChats']; 
          $idacc = $_SESSION['idacc'];
          date_default_timezone_set("Asia/Ho_Chi_Minh");
          $id_lectures = $_GET['id_lectures'];
          $stmt = $db -> prepare ("INSERT INTO chats (idacc, textChats, timeSend, id_lectures_chats) VALUES (?, ?, sysdate(), ?)");
          $stmt -> bind_param("sss", $idacc, $textChats, $id_lectures);
          $stmt -> execute();
        
          echo '<script>window.location.href = "./chats.php?id_lectures=' . $id_lectures .'";</script>'; // Redirect to page
        }
      } else {
        echo "No lecture found";
      }
    ?>
</body>

</html>
