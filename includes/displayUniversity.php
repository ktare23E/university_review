<?php
    include_once 'autoloader.php';
    if(isset($_POST['isDisplay'])){
        $pageNumber = $_POST['pageNumber'];
        $init = new UniversityView();
        $htmlTags = $init->universityData($pageNumber);
        echo '<div class="main_content grid grid-cols-3 gap-4">' . $htmlTags['html'] . '</div>';
        echo '<div class="page_number mt-5">' . $htmlTags['pageHtml'] . '</div>';
    }
?>