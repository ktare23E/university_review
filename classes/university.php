<?php

Class University extends ConnectDatabase{
    protected function displayUniversity(){
        $sql = "SELECT * FROM university";
        $stmt = $this->connect()->query($sql);
        while($row=$stmt->fetch()){
            echo $row['university_name']." ".$row['university_address']."<br>";
        }
    }
}

?>