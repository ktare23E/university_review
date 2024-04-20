<?php
    include_once 'autoloader.php';
    $university_id = $_POST['university_id'];
    $init = new UniversityView();
    echo json_encode($data = $init->displayCertainUniversityView($university_id));
?>