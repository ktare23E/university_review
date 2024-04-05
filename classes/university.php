<?php

Class University extends ConnectDatabase{

    protected function displayUniversity(){
        try{
            $sql = "SELECT * FROM university";
            $stmt = $this->connect()->query($sql);
            while($row=$stmt->fetch()){
                echo $row['university_name']." ".$row['university_address']."<br>";
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function login($email,$password){
        try{
            if(strpos($email,'edu') !== false){
                $sql = "SELECT * FROM student WHERE student_email = ? AND student_password = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$email,$password]);
                $row = $stmt->fetch();
                session_start();
                $_SESSION['student_id'] = $row['student_id'];
                header("location:student/index.php");
            }else{
                header("location:login.php?failed=1");
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    public function retrieveStudentDetails($student_id){
        try{
            $sql = "SELECT * FROM student WHERE student_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$student_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function studentRegistration($student_firstname,$student_lastname,$student_email,$student_password,$university_id){
        try{
            //check student email if email is edu
            if(strpos($student_email,'edu') !== false){
                //insert query 
                $sql = "INSERT INTO student (student_firstname,student_lastname,student_email,student_password,university_id)
                        VALUES(?,?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$student_firstname,$student_lastname,$student_email,$student_password,$university_id]);
                header("location:register.php?success=1");
            }else{  
                header("location:register.php?failed=1");
            }
        }catch(PDOException $e){
            echo "ERror! ".$e->getMessage();
        }
    }

    protected function checkSession($session_name){
        if(!isset($_SESSION[''.$session_name.''])){
            header("location:../index.php");
        }
    }

}

?>