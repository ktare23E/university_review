<?php

class UniversityView extends University{

    public function test(){
        $this->displayUniversity();
    }

    public function studentData($student_id){
        return $this->retrieveStudentDetails($student_id);
    }
}