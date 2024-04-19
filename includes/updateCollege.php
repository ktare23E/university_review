<?php
    include_once 'autoloader.php';

    if(isset($_POST['update'])){
        $college_id = $_POST['edit_college_id'];
        $edit_college_name = $_POST['edit_college_name'];
        $edit_college_description = $_POST['edit_college_description'];
        
        $init = new UniversityControllers();
        echo $init->updateCollegeControllers($college_id,$edit_college_name,$edit_college_description);
    }
?>