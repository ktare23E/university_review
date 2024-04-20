<?php
    include_once 'autoloader.php';

    if(isset($_POST['update'])){
        $university_name = $_POST['edit_university_name'];
        $region = $_POST['edit_region'];
        $province = $_POST['edit_province'];
        $city = $_POST['edit_city'];
        $barangay = $_POST['edit_barangay'];
        $university_email = $_POST['edit_university_email'];
        $university_status = $_POST['edit_university_status'];
        $university_description = $_POST['edit_university_description'];
        $university_type = $_POST['edit_university_type'];
        $university_id = $_POST['edit_university_id'];

        $university = new UniversityControllers();
        $university->updateUniversityControllers($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$university_id);
    }
?>