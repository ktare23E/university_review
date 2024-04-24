<?php
include_once 'header.php';
include_once 'includes/autoloader.php';
if (isset($_GET['university_id'])) {
    $university_id = $_GET['university_id'];
    $init = new UniversityView();

    $universityData = $init->displayCertainUniversityView($university_id);

    $colleges = $init->displayCertainUniversityCollegesView($university_id);
} else {
    include_once '404.php';
    die();
}

?>


<body>
    <div class="parent_class p-[2rem] bg-green-50 flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%]  mx-auto  bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
            <?php include_once 'banner.php';?>

            <button type="button" class="back_button w-full flex items-center justify-center px-2 py-1 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>Go back</span>
            </button>

            <div class="colleges_information w-full">
                <h1 class="text-2xl font-bold text-center mb-5"><?= $universityData['university_name']; ?> Colleges</h1>
                <div class="colleges_container grid grid-cols-2 gap-4 w-full">
                    <?php
                    if ($colleges) {
                        foreach ($colleges as $college) {
                    ?>
                            <div class="flex flex-col items-center w-full bg-white border border-gray-200 rounded-lg shadow md:flex-row  hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="imgs/<?=   $college['logo']?>" alt="">
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?=$college['college_name']; ?></h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?= $college['college_description']; ?></p>
                                    <a href="college_courses.php?university_college_id=<?=$college['university_college_id']; ?>" class="bg-blue-700 w-fit text-white py-1 px-2 rounded-md text-sm text-end">View Courses</a>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="place-items-centerr">No colleges found</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    checkChildElement();
    $('.back_button').click(function() {
        window.location.href = 'view_university.php?university_id=<?php echo $university_id ?>';
    });

     //check whole_container child element
    function checkChildElement(){
        let mainContent = $('.colleges_container');
        let parent_class = $('.parent_class');
        if(mainContent.children().length <= 3 ){
            parent_class.addClass('h-screen');
        }else{
            parent_class.removeClass('h-screen');
        }
    }
</script>

</html>