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
    <div class="parent_class h-screen w-screen bg-green-50 flex items-start justify-center"> <!-- Centering the whole page content -->
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

            <div class="colleges_information">
                <h1 class="text-2xl font-bold text-center mb-5"><?= $universityData['university_name'];?> Colleges</h1>
                <div class="colleges_container grid grid-cols-1 gap-4">
                    <?php
                    if ($colleges) {
                        foreach ($colleges as $college) {
                    ?>
                            <div class="college_card bg-gray-100 p-4 rounded-lg shadow-lg">
                                <h1 class="text-xl font-bold text-center mb-2"><?php echo $college['college_name'] ?></h1>
                                <p class="text-center"><?php echo $college['college_description'] ?></p>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="text-center">No colleges found</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $('.back_button').click(function() {
        window.location.href = 'view_university.php?university_id=<?php echo $university_id ?>';
    });
</script>

</html>