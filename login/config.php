<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$db = mysqli_connect($_ENV['mysql_host'],$_ENV['mysql_username'],$_ENV['mysql_password'],$_ENV['mysql_database'],$_ENV['mysql_port']);
if($db === false){
    die("Error: connection error " . mysqli_connect_error());
}

?>
