<?php
    include_once 'autoLoader.php';

    if(isset($_POST['update'])){
        $university_college_id = $_POST['edit_university_college_id'];
        $university_id = $_POST['edit_university_id'];
        $college_id = $_POST['edit_college_id'];
        $status = $_POST['edit_status'];

        $init = new UniversityControllers();
        echo $init->updateUniversityCollegeControllers($university_college_id,$university_id,$college_id,$status);
    }
?>