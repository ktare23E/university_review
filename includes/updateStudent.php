<?php
include_once 'autoLoader.php';
    if(isset($_POST['update'])){
        $student_id = $_POST['student_id'];
        $student_firstname = $_POST['student_firstname'];
        $student_lastname = $_POST['student_lastname'];
        $student_email = $_POST['student_email'];
        $university_id = $_POST['university_id'];

        $init = new UniversityControllers();
        $init->updateStudentControllers($student_id,$student_firstname,$student_lastname,$student_email,$university_id);
    }

?>