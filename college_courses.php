<?php
include_once 'header.php';
include_once 'includes/autoloader.php';
if (isset($_GET['university_college_id'])) {
    $university_college_id = $_GET['university_college_id'];


    $init = new UniversityView();
    $data = $init->displayCertainCollegeDataView($university_college_id);
    $courses = $init->displayUniversityCollegeCourseView($university_college_id);
    $pesoSign = '₱';


} else {
    include_once '404.php';
    die();
}

?>


<body class="bg-green-50">
    <div class="parent_class p-[2rem] py-1  flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%]  mx-auto  bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
        <?php include_once 'banner.php';?>

            <button type="button" class="back_button w-full flex items-center justify-center px-2 py-1 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>Go back</span>
            </button>

            <div class="colleges_information w-full mt-5">
                <h1 class="text-2xl font-bold text-center mb-5"><?= $data['university_name'].' '.$data['college_name'].' Courses'; ?></h1>
                <div class="bg-[#f6f6f6] p-[2rem] rounded-md">
                    <div class="grid grid-cols-2 gap-4">
                        <?php if(!empty($courses)):?>
                            <?php foreach($courses as $course):?>
                                <div class="bg-white  text-center p-4 rounded-md shadow-md">
                                    <div class="flex justify-between mb-2">
                                        <h1 class="text-xl font-bold"><?= $course['course_name']; ?></h1>
                                        <!-- <p class="text-gray-700"><?= $course['course_description']; ?></p> -->
                                        <h1 class="text-sm font-bold">Course Fee: <?= $course['tuition_per_sem'] === 0 ? 'Free':$pesoSign.number_format($course['tuition_per_sem'],2,'.',','); ?></h1>
                                        <p class="course_rating" university_course_id="<?= $course['university_course_id']; ?>"></p>
                                    </div>
                                    <button class="bg-blue-600 text-sm rounded-md p-2 text-white">Rate Course</button>
                                </div>
                        
                            <?php endforeach; ?>
                        <?php else:?>
                            <p class="text-center">No courses found</p>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $('.back_button').click(function() {
        window.location.href = 'view_university_colleges.php?university_id=<?php echo $data['university_id'] ?>';
    });
    
    //display individual course rating
    $('.course_rating').each(function() {
        var university_course_id = $(this).attr('university_course_id');
        var course_rating = $(this);
        $.ajax({
            url: 'includes/displayUniversityCourseRating.php',
            type: 'POST',
            data: {
                university_course_id: university_course_id,
            },
            success: function(data) {
                let rating = JSON.parse(data);
                course_rating.html(`Ratings: ${rating['rating'] === null ? '0':rating['rating']}`);
            }
        });
    });
</script>

</html>