<?php
    require __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . "/../../login/config.php";
    session_start();

    if(isset($_GET['del'])){
        $id_lectures = $_SESSION['id_lectures'];
        $idchats = $_GET['del'];
        $stmt = $db -> prepare ("DELETE FROM chats WHERE idchats = ?");
        $stmt -> bind_param("s", $idchats);
        if($stmt -> execute()) {
            header('location: ./news.php?id_lectures=' . $id_lectures);
        } else {
            header('location: ./news.php?id_lectures=' . $id_lectures);
        }
    } else {
        echo "Something went wrong...";
    }

?>