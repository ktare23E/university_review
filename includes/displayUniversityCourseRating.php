<?php
    include_once 'autoloader.php';

    $university_course_id = $_POST['university_course_id'];
    $init = new UniversityView();
    echo json_encode($rating = $init->displayCertainCollegeCourseRatingAverageView($university_course_id));

?>