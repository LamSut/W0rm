<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/login/config.php';

if (!isset($_SESSION['idacc']) && isset($_COOKIE['idacc'])) {
    $_SESSION['idacc'] = $_COOKIE['idacc'];
}

if (isset($_SESSION['idacc'])) {
    $stmt = $db->prepare("SELECT admin FROM acc WHERE idacc = ?");
    $stmt->bind_param("s", $_SESSION['idacc']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if ((int)$row['admin'] === 1) {
            header("Location: admin/index.php");
            exit;
        } else {
            header("Location: user/index.php");
            exit;
        }
    }
    header("Location: login/index.php");
    exit;
}

header("Location: login/index.php");
exit;
