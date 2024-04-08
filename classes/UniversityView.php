<?php

class UniversityView extends University{

    public function studentData($student_id){
        return $this->retrieveStudentDetails($student_id);
    }

    public function courseData(){
        return $this->displayCourse();
    }

    public function studentDataForAdmin(){
        return $this->displayStudents();
    }

    public function universityCourseData($university_id){
        return $this->displayUniversityCourse($university_id);
    }
}