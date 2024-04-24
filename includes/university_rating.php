<?php

    if(isset($_POST['isRate'])){
        session_start();
        if(!isset($_SESSION['isStudent'])){
            echo "You must be logged in to rate a university.";
        }else{
            print_r($_POST);
        }
    }
?>