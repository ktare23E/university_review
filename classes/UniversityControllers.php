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
}