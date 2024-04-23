<?php
include_once 'header.php';
include_once '../includes/autoloader.php';



if (isset($_GET['university_id'])) {
    $init = new UniversityControllers();
    $university_id = $_GET['university_id'];
    // $init->checkNoSession('isAdmin');

    $views = new UniversityView();
    $university = $views->displayCertainUniversityView($university_id);
    $reviewCount = $views->displayUniversityCountView($university_id);
    $universityRatingData = $views->universityRatingData($university_id);
} else {
    include_once '404.php';
}


?>

<body class="bg-[#f6f6f6]">
    <div class="main_container p-[2rem] w-full gap-5">
        <div class="main_information w-[80%] mt-5 mx-auto">
            <div class="w-full px-4 mt-[-3rem]">
                <h1 class="text-xl font-bold text-center"><?= $university['university_name']; ?> Review</h1>
                <div class="w-full flex justify-between mb-10">
                    <button type="button" class="back_button flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                        <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg> <span>Go back</span>
                    </button>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion(<?= $reviewCount['count']; ?>)</h2>
                </div>
                <!-- check if not empty -->
                <div class="bg-white rounded-md p-[2rem] shadow-lg">
                    <?php if (!empty($universityRatingData)) : ?>
                        <?php foreach ($universityRatingData as $ratings) : ?>
                            <article class="p-2 text-base bg-[#f6f6f6] rounded-lg dark:bg-gray-900 mb-2">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img class="mr-2 w-6 h-6 rounded-full" src="../imgs/profile.png" alt="Michael Gough">Anonymous</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400"><?= $ratings['date_occurred'] ? date("F j, Y", strtotime($ratings['date_occurred'])) : ''; ?></p>
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
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-center text-lg font-black dark:text-gray-400">No reviews yet</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="../assets/index.js"></script>
<script>
    $('.back_button').click(function() {
        window.location.href = 'university.php';
    });
</script>

</html>