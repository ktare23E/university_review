<?php
    include_once 'autoloader.php';

    if(isset($_POST['isRate'])){
        session_start();
        if(!isset($_SESSION['isStudent'])){
            echo "login";
        }else{
            $student_id = $_SESSION['student_id'];
            $university_id = $_POST['university_id'];
            $rating = $_POST['rating'];
            $university_rating_description = $_POST['university_rating_description'];
            $controllers = new UniversityControllers();
            echo $controllers->insertRating($university_id,$student_id,$university_rating_description,$rating);
        }
    }
?>