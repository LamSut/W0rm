<?php
    require __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . "/../../login/config.php";
    // require_once __DIR__ . "/Lecture.php";


    $id_lectures = $_GET['id_lectures'];
    $stmtToDelete = $db->prepare("SELECT * FROM lectures where id_lectures = ?");
    $stmtToDelete->bind_param("s", $id_lectures);
    $stmtToDelete->execute();

    $result=$stmtToDelete->get_result();

    if ($result->num_rows > 0) {
        $lecture = $result -> fetch_assoc();

        $sql = "DELETE FROM newsfeed WHERE id_lectures = ?";
        $stmt = $GLOBALS['db'] -> prepare($sql);
        $stmt -> bind_param("s", $lecture['id_lectures']);
        $stmt -> execute();

        $sql1 = "DELETE FROM chats WHERE id_lectures_chats = ?";
        $stmt = $GLOBALS['db'] -> prepare($sql1);
        $stmt -> bind_param("s", $lecture['id_lectures']);
        $stmt -> execute();

        $sql2 = "DELETE FROM lectures WHERE id_lectures = ? AND idacc = ?";
        $stmt = $GLOBALS['db'] -> prepare($sql2);
        $stmt -> bind_param("ss", $lecture['id_lectures'], $lecture['idacc']);
        $stmt -> execute();
        // header('location:' . $_SERVER['PHP_SELF']);
        // die;
        header('location: ./view.php');
    } else {
        // header('location:' . $_SERVER['PHP_SELF']);
        // die;
        header('location: ./view.php');
    }
    $stmtToDelete -> close();
    $db->close();
?>
  
  

  