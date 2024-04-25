<?php 
    include_once 'autoloader.php';
    session_start();
    if(isset($_POST['isCourseRate'])){
        if(!isset($_SESSION['student_id'])){
            echo 'login';
            die();
        }else{
            $student_id = $_SESSION['student_id'];
            $course_rating_description = $_POST['course_rating_description'];
            $course_rating = $_POST['course_rating'];
            $university_course_id = $_POST['university_course_id'];
            $init = new UniversityControllers();
            echo $data = $init->insertUniversityCourseReview($university_course_id,$student_id,$course_rating,$course_rating_description);
    
        }
    }
?>