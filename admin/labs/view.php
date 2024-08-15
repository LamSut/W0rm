<?php

use OpenStack\Compute\v2\Models\Server;

require_once "../../login/config.php";

require '../../vendor/autoload.php';

$openstack = new OpenStack\OpenStack([
    'authUrl' => 'http://192.168.1.105/identity/v3',
    'region'  => 'RegionOne',
    'user'    => [
        'id'       => '60103e5ab314471eba01eeb20ab0ff24',
        'password' => 'suttocdo'
    ],
    'scope'   => ['project' => ['id' => '5354881b559945eea016d45a6f182dfd']]
]);

$compute = $openstack->computeV2(['region' => 'RegionOne']);

$server = $compute->getServer(['id' => '809a701b-552d-4aae-94eb-ab291d42ada5']);
$server1 = $compute->getServer(['id' => '5a83b510-c759-44d9-acb7-8e54a0bb6306']);

$server->retrieve();
if($server->status!='ACTIVE'){
  $server->start();
}

$server1->retrieve();
if($server1->status!='ACTIVE'){
  $server1->start();
}

$active = false;
while (!$active) {
  sleep(1);
  $server->retrieve();
  $active = $server->status === 'ACTIVE';
}

$active1 = false;
while (!$active1) {
  sleep(1);
  $server1->retrieve();
  $active1 = $server->status === 'ACTIVE';
}

$console = $server->getVncConsole();
$consoleUrl = $console['url'];

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

if (isset($_SESSION['user']) && $_SESSION['user'] == 1){
  header("location: ../../user/index.php");
  exit;
}

$style = "style.css";
$logo = "Logo.png";
$settingBTN = "settings-icon.png";

if (isset($_SESSION['darkmode']) && $_SESSION['darkmode'] == 1) {
  $style = "style-dark.css";
  $logo = "Dark-Logo.png";
  $settingBTN = "Dark-settings-icon.png";
}
?> 

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../<?php echo $style; ?>?v=<?php echo time(); ?>">
<title>Labs</title>
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
      <a href="../lectures/view.php">Lectures</a>
      <a href="../challenges/view.php">CTF Challenges</a>
      <a class="active" href="">Labs</a>
    </div>
  </div>

  <div id="content">
    <h1 style="text-align:center; margin: 20px">Demo (CirrOS)</h1>
    <iframe id="console_embed" src=<?php echo $consoleUrl ?> style="width: 54%; height: 450px; margin-left: 23%"></iframe>      
  </div>
  
  <script src="../../javascript.js"></script>

</body>

</html>
