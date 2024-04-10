<?php

class UniversityControllers extends University{
    public function insertStudent($student_firstname,$student_lastname,$student_email,$student_password,$univsersity_id){
        $this->studentRegistration($student_firstname,$student_lastname,$student_email,$student_password,$univsersity_id);
    }

    public function insertRating($university_id,$student_id,$university_rating_description,$rating){
        return $this->studentReview($university_id,$student_id,$university_rating_description,$rating);
    }

    public function insertUniversity($university_name,$university_address,$university_email,$university_status,$university_description){
        return $this->createUniversity($university_name,$university_address,$university_email,$university_status,$university_description);
    }

    public function insertCourse($course_name,$course_description){
        $this->createCourse($course_name,$course_description);
    }

    public function insertUniversityCourse($university_id,$course_id,$status){
        $this->universityCourse($university_id,$course_id,$status);
    }

    public function insertUniversityCourseReview($university_course_id,$student_id,$course_rating,$course_rating_description){
        return $this->studentUniversityCourseReview($university_course_id,$student_id,$course_rating,$course_rating_description);
    }

    public function checkSession($session_name,$path){
        return $this->checkSessionSet($session_name,$path);
    }

    public function checkNoSession($session_name){
        return $this->checkSessionNotSet($session_name);
    }

    public function updateUniversityControllers($university_id,$university_name,$university_address,$university_email,$university_status,$university_description,$university_type,$university_tuition){
        return $this->updateUniversity($university_id,$university_name,$university_address,$university_email,$university_status,$university_description,$university_type,$university_tuition);
    }

    public function updateCourseControllers($course_id,$course_name,$course_description){
        return $this->updateCourse($course_id,$course_name,$course_description);
    }

    public function updateStudentControllers($student_id,$student_firstname,$student_lastname,$student_email,$student_password,$university_id){
        return $this->updateStudent($student_id,$student_firstname,$student_lastname,$student_email,$student_password,$university_id);
    }

    public function updateUniversityCourseControllers($university_course_id,$course_id,$status){
        return $this->updateUniversityCourse($university_course_id,$course_id,$status);
    }

    public function updateUniversityCourseRatingControllers($student_id,$course_rating,$course_rating_description){
        return $this->updateUniversityCourseRating($student_id,$course_rating,$course_rating_description);
    }

    public function updateUniversityRatingControllers($student_id,$rating,$university_rating_description){
        return $this->updateUniversityRating($student_id,$rating,$university_rating_description);
    }
}