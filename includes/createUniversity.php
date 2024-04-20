<?php
    include_once 'autoloader.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $init = new UniversityControllers();
        $university_name = $_POST['university_name'];
        $university_status = $_POST['university_status'];
        $university_description = $_POST['university_description'];
        $university_email = $_POST['university_email'];
        $university_type = $_POST['university_type'];
        $region = $_POST['region'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $barangay = $_POST['barangay'];
        $filename = $_FILES["image"]["name"];

        echo $init->insertUniversity($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$filename);

    }else{
        echo "No file uploaded or an error occurred.";
    }