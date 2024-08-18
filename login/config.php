<?php
$db = mysqli_connect('localhost','root','','hack');
if($db === false){
    die("Error: connection error " . mysqli_connect_error());
}
?>
