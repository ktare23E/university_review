<?php
include_once 'header.php';
include_once 'includes/autoloader.php';
if (isset($_GET['university_id'])) {
    $university_id = $_GET['university_id'];
    $init = new UniversityView();

    //university Data
    $row = $init->displayCertainUniversityView($university_id);

    //university course data
    $universityCourseData = $init->displayCertainUniversityCollegeCourseDataView($university_id);
    // if(count($universityCourseData) === 0){
    //     echo 'wla pay course';
    // }

    //university rating data
    $universityRatingData = $init->universityRatingData($university_id);

    //avg rating
    $avgRating = $init->displayRoundAvgRatingView($university_id);
    // if($avgRating['rating'] === null){
    //     echo 'wla pay nag rate';
    // }else{
    //     echo $avgRating['rating'];
    // }

    //retrieve all courses rating
    $courseRating = $init->universityCourseRating($university_id);
    // foreach($courseRating as $rating){
    //     foreach($rating as $rate){
    //         echo $rate['course_name'].' = '.$rate['course_rating'].'<br>';
    //     }
    // }

    $topFiveCourses = $init->displayTopFiveCoursesView($university_id);

    // foreach($topFiveCourses as $course){
    //     echo $course['course_name'].'='. $course['rating'].'<br>';
    // }

    $reviewCount = $init->displayUniversityCountView($university_id);

    //university colleges
    $UniversityColleges = $init->displayCertainUniversityCollegesView($university_id);
} else {
    include_once '404.php';
    die();
}

?>


<body>
    <div class="parent_class p-[2rem] py-0 bg-green-50 flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%]  mx-auto  bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
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
                    <img src="imgs/<?= $row['university_image'] ?>" alt="" class="w-full h-64 object-cover rounded-lg">
                </div>
                <div class="university_info mt-3 w-full flex gap-2 justify-between">
                    <div class="py-[0.5rem] bg-gray-100 px-3 w-[50%] rounded-lg shadow-xl">
                        <div class="header flex justify-between items-start ">
                            <div class="text-base">
                                <h1><?= $row['university_name']; ?></h1>
                                <h1>Address: <?= $row['university_address']; ?></h1>
                                <h1><?= $row['university_type']; ?> School</h1>
                            </div>
                            <h2 class="text-base"><?= $avgRating['rating'] === null ?  '<img class="h-5" src="ratings/rating-0.png">' : $avgRating['rating']; ?></h2>
                        </div>
                        <h1 class="mt-5 text-base">Description:</h1>
                        <p class="leading-snug text-base"><?= $row['university_description']; ?></p>
                    </div>
                    <div class="py-[0.5rem] bg-gray-100 px-3 w-[30%] rounded-lg shadow-xl">
                        <h1 class="text-center">University Colleges</h1>
                        <div class="flex flex-col">
                            <ul>
                                <?php foreach ($UniversityColleges as $college) : ?>
                                    <li class="text-sm"><?= $college['college_name']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="view_university_colleges.php?university_id=<?= $university_id;?>" class="text-sm text-blue-700 underline">View More Details</a>
                        </div>
                    </div>
                    <div class="university_courses w-[20%] bg-gray-100 rounded-lg px-2 py-2 shadow-xl">
                        <h1 class="text-center">Top 5 Courses</h1>
                        <div class="flex flex-col">
                            <ul>
                                <?php foreach ($universityCourseData as $course) : ?>
                                    <li><?= $course['course_name']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="rating_section mt-20">
                    <h1>University Rating</h1>
                    <div class="university_rating_container">
                        
                    </div>
                    <div class="flex flex-col">
                        <?php foreach ($universityRatingData as $ratings) : ?>
                            <div class="rating flex gap-2 bg-violet-400">
                                <h2><?= $ratings['rating']; ?></h2>
                                <p><?= $ratings['university_rating_description']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div> -->
                <section class="bg-gray-100 mt-5 rounded-lg shadow-lg dark:bg-gray-900 py-0 lg:py-16 antialiased">
                    <div class="w-full px-4 mt-[-3rem]">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion(<?= $reviewCount['count']; ?>)</h2>
                        </div>
                        <form class="mb-6">
                            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea id="comment" rows="2" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Write a review..." required></textarea>
                            </div>
                            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                Post review
                            </button>
                        </form>
                        <?php foreach($universityRatingData as $ratings):?>
                            <article class="p-2 text-base bg-white rounded-lg dark:bg-gray-900 mb-2">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img class="mr-2 w-6 h-6 rounded-full" src="imgs/profile.png" alt="Michael Gough">Anonymous</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400"><?= $ratings['date_occurred'] ? date("F j, Y",strtotime($ratings['date_occurred'])) : '';?></p>
                                    </div>
                                    <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                        </svg>
                                        <span class="sr-only">Comment settings</span>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownComment1" class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                </footer>
                                <p class="text-gray-500 dark:text-gray-400"><?= $ratings['university_rating_description']; ?></p>
                                
                            </article>
                        <?php endforeach;?>
                        
                        
                    </div>
                </section>
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