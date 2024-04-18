<?php
include_once 'autoloader.php';
if(isset($_POST['update'])){
    $course_id = $_POST['edit_course_id'];
    $course_name = $_POST['edit_course_name'];
    $course_description = $_POST['edit_course_description'];

    $course = new UniversityControllers();
    echo $result = $course->updateCourseControllers($course_id,$course_name,$course_description);
    
}
?>