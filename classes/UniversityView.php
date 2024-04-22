<?php

class UniversityView extends University{

    public function studentData($student_id){
        return $this->retrieveStudentDetails($student_id);
    }

    public function courseData(){
        return $this->displayCourse();
    }

    public function testPls(){
        return $this->testNi();
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

    public function displaySingleUniversityCollegeView($university_college_id){
        return $this->displaySingleUniversityCollege($university_college_id);
    }

    public function displayTopFiveCoursesView($university_id){
        return $this->displayTopFiveCourses($university_id);
    }
    
    public function displayUniversityCollegeCourseView($university_college_id){
        return $this->displayUniversityCollegeCourse($university_college_id);
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

    public function displayCertainCollegeView($college_id){
        return $this->displayCertainCollege($college_id);
    }

    public function displayUniversityCollegesView(){
        return $this->displayUniversityColleges();
    }

    public function displayCertainUniversityCollegesView($university_id){
        return $this->displayCertainUniversityColleges($university_id);
    }

    public function displayCertainCollegeEditView($university_college_id){
        return $this->displayCertainCollegeEdit($university_college_id);
    }

    public function displayCertainCollegeDataView($university_college_id){
        return $this->displayCertainCollegeData($university_college_id);
    }
}