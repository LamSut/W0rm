<?php
require __DIR__ . '//../../vendor/autoload.php';
require_once __DIR__ . "//../../login/config.php";
require_once __DIR__ . "/Lecture.php";

$title_lecture = $_POST['title_lecture'];
$description_lecture = $_POST['description_lecture'];
$idacc = $_SESSION['idacc'];

$lecture = new Lecture($title_lecture, $description_lecture, $idacc);

if ($lecture->insertLecture()) {
  ?>
  <script>
    alert("Lecture added successfully!");
    window.location = "./view.php";
  </script>

  <?php
} else {
  echo "Something went wrong...";
}

$stmt->close();
$db->close();
?>

?>


