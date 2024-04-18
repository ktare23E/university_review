<?php
include_once 'autoloader.php';
if(isset($_POST['submit'])){
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $init = new UniversityControllers();
    echo $init->insertCourse($course_name,$course_description);
}