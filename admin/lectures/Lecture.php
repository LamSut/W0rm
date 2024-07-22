<?php
require_once "../../login/config.php";
session_start();

class Lecture {
    public $id_lectures;
    public $title_lecture;
    public $description_lecture;
    public $idacc;

    public function __construct($title_lecture, $description_lecture, $idacc)
    {
        // $this -> id_lectures = $id_lectures;
        $this -> title_lecture = $title_lecture;
        $this -> description_lecture = $description_lecture;
        $this -> idacc = $idacc;
    }

    public function insertLecture()
    {
        $sql = 'INSERT INTO lectures (title, des, time, idacc) VALUES (?, ?, sysdate(), ?)';
        $stmt = $GLOBALS['db'] -> prepare($sql);
        $stmt->bind_param("sss", $this->title_lecture, $this->description_lecture, $this -> idacc);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

}

?>