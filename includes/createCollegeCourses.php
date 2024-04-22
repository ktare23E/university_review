<?php
    include_once 'autoloader.php';

    if(isset($_POST['submit'])){
        $university_college_id = $_POST['university_college_id'];
        $course_id = $_POST['course_id'];
        $status = $_POST['status'];
        $tuition_per_sem = $_POST['tuition_per_sem'];

        $createCollegeCourse = new UniversityControllers();
        echo $createCollegeCourse->insertUniversityCourseControllers($university_college_id, $course_id, $status, $tuition_per_sem);
    }

?>