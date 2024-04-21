<?php
include_once 'autoLoader.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $init = new UniversityControllers();
    $university_id = $_POST['university_id'];
    $college_id = $_POST['college_id'];
    $status = $_POST['status'];
    $filename = $_FILES["image"]["name"];

    echo $init->insertUniversityCollegeControllers($university_id,$college_id,$status,$filename);

}else{
    echo "No file uploaded or an error occurred.";
}