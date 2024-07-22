<?php
    require_once "../../login/config.php";
    session_start();

    if(isset($_GET['del'])){
        $id_lectures = $_SESSION['id_lectures'];
        $idnews = $_GET['del'];
        $stmt = $db -> prepare ("DELETE FROM newsfeed WHERE idnews = ?");
        $stmt -> bind_param("s", $idnews);
        if($stmt -> execute()) {
            header('location: ./news.php?id_lectures=' . $id_lectures);
        } else {
            header('location: ./news.php?id_lectures=' . $id_lectures);
        }
    } else {
        echo "Something went wrong...";
    }

?>