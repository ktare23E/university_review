<?php
include_once 'autoloader.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
            $university_id = $_POST['university_id'];
            $file = $_FILES['images'];

            $fileName = $file['name'];
            $init = new UniversityControllers();
            echo $init->uploadMultipleUniversityImageControllers($university_id,$fileName);
    }
?>