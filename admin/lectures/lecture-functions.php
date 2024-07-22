<?php
    function announce($msg) {
        echo "<script>";
        echo "alert('" . $msg . "')";
        echo "</script>";
    }
?>