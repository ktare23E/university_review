<?php
require 'autoloader.php';
$student_email = $_POST['student_email'];
$init = new UniversityControllers();
echo $init->checkStudentEmailControllers($student_email);
?>