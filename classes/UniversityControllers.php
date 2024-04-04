<?php

class UniversityControllers extends University{
    public function insertStudent($student_firstname,$student_lastname,$student_email,$student_password,$univsersity_id){
        $this->studentRegistration($student_firstname,$student_lastname,$student_email,$student_password,$univsersity_id);
    }
}