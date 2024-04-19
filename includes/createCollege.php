<?php
    include_once 'autoloader.php';

    if(isset($_POST['submit'])){
        $college_name = $_POST['college_name'];
        $college_description = $_POST['college_description'];
        $init = new UniversityControllers();
        echo $init->insertCollegeControllers($college_name,$college_description);
    }
?>