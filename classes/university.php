<?php

Class University extends ConnectDatabase{

    //insert or create functionalities 

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



    protected function createUniversity($university_name,$university_address,$university_email,$university_status,$university_description){
        try{
            //check if university exist
            $query = "SELECT * FROM university WHERE university_email = ?";
            $result  = $this->connect()->prepare($query);
            $result->execute([$university_email]);
            if($result->rowCount() > 0){
                return 'already existed';
            }else{
                $sql = "INSERT INTO university (university_name,university_address,university_email,university_status,university_description) VALUES(?,?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$university_name,$university_address,$university_email,$university_status,$university_description]);
                return 'success';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function createCourse($course_name,$course_description){
        try{
            $sql = "INSERT INTO course (course_name,course_description)
                    VALUES(?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$course_name,$course_description]);
        }catch(PDOException $e){

        }
    }

    protected function universityCourse($university_id,$course_id,$status){
        try{
            $sql = "INSERT INTO university_course (university_id,course_id,status)
                    VALUES(?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id,$course_id,$status]);
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function studentReview($university_id,$student_id,$university_rating_description,$rating){
        try{
            //retrieve student email
            $retrieveStudentEmailQuery = "SELECT * FROM student WHERE student_id = ?";
            $stmtStudentResult = $this->connect()->prepare($retrieveStudentEmailQuery);
            $stmtStudentResult->execute([$student_id]);
            $studentRow = $stmtStudentResult->fetch();
            $student_email = $studentRow['student_email'];
        

            // retrieve university email
            $retrieveUniversityEmailQuery = "SELECT * FROM university WHERE university_id = ?";
            $stmtResult = $this->connect()->prepare($retrieveUniversityEmailQuery);
            $stmtResult->execute([$university_id]);
            $universityRow = $stmtResult->fetch();
            $university_email = $universityRow['university_email'];

            //extract domain name
            $student_domain = substr(strchr($student_email, "@"), 1);
            $university_domain = substr(strchr($university_email, "@"), 1);

            //check if student go to the same university using email
            if($student_domain === $university_domain){
                $sql = "INSERT INTO university_rating (university_id,student_id,university_rating_description,rating,date_occurred)
                VALUES (?,?,?,?,CURRENT_DATE())";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$university_id,$student_id,$university_rating_description,$rating]);
                //check if the query is successful
                if($stmt){
                    echo "success";
                }else{
                    echo "error";
                }
            }else{
                echo "different university";
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function studentUniversityCourseReview($university_course_id,$student_id,$course_rating,$course_rating_description){
        try{
            //retrieve student email
            $retrieveStudentEmailQuery = "SELECT * FROM student WHERE student_id = ?";
            $stmtStudentResult = $this->connect()->prepare($retrieveStudentEmailQuery);
            $stmtStudentResult->execute([$student_id]);
            $studentRow = $stmtStudentResult->fetch();
            $student_email = $studentRow['student_email'];

            //retrieve university email 
            $retrieveUniversityEmailQuery = "SELECT * FROM university_course_view WHERE university_course_id = ? GROUP BY university_id";
            $stmtResult = $this->connect()->prepare($retrieveUniversityEmailQuery);
            $stmtResult->execute([$university_course_id]);
            $universityRow = $stmtResult->fetch();
            $university_email = $universityRow['university_email'];

            //extract domain name
            $student_domain = substr(strchr($student_email, "@"), 1);
            $university_domain = substr(strchr($university_email, "@"), 1);

            //check if student go to the same university using email
            if($student_domain === $university_domain){
                $sql = "INSERT INTO university_course_rating (university_course_id,student_id,course_rating,course_rating_description,date_occurred)
                VALUES (?,?,?,?,CURRENT_DATE())";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$university_course_id,$student_id,$course_rating,$course_rating_description]);

                //check if the query is successful
                if($stmt){
                    echo "success";
                }else{
                    echo "error";
                }
                
            }else{
                echo "different university";
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    //display or view functionalities
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

    //session functionalities
    protected function checkSession($session_name){
        if(!isset($_SESSION[''.$session_name.''])){
            header("location:../index.php");
        }
    }

}

?>