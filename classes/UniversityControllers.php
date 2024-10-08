<?php

class UniversityControllers extends University{
    public function insertStudent($student_firstname,$student_lastname,$student_email,$student_password,$univsersity_id){
        $this->studentRegistration($student_firstname,$student_lastname,$student_email,$student_password,$univsersity_id);
    }

    public function insertRating($university_id,$student_id,$university_rating_description,$rating){
        return $this->studentReview($university_id,$student_id,$university_rating_description,$rating);
    }

    public function insertUniversity($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$filename){
        return $this->createUniversity($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$filename);
    }

    public function insertCourse($course_name,$course_description){
        $this->createCourse($course_name,$course_description);
    }

    public function insertUniversityCourseControllers($university_college_id,$course_id,$status,$tuition_per_sem){
        return $this->universityCourse($university_college_id,$course_id,$status,$tuition_per_sem);
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

    public function updateUniversityControllers($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$university_id){
        return $this->updateUniversity($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$university_id);
    }

    public function updateCourseControllers($course_id,$course_name,$course_description){
        return $this->updateCourse($course_id,$course_name,$course_description);
    }

    public function updateStudentControllers($student_id,$student_firstname,$student_lastname,$student_email,$university_id){
        return $this->updateStudent($student_id,$student_firstname,$student_lastname,$student_email,$university_id);
    }

    public function updateUniversityCourseControllers($university_course_id,$university_college_id,$course_id,$status,$tuition_per_sem){
        return $this->updateUniversityCourse($university_course_id,$university_college_id,$course_id,$status,$tuition_per_sem);
    }

    public function updateUniversityCourseRatingControllers($student_id,$course_rating,$course_rating_description){
        return $this->updateUniversityCourseRating($student_id,$course_rating,$course_rating_description);
    }

    public function updateUniversityRatingControllers($student_id,$rating,$university_rating_description){
        return $this->updateUniversityRating($student_id,$rating,$university_rating_description);
    }

    public function checkStudentEmailControllers($student_email){
        return $this->checkStudentEmail($student_email);
    }

    public function loginControllers($email,$password){
        $this->login($email,$password);
    }

    public function searchUniversityControllers($pageNumber,$searchItem){
        return $this->searchUniversity($pageNumber,$searchItem);
    }

    public function insertCollegeControllers($college_name,$college_description){
        return $this->insertCollege($college_name,$college_description);
    }

    public function updateCollegeControllers($college_id,$college_name,$college_description){
        return $this->updateCollege($college_id,$college_name,$college_description);
    }
    
    public function insertUniversityCollegeControllers($university_id,$college_id,$status,$filename){
        return $this->insertUniversityCollege($university_id,$college_id,$status,$filename);
    }

    public function updateUniversityCollegeControllers($university_college_id,$university_id,$college_id,$status){
        return $this->updateUniversityCollege($university_college_id,$university_id,$college_id,$status);
    } 
    
    public function uploadMultipleUniversityImageControllers($university_id,$filename){
        return $this->uploadMultipleUniversityImage($university_id,$filename);
    }
}