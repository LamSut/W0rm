<?php
    require_once "../../login/config.php";
    session_start();

    $id_lectures = $_SESSION['id_lectures'];
    $title_lecture = $_POST['title_lecture'];
    $description_lecture = $_POST['description_lecture'];

    $stmt = $db -> prepare("UPDATE lectures SET title = ?, des = ? WHERE id_lectures = ?");
    $stmt -> bind_param("sss", $title_lecture, $description_lecture, $id_lectures);
    if($stmt -> execute()) {
        header("location: ./view.php");
    } else {
        header("location: ./view.php");
    };



?>