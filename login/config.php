<?php
$db = mysqli_connect('localhost','root','','hack','3306');
if($db === false){
    die("Error: connection error " . mysqli_connect_error());
}
?>
