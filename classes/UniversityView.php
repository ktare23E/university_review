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

    public function universityData($pageNumber){
        return $this->displayUniversity($pageNumber);
    }

    public function displayCertainUniversityView($university_id){
        return $this->displayCertainUniversity($university_id);
    }

    public function displayRoundAvgRatingView($university_id){
        return $this->displayRoundAvgRatings($university_id);
    }

    public function retrieveUniversityView(){
        return $this->retrieveUniversity();
    }

    public function displayUniversityCountView($university_id){
        return $this->displayUniversityCount($university_id);
    }

    public function displayTopFiveCoursesView($university_id){
        return $this->displayTopFiveCourses($university_id);
    }
    
    public function universityCourseData($university_id){
        return $this->displayUniversityCourse($university_id);
    }

    public function universityRatingData($university_id){
        return $this->displayUniversityRating($university_id);
    }   

    public function universityCourseRating($university_course_id){
        return $this->displayUniversityCourseRating($university_course_id);
    }

    public function displayCollegeView(){
        return $this->displayCollege();
    }
}