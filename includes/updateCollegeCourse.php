<?php
    include_once 'autoloader.php';

    if(isset($_POST['update'])){
        $university_course_id = $_POST['edit_university_course_id'];
        $university_college_id = $_POST['edit_university_college_id'];
        $course_id = $_POST['edit_course_id'];
        $status = $_POST['edit_status'];
        $tuition_per_sem = $_POST['edit_tuition_per_sem'];

        $university = new UniversityControllers();
        echo $university->updateUniversityCourseControllers($university_course_id,$university_college_id,$course_id,$status,$tuition_per_sem);
    }

?>