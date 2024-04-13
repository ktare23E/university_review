<?php
    include_once 'autoloader.php';

    if(isset($_POST['isSearch'])){
        $search = $_POST['search'];
        $pageNumber = $_POST['pageNumber'];
        
        $init = new UniversityControllers();
        $data = $init->searchUniversityControllers($pageNumber,$search);
        echo '<div class="main_content grid grid-cols-3 gap-4">' . $data['html'] . '</div>';
        echo '<div class="page_number mt-5">' . $data['pageHtml'] . '</div>';
    }

?>