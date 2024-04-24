<?php
    include_once 'autoloader.php';

    $university_id = $_POST['university_id'];

    $universityView = new UniversityView();
    $universityRating = $universityView->displayUniversityRatingAverageView($university_id);
    echo json_encode($universityRating);
?>