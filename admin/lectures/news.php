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
  $_SESSION['id_lectures'] = $id_lectures;

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
    <?php
      $stmtLecture = $db -> prepare ("SELECT title FROM lectures WHERE id_lectures = ?");
      $stmtLecture -> bind_param("s", $id_lectures);
      $stmtLecture -> execute(); // Execute the query and store the result
      $resultLecture = $stmtLecture -> get_result(); 

      // Check if there are any results
      if ($resultLecture->num_rows > 0) {
        $row = $resultLecture->fetch_assoc(); // Fetch the first row as an associative array
        $title = $row['title']; // Extract the 'title' value from the row
        echo "<h3 style='margin-top: 170px; margin-bottom: 0px'> $title </h3>";
      } else {
        echo "<h3> No lecture found with id: $id_lectures <h3>"; // Handle no results case
      }

      // Close the result set (optional, recommended practice)
      $resultLecture->close();
    ?>
  <div id="content_block">
    <div id="news-content">
      <h4 style="margin-left: 40%; margin-top: 0px; margin-bottom: 0px">Newsfeed</h4>
      <!-- Add news box -->
      <div id="addBox" class="box-add" style="margin-bottom: 20px; margin-top: 20px">
        <img src="data:image/png;base64,<?php echo $avatar; ?>" style="border-radius: 50%; height: 50px; width: 50px">
        <button id="addNewsBtn_news" class="button" onclick=submitForm_news()>Add news</button>
      </div>
      <!-- print message -->
      <?php
        $stmtXXX = $db -> prepare("SELECT nf.*, a.avatar, a.name
          FROM newsfeed nf
          INNER JOIN acc a ON nf.idacc = a.idacc
          WHERE nf.id_lectures = ?
          ORDER BY nf.timeSend DESC");
        $stmtXXX -> bind_param("s", $id_lectures);
        $stmtXXX -> execute();
        $resultXXX = $stmtXXX -> get_result();

        function preventXssAndParseAnchors(string $str): string {
          $url_regex = "/\b((https?:\/\/?|www\.)[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/)))/";

          $str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');

          preg_match_all($url_regex, $str, $urls);

          foreach ($urls[0] as $url) {
            $str = str_replace($url, "<a href='$url' class='message_link' target='_blank'>$url</a>", $str);
          }
          return $str;
        }

        if($resultXXX->num_rows > 0){
          while($row = $resultXXX->fetch_assoc()){
            $avatar1 = base64_encode($row['avatar']);
            $handleMessage = preventXssAndParseAnchors($row['textNews']);
            echo <<< data
              <div id="boxchat" style="margin-top: 20px">
                <div class="author">
                  <img src="data:image/png;base64,$avatar1" style="border-radius: 50%; height: 50px; width: 50px">
                  <p style="margin: 5px 10px 0px 15px">
                    <b style="font-size: 22px">$row[name]</b>
                  <br>
                    <i style="font-size: 15px">$row[timeSend]</i>
                  </p>
                  <a href='./delete-news-action.php?del=$row[idnews]' id="removeBtn" data-title="Delete news">
                      X
                  </a>
                </div>
                <div class="message" style="font-size: 18px; margin-left:4px">
                  $handleMessage
                </div>
              </div>
            data;
          }
        }
      ?>
    </div>
<!-- Chat -->
    <div id="chat-content">
      <h4 style="margin-left: 40%; margin-top: 0px; margin-bottom: -5px">Boxchat</h4>
      <div id="scrollChat">
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
              $avatar2 = base64_encode($row['avatar']);
              echo <<< data
                <div id="boxchat">
                  <div class="author">
                    <img src="data:image/png;base64,$avatar2" style="border-radius: 50%; height: 30px; width: 30px">
                    <p style="margin: 5px 10px 0px 15px">
                      <b style="font-size: 15px">$row[name]</b>
                      <i style="font-size: 13px">$row[timeSend]</i>
                    </p>
                    <a href='./delete-chat-action.php?del=$row[idchats]' id="removeBtn" data-title="Delete message">
                        X
                    </a>
                  </div>
                  <div class="message" style="font-size: 16px; margin-left:4px">
                    $row[textChats]
                  </div>
                </div>
              data;
            }
          }
        ?>
      </div>
        <!-- Add news box -->
      <div id="addBox_chats" class="box-add" style="margin-bottom: 0px; margin-top: 0px;">
          <img src="data:image/png;base64,<?php echo $avatar; ?>" style="border-radius: 50%; height: 50px; width: 50px">
          <button id="addNewsBtn_chats" class="button" onclick=submitForm_chats()>Send message</button>
      </div>
    </div>
    <script>
      function scrollToBottom() {
        const chatContainer = document.getElementById('scrollChat');
        chatContainer.scrollTop = chatContainer.scrollHeight;
      }
      document.addEventListener('DOMContentLoaded', scrollToBottom);

      function onNewMessage() {
        scrollToBottom();
      }
    </script>
  </div>
  
  <script src="../../javascript.js"></script>
  <script>
    function submitForm_news() {
      const btnChange = document.getElementById('addNewsBtn_news');
      const replacement = document.createElement('form'); // Create form element to replace button

      replacement.setAttribute('id', 'addNewsForm'); // Set form ID
      replacement.setAttribute('method', 'post');
      replacement.setAttribute('class', 'form');
      btnChange.replaceWith(replacement);

      const textEle = document.createElement('textarea');
      textEle.setAttribute('id', 'textNews');
      textEle.setAttribute('name', 'textNews');
      textEle.setAttribute('rows', '3');
      textEle.setAttribute('cols', '100');
      textEle.setAttribute('placeholder', 'Enter message');
      replacement.appendChild(textEle);

      const submitEle = document.createElement('input');
      submitEle.setAttribute('id', 'submit-btn');
      submitEle.setAttribute('name', 'sendForm_news');
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
    function submitForm_chats() {
      const btnChange = document.getElementById('addNewsBtn_chats');
      const replacement = document.createElement('form'); // Create form element to replace button

      replacement.setAttribute('id', 'addNewsForm'); // Set form ID
      replacement.setAttribute('method', 'post');
      replacement.setAttribute('class', 'form');
      btnChange.replaceWith(replacement);

      const textEle = document.createElement('textarea');
      textEle.setAttribute('id', 'textChats');
      textEle.setAttribute('name', 'textChats');
      textEle.setAttribute('rows', '2');
      textEle.setAttribute('cols', '120');
      textEle.setAttribute('placeholder', 'Enter message');
      replacement.appendChild(textEle);

      const submitEle = document.createElement('input');
      submitEle.setAttribute('id', 'submit-btn');
      submitEle.setAttribute('name', 'sendForm_chats');
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
        if (isset($_POST['sendForm_news']) && !empty($_POST['textNews'])) {
          $textNews = $_POST['textNews']; 
          $idacc = $_SESSION['idacc'];
          date_default_timezone_set("Asia/Ho_Chi_Minh");
          $id_lectures = $_GET['id_lectures'];
          $stmt = $db -> prepare ("INSERT INTO newsfeed (idacc, textNews, timeSend, id_lectures) VALUES (?, ?, sysdate(), ?)");
          $stmt -> bind_param("sss", $idacc, $textNews, $id_lectures);
          $stmt -> execute();
          echo '<script>window.location.href = "./news.php?id_lectures=' . $id_lectures .'";</script>'; // Redirect to page
        }
        if (isset($_POST['sendForm_chats']) && !empty($_POST['textChats'])) {
          $textChats = $_POST['textChats']; 
          $idacc = $_SESSION['idacc'];
          date_default_timezone_set("Asia/Ho_Chi_Minh");
          $id_lectures = $_GET['id_lectures'];
          $stmt = $db -> prepare ("INSERT INTO chats (idacc, textChats, timeSend, id_lectures_chats) VALUES (?, ?, sysdate(), ?)");
          $stmt -> bind_param("sss", $idacc, $textChats, $id_lectures);
          $stmt -> execute();
          echo '<script>window.location.href = "./news.php?id_lectures=' . $id_lectures .'";</script>'; // Redirect to page
        }
      }
      else {
        echo "No lecture found";
      }
    ?>
    <?php include("../../footer.php") ?>
  </body>
</html>
