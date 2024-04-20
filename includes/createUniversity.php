<?php
    include_once 'autoloader.php';
    if(isset($_POST['submit'])){
        $university_name = $_POST['university_name'];
        $university_status = $_POST['university_status'];
        $university_description = $_POST['university_description'];
        $region  =  $_POST['region'];
        $province  = $_POST['province'];
        $city  = $_POST['city'];
        $barangay  =  $_POST['barangay'];
        $university_email  = $_POST['university_email'];
        $university_type  = $_POST['university_type'];

        $init = new UniversityControllers();
        echo $init->insertUniversity($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type);
    }
