<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$db = mysqli_connect($_ENV['MYSQL_HOST'],$_ENV['MYSQL_USERNAME'],$_ENV['MYSQL_PASSWORD'],$_ENV['MYSQL_DATABASE'],$_ENV['MYSQL_PORT']);
if($db === false){
    die("Error: connection error " . mysqli_connect_error());
}

$db->set_charset("utf8mb4");
?>
