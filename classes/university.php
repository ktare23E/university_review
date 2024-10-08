<?php

Class University extends ConnectDatabase{

    //insert or create functionalities 

    protected function login($email,$password){
        try{
            if(!empty($email) && !empty($password)){
                $sql = "SELECT * FROM student WHERE student_email = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$email]);

                $sql2 = "SELECT * FROM admin WHERE admin_email = ?";
                $stmt2 = $this->connect()->prepare($sql2);
                $stmt2->execute([$email]);
    
                if($stmt->rowCount() > 0){
                    $row = $stmt->fetch();
                    $student_password = $row['student_password'];

                    //check password same as the hashed
                    if(password_verify($password,$student_password)){
                        session_start();
                        $_SESSION['student_id'] = $row['student_id'];
                        $_SESSION['isStudent'] = 1;
                        header("location:index.php");
                    }else{
                        header("location:login.php?error=Password does not match!");
                    }
                }elseif($stmt2->rowCount() > 0){
                    $row = $stmt2->fetch();
                    $admin_password = $row['admin_password'];

                    //check password same as the hashed
                    if($password === $admin_password){
                        session_start();
                        $_SESSION['admin_id'] = $row['admin_id'];
                        $_SESSION['isAdmin'] = 1;
                        header("location:admin/index.php");
                    }else{
                        header("location:login.php?error=Password does not match!");
                    }
                }
                else{
                    header("location:login.php?error=Email does not exist!");
                }
            } 
        
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }


    protected function studentRegistration($student_firstname,$student_lastname,$student_email,$student_password,$university_id){
        try{
            //check if first name and last name is empty
            $errors = [];
            if(empty($student_firstname)){
                $errors[] = 'First name is required';
            }

            if(empty($student_lastname)){
                $errors[] = 'Last name is required';
            }

            if(empty($student_email)){
                $errors[] = 'Email is required';
            }else{
                 //check if email is valid
                if(!filter_var($student_email,FILTER_VALIDATE_EMAIL)){
                    $errors[] = 'Email is invalid';
                }
                
                if(strpos($student_email,'edu') === false){
                    $errors[] = 'Email must be an institutional email';
                }
            }


            if(empty($student_password)){
                $errors[] = 'Password is required';
            }else{
                $hashed_password = password_hash($student_password,PASSWORD_DEFAULT);
            }

            if(empty($university_id)){
                $errors[] = 'University is required';
            }


            if(empty($errors)){
                //insert query 
                $sql = "INSERT INTO student (student_firstname,student_lastname,student_email,student_password,university_id)
                VALUES(?,?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$student_firstname,$student_lastname,$student_email,$hashed_password,$university_id]);
                header("location:register.php?success=1");
            }else{
                $bulkError = json_encode($errors);
                header("location:register.php?errors=".urlencode($bulkError));
            }

        }catch(PDOException $e){
            echo "ERror! ".$e->getMessage();
        }
    }

    protected function insertCollege($college_name,$college_description){
        try{
            $sql = "INSERT INTO colleges(college_name,college_description) VALUES(?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$college_name,$college_description]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function insertUniversityCollege($university_id,$college_id,$status,$filename){
        try{
            $upload_dir = '../imgs/';
            $filename = $_FILES["image"]["name"];
            //change image file name dynamically
            $filename = time().'_'.$filename;
            $destination = $upload_dir . $filename;
            if(move_uploaded_file($_FILES["image"]["tmp_name"],$destination)){
                $sql = "INSERT INTO university_colleges (university_id,college_id,status,logo) VALUES(?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$university_id,$college_id,$status,$filename]);
                if($stmt){
                    echo 'success';
                }else{
                    echo 'error';
                }
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function createUniversity($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$filename){
        try{
            $upload_dir = '../imgs/';
            $filename = $_FILES["image"]["name"];
            //change image file name dynamically
            $filename = time().'_'.$filename;
            $destination = $upload_dir . $filename;
            if(move_uploaded_file($_FILES["image"]["tmp_name"],$destination)){
                $sql = "INSERT INTO university(university_name,region,province,city,barangay,university_email,university_status,university_description,university_type,university_image) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$filename]);
                if($stmt){
                    echo "success";
                }else{
                    echo "Error";
                }
    
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
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){

        }
    }

    protected function universityCourse($university_college_id,$course_id,$status,$tuition_per_sem){
        try{
            $sql = "INSERT INTO university_course (university_college_id,course_id,status,tuition_per_sem)
                    VALUES(?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_college_id,$course_id,$status,$tuition_per_sem]);
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function studentReview($university_id,$student_id,$university_rating_description,$rating){
        try{
            
            //check if student already rated
            $checkStudentRatingQuery = 'SELECT * FROM university_rating WHERE student_id = ?';
            $stmtCheckStudentRating = $this->connect()->prepare($checkStudentRatingQuery);
            $stmtCheckStudentRating->execute([$student_id]);
            if($stmtCheckStudentRating->rowCount() > 0){
                echo 'already rated';
            }else{
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
                    //check rating description empty and rating
                    $errors = [];
                    if(empty($university_rating_description)){
                        $errors[] = 'Rating description is required';
                    }

                    if(empty($rating)){
                        $errors[] = 'Rating is required';
                    }

                    if(empty($errors)){
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
                        $bulkError = json_encode($errors);
                        return $bulkError;
                    }
                }else{
                    echo "different university";
                }
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function studentUniversityCourseReview($university_course_id,$student_id,$course_rating,$course_rating_description){
        try{
            //check if student already rated
            $checkStudentRatingQuery = 'SELECT * FROM university_course_rating WHERE student_id = ?';
            $stmtCheckStudentRating = $this->connect()->prepare($checkStudentRatingQuery);
            $stmtCheckStudentRating->execute([$student_id]);
            if($stmtCheckStudentRating->rowCount() > 0){
                echo 'already rated';
            }else{
                //retrieve student email
                $retrieveStudentEmailQuery = "SELECT * FROM student WHERE student_id = ?";
                $stmtStudentResult = $this->connect()->prepare($retrieveStudentEmailQuery);
                $stmtStudentResult->execute([$student_id]);
                $studentRow = $stmtStudentResult->fetch();
                $student_email = $studentRow['student_email'];

                //retrieve university email 
                $retrieveUniversityEmailQuery = "SELECT * FROM university_college_courses_view WHERE university_course_id = ? GROUP BY university_id";
                $stmtResult = $this->connect()->prepare($retrieveUniversityEmailQuery);
                $stmtResult->execute([$university_course_id]);
                $universityRow = $stmtResult->fetch();
                $university_email = $universityRow['university_email'];


                //extract domain name
                $student_domain = substr(strchr($student_email, "@"), 1);
                $university_domain = substr(strchr($university_email, "@"), 1);

                //check if student go to the same university using email
                if($student_domain === $university_domain){
                    $errors = [];

                    if(empty($course_rating_description)){
                        $errors[] = 'Rating description is required';
                    }

                    if(empty($course_rating)){
                        $errors[] = 'Rating is required';
                    }

                    if(empty($errors)){
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
                        $bulkError = json_encode($errors);
                        return $bulkError;
                    }
                    
                }else{
                    echo "different university";
                }
            }

        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    //display or view functionalities
    protected function displayCertainUniversityImage($university_id){
        try{
            $sql = "SELECT * FROM university_images WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetchAll();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCertainUniversityCollegeCourseData($university_id){
        try{
            $sql = "SELECT * FROM university_college_courses_view WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetchAll();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayUniversity($pageNumber){
        try{
            $offset = ($pageNumber - 1) * 6; 
            $sql = "SELECT * FROM university";
            $stmt = $this->connect()->query($sql);
            $stmt->execute();
            $rowNumbers = $stmt->rowCount();

            $sql .= " ORDER BY university_id LIMIT $offset,6";
            $stmt = $this->connect()->query($sql);
            $stmt->execute();

            $universities = [];
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetchAll()){
                    $universities[] = $row;
                }
            }

            $totalRows = $rowNumbers;
            $totalPages = ceil($totalRows / 6);
            $html = '';
            foreach($universities as $university){
                foreach($university as $value){
                    $html .= '
                        <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden"> <!-- Simplified card container -->
                                <a href="#">
                                    <img class="w-full h-40 object-cover" src="imgs/'.$value['university_image'].'" alt="" /> <!-- Ensured image covers card top evenly -->
                                </a>
                                <div class="p-5">
                                    <div class="mb-2 flex justify-between items-center">
                                        <h5 class=" text-md font-bold tracking-tight text-gray-900">'.$value['university_name'].'</h5>
                                        <h5 class="text-md font-bold tracking-tight text-gray-900">'.$value['university_type'].' School</h5>
                                    </div>
                                    <p class="mb-3 font-normal text-gray-700 text-sm leading-snug">'.$value['university_description'].'</p>
                                <div class="flex justify-between">
                                    <a href="view_university.php?university_id='.$value['university_id'].'" class="inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Read more
                                    <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    </a>
                                    <p class="university_rating" university_id="'.$value['university_id'].'"></p>
                                </div>
                                    
                                </div>
                        </div>';
                }

            }
            $pageHtml = '';

            $pageHtml .= '
            <nav aria-label="Page navigation example">
                <div class="inline-flex -space-x-px text-sm">
                    <button class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="previousPage('.$pageNumber.')">
                        Previous
                    </button>';
            for($i = 1; $i<= $totalPages; $i++){
                if($i == $pageNumber){
                    $pageHtml .= '<button class="flex items-center justify-center px-3 h-8 leading-tight text-white bg-blue-700 border border-gray-300 rounded-s-lg hover:bg-blue-800 hover:text-white" onclick="changePage('.$i.')">'.$i.'</button>';
                }else{
                    $pageHtml .= '<button class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="changePage('.$i.')">'.$i.'</button>';
                }
            }

            $pageHtml .= '
                    <button class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="nextPage('.$pageNumber.','.$totalPages.')">
                        Next
                    </button>
                </div>
            </nav>';

            $htmlTags = [
                'html' => $html,
                'pageHtml' => $pageHtml
            ];
            return $htmlTags;
            
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function searchUniversity($pageNumber,$searchItem){
        try{
    
            $offset = ($pageNumber - 1) * 6;
          
            $columns = [];

            //retrieve all columns in university table
            $retrieveColumnQuery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'university'";
            $stmt = $this->connect()->query($retrieveColumnQuery);
            $stmt->execute();

            if($stmt){
                while($row = $stmt->fetch()){
                    $columns[] = $row['COLUMN_NAME'];
                }
            }
            
            //search university query using dynamic columns
            $sql = "SELECT * FROM university WHERE (";
            foreach($columns as $column){
                $sql .= $column." LIKE '%$searchItem%' OR ";
            }

            $sql = rtrim($sql,'OR ');
            $sql .= ")";
            $searchStmt = $this->connect()->query($sql);
            $searchStmt->execute();
            $numRows = $searchStmt->rowCount();

            $tolRows = $numRows;
            $totalPages = ceil($tolRows / 6);

            $sql .= " ORDER BY university_id LIMIT $offset,6";
            $searchResult = $this->connect()->query($sql);
            $searchResult->execute();

            $universities = [];

            if($searchResult->rowCount() > 0){
                while($row = $searchResult->fetchAll()){
                    $universities[] = $row;
                }
            }

            $html = '';
            foreach($universities as $university){
                foreach($university as $value){
                    $html .= '<div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden"> <!-- Simplified card container -->
                                <a href="#">
                                    <img class="w-full h-40 object-cover" src="imgs/'.$value['university_image'].'" alt="" /> <!-- Ensured image covers card top evenly -->
                                </a>
                                <div class="p-5">
                                    <div class="mb-2 flex justify-between items-center">
                                        <h5 class=" text-md font-bold tracking-tight text-gray-900">'.$value['university_name'].'</h5>
                                        <h5 class="text-md font-bold tracking-tight text-gray-900">'.$value['university_type'].' School</h5>
                                    </div>
                                    <p class="mb-3 font-normal text-gray-700">'.$value['university_description'].'</p>
                                    <div class="flex justify-between">
                                    <a href="view_university.php?university_id='.$value['university_id'].'" class="inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Read more
                                    <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    </a>
                                    <p class="university_rating" university_id="'.$value['university_id'].'"></p>
                                </div>
                                </div>
                            </div>';
                }
            }

            $pageHtml = '';
            $pageHtml .= '
            <nav aria-label="Page navigation example">
                <div class="inline-flex -space-x-px text-sm">
                    <button class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="previousPage('.$pageNumber.')">
                        Previous
                    </button>';
            for($i = 1; $i<= $totalPages; $i++){
                if($i == $pageNumber){
                    $pageHtml .= '<button class="flex items-center justify-center px-3 h-8 leading-tight text-white bg-blue-700 border border-gray-300 rounded-s-lg hover:bg-blue-800 hover:text-white" onclick="changePage('.$i.')">'.$i.'</button>';
                }else{
                    $pageHtml .= '<button class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="changePage('.$i.')">'.$i.'</button>';
                }
            }

            $pageHtml .= '
                    <button class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="nextPage('.$pageNumber.','.$totalPages.')">
                        Next
                    </button>
                </div>
            </nav>';

            $htmlTags = [
                'html' => $html,
                'pageHtml' => $pageHtml
            ];
            return $htmlTags;

        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function retrieveUniversity(){
        try{
            $sql = "SELECT * FROM university";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCollege(){
        try{
            $sql = "SELECT * FROM colleges";
            $stmt = $this->connect()->query($sql);
            $stmt = $stmt->fetchAll();
            return $stmt;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayUniversityColleges(){
        try{
            $sql = "SELECT * FROM university_colleges";
            $stmt = $this->connect()->query($sql);
            $stmt = $stmt->fetchAll();
            return $stmt;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCertainCollegeData($university_college_id){
        try{
            $sql = "SELECT * FROM university_colleges_view WHERE university_college_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_college_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }


    protected function displayCertainCollegeEdit($university_college_id){
        try{
            $sql = "SELECT * FROM university_colleges WHERE university_college_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_college_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCourse(){
        try{
            $sql = "SELECT * FROM course";
            $stmt = $this->connect()->query($sql);
            $stmt = $stmt->fetchAll();
            return $stmt;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayStudents(){
        try{
            $sql = "SELECT * FROM student_view";
            $stmt = $this->connect()->query($sql);
            $stmt = $stmt->fetchAll();
            return $stmt;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayRoundAvgRatings($university_id){
        try{
            $sql = "SELECT AVG(rating) as rating FROM university_rating WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCertainCollege($college_id){
        try{
            $sql = "SELECT * FROM colleges WHERE college_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$college_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCertainUniversity($university_id){
        try{
            $sql = "SELECT * FROM university WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCertainUniversityColleges($university_id){
        try{
            //retrieve all university colleges using university id
            $sql = "SELECT * FROM university_colleges_view WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetchAll();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displaySingleUniversityCollege($university_college_id){
        try{
            $sql = "SELECT * FROM university_colleges_view WHERE university_college_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_college_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayUniversityCollegeCourse($university_college_id){
        try{
            $sql = "SELECT * FROM university_college_courses_view WHERE university_college_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_college_id]);
            $row = $stmt->fetchAll();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

  


    protected function tryData($university_course_id){
        try{
            $sql = "SELECT * FROM university_college_courses_view WHERE university_course_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_course_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayUniversityRating($university_id){
        try{
            $sql = "SELECT * FROM university_rating WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $stmt = $stmt->fetchAll();
            return $stmt;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayUniversityRatingAverage($university_id){
        try{
            $sql = "SELECT AVG(rating) as rating FROM university_rating WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayUniversityCount($university_id){
        try{
            $sql = "SELECT COUNT(*) as count FROM university_rating WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayUniversityImage($university_id){
        try{
            $sql = "SELECT * FROM university_images WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $row = $stmt->fetchAll();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCertainCollegeCourseRatingCount($university_course_id){
        try{
            $sql = "SELECT COUNT(*) as count FROM university_course_rating WHERE university_course_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_course_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCollegeCourseAvgRating($university_course_id){
        try{
            $sql = "SELECT AVG(course_rating) as rating FROM university_course_rating WHERE university_course_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_course_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayTopFiveCourses($university_id){
        try{
            //retrieve top 5 highest rating course 
            $sql = "SELECT AVG(course_rating) as rating,course_name FROM university_college_course_rating_view WHERE university_id = ? GROUP BY course_name ORDER BY rating DESC LIMIT 5";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id]);
            $stmt = $stmt->fetchAll();
            return $stmt;
        }catch(PDOException $e){
            echo "Error! ".$e->getMessage();
        }
    }

    protected function displayUniversityCourseRating($university_id){
        try{
            //retrieve all university course using university id
            $query = "SELECT * FROM university_course WHERE university_id = ?";
            $stmtQuery = $this->connect()->prepare($query);
            $stmtQuery->execute([$university_id]);
            $row = $stmtQuery->fetchAll();
            $university_course_id = [];

            foreach($row as $value){
                $university_course_id[] = $value['university_course_id'];
            }

            $course_ratings = [];
            foreach($university_course_id as $id){
                //retrieve all university course rating using university university_course_id
                $retrieveSql = "SELECT * FROM university_college_course_rating_view WHERE university_course_id = ?";
                $stmt = $this->connect()->prepare($retrieveSql);
                $stmt->execute([$id]);
                $stmt = $stmt->fetchAll(); 
                $course_ratings[] = $stmt;
            }
            return $course_ratings;
            
        
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function displayCertainCOllegeCourseRating($university_course_id){
        try{
            $sql = "SELECT * FROM university_course_rating WHERE university_course_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_course_id]);
            $row = $stmt->fetchAll();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }



    protected function displayCertainCollegeCourseRatingAverage($university_course_id){
        try{
            $sql = "SELECT ROUND(AVG(course_rating),1) as rating FROM university_course_rating WHERE university_course_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_course_id]);
            $row = $stmt->fetch();
            return $row;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function retrieveStudentDetails($student_id){
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
    protected function checkSessionNotSet($session_name){
        if(!isset($_SESSION[''.$session_name.''])){
            header("location:../index.php");
        }
    }

    protected function checkSessionSet($session_name,$path){
        if(isset($_SESSION[''.$session_name.''])){
            header("location:".$path."/index.php");
        }
    }

    //check student email if institutional email using ajax
    protected function checkStudentEmail($email){
        if (preg_match('/^[^@]+@[^@]+\.[^@]*(edu\.ph)$/', $email)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    //update functions
    protected function updateUniversity($university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$university_id){
        try{
            $sql = "UPDATE university SET university_name = ?,region = ?,province = ?,city = ?,barangay = ?,university_email = ?,university_status = ?,university_description = ?,university_type = ? WHERE university_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_name,$region,$province,$city,$barangay,$university_email,$university_status,$university_description,$university_type,$university_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function updateCollege($college_id,$college_name,$college_description){
        try{
            $sql = "UPDATE Colleges SET college_name = ?,college_description = ? WHERE college_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$college_name,$college_description,$college_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function updateUniversityCollege($university_college_id,$university_id,$college_id,$status){
        try{
            $sql = "UPDATE university_colleges SET university_id = ?,college_id = ?,status = ? WHERE university_college_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_id,$college_id,$status,$university_college_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }
    
    protected function updateCourse($course_id,$course_name,$course_description){
        try{
            $sql = "UPDATE course SET course_name = ?,course_description = ? WHERE course_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$course_name,$course_description,$course_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }


    
    protected function updateStudent($student_id,$student_firstname,$student_lastname,$student_email,$university_id){
        try{
            $sql = "UPDATE student SET student_firstname = ?,student_lastname = ?,student_email = ?,university_id = ? WHERE student_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$student_firstname,$student_lastname,$student_email,$university_id,$student_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }

    }

    protected function uploadMultipleUniversityImage($university_id,$university_images){
        try{
            $upload_dir = '../imgs/';
            
            //loop through each uploaded image
            $university_images = $_FILES['images'];
            $uploaded_images = [];  
            $errors = [];

            foreach($university_images['tmp_name'] as $key => $tmp_name){
                $filename = $university_images['name'][$key];
                $filename = time().'_'.$filename;
                $destination = $upload_dir . $filename;
                $file_size = $university_images['size'][$key];
                $file_type = $university_images['type'][$key];

                // if($file_size > 2097152){
                //     $errors[] = 'File size must be less than 2MB';
                //     continue;
                // }

                //move uploaded image to destination
                if(move_uploaded_file($tmp_name,$destination)){
                    $uploaded_images[] = $filename;

                    //insert uploaded image to database
                    $sql = "INSERT INTO university_images (university_id,university_image) VALUES(?,?)";
                    $stmt = $this->connect()->prepare($sql);
                    $stmt->execute([$university_id,$filename]);
                }else{
                    $errors[] = 'Failed to upload image';
                }
            }

            if(empty($errors)){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }

    protected function updateUniversityCourse($university_course_id,$university_college_id,$course_id,$status,$tuition_per_sem){
        try{
            $sql = 'UPDATE university_course SET university_college_id = ?, course_id = ?,status = ?, tuition_per_sem = ? WHERE university_course_id = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$university_college_id,$course_id,$status,$tuition_per_sem,$university_course_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo 'ERROR! '.$e->getMessage();
        }
    }

    protected function updateUniversityCourseRating($student_id,$course_rating,$course_rating_description){
        try{
            $sql = "UPDATE university_course_rating SET course_rating = ?,course_rating_description = ?, date_occurred = CURRENT_DATE() WHERE student_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$course_rating,$course_rating_description,$student_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo 'ERROR! '.$e->getMessage();

        }
        
    }

    protected function updateUniversityRating($student_id,$rating,$university_rating_description){
        try{
            $sql = "UPDATE university_rating SET rating = ?,university_rating_description = ?,date_occurred = CURRENT_DATE() WHERE student_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$rating,$university_rating_description,$student_id]);
            if($stmt){
                echo 'success';
            }else{
                echo 'error';
            }
        }catch(PDOException $e){
            echo 'ERROR! '.$e->getMessage();
        }
    }


}

?>