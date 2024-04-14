<?php
include_once 'header.php';
include_once 'includes/autoloader.php';
    if(isset($_GET['university_id'])){
        $university_id = $_GET['university_id'];
        $init = new UniversityView();

        //university Data
        $row = $init->displayCertainUniversityView($university_id);
       
        //university course data
        $universityCourseData = $init->universityCourseData($university_id);
        // if(count($universityCourseData) === 0){
        //     echo 'wla pay course';
        // }
        
        //university rating data
        $universityRatingData = $init->universityRatingData($university_id);
    }else{
        include_once '404.php';
        die();
    }

?>


<body>
    <div class="parent_class w-screen h-screen bg-green-50 flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%] h-[100%] mx-auto  bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
            <div class="header flex justify-between items-center mb-3"> <!-- Adding bottom margin for spacing -->
                <div class="logo_container flex items-center gap-4"> <!-- Adjusted gap -->
                    <img src="imgs/logo.jpg" alt="" class="rounded-full w-10 h-10"> <!-- Removed object-cover and mt-5 for logo -->
                    <h1 class="font-bold text-xl">RateMeSchool</h1> <!-- Adjusted font size -->
                </div>
                <div class="py-6">
                    <a href="login.php" class="-mx-3 bg-black text-white block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 hover:bg-white-50">Log in</a>
                </div>
            </div>

            <button type="button" class="back_button w-full flex items-center justify-center px-2 py-1 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>Go back</span>
            </button>

            <div class="university_info mt-5 p-[2.rem]">
                <div class="university_image">
                    <img src="imgs/<?= $row['university_image']?>" alt="" class="w-full h-64 object-cover rounded-lg">
                </div>
                <div class="university_info mt-3 w-full">
                    <div class="w-[80%] border-green-400">
                        <h1><?= $row['university_name']; ?></h1>
                        <h2><p><?= $row['university_description'];?></p></h2>
                    </div>
                    <div class="university_courses w-[20%] border-red-600">
                        <h1>University Courses</h1>
                        <ul>
                            <?php foreach($universityCourseData as $course):?>
                                <li><?= $course['course_name']; ?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <div class="rating_section">
                    <h1>University Rating</h1>
                        <?php foreach($universityRatingData as $ratings): ?>
                            <div class="rating">
                                <h2><?= $ratings['rating']; ?></h2>
                                <p><?= $ratings['university_rating_description']; ?></p>
                            </div>
                        <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $('.back_button').click(function() {
        window.location.href = 'index.php';
    });
    
 
</script>

</html>