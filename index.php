<?php
    include_once 'includes/autoloader.php';
    $init = new UniversityView();
    $data = $init->retrieveUniversityView();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RateMeSchool</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="parent_class w-fit h-fit bg-green-50 flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%] mx-auto  bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
            <div class="header flex justify-between items-center mb-10"> <!-- Adding bottom margin for spacing -->
                <div class="logo_container flex items-center gap-4"> <!-- Adjusted gap -->
                    <img src="imgs/logo.jpg" alt="" class="rounded-full w-10 h-10"> <!-- Removed object-cover and mt-5 for logo -->
                    <h1 class="font-bold text-xl">RateMeSchool</h1> <!-- Adjusted font size -->
                </div>
                <div class="py-6">
                    <a href="login.php" class="-mx-3 bg-black text-white block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 hover:bg-white-50">Log in</a>
                </div>
            </div>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search_university" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search University/College" required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
            <div class="whole_container mt-5">
                <!-- Display the university dynamically -->
                <div class="main_content grid grid-cols-3 gap-4">
                    <?php foreach($data as $university):?>
                        <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden"> <!-- Simplified card container -->
                            <a href="#">
                                <img class="w-full h-40 object-cover" src="imgs/<?= $university['university_image']?>" alt="" /> <!-- Ensured image covers card top evenly -->
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?= $university['university_name']; ?></h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                <a href="view_university.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Read more
                                    <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    //display the university dynamically using ajax
    displayUniversity(1);

    function displayUniversity(pageNumber) {
        let isDisplay = true;

        // Fade out the current content
        $('.whole_container').animate({
            opacity: 0
        }, 200, function() {
            // After the fade-out, load new content
            $.ajax({
                url: 'includes/displayUniversity.php',
                type: 'POST',
                data: {
                    isDisplay: isDisplay,
                    pageNumber: pageNumber
                },
                success: function(response) {
                  //check dynamically if the main_content container is empty
                    let mainContent = $('.main_content');
                    let parent_class = $('.parent_class');

                      // Update the container's HTML and fade it back in
                      $('.whole_container').html(response).animate({
                        opacity: 1
                        }, 200);
                }
            });
        });
    }

    function searchUniversity(pageNumber) {
        let search = $('#search_university').val();
        let isSearch = true;

        // Fade out the current content
        $('.whole_container').animate({
            opacity: 0
        }, 200, function() {
            // After the fade-out, load new content
            $.ajax({
                url: 'includes/searchUniversity.php',
                type: 'POST',
                data: {
                    isSearch: isSearch,
                    search: search,
                    pageNumber: pageNumber
                },
                success: function(response) {
                    //check dynamically if the main_content container is empty
                        // Update the container's HTML and fade it back in
                        $('.whole_container').html(response).animate({
                        opacity: 1
                        }, 200);
                }
            });
        });
    }

    $('#search_university').on('input', function() {
        let pageNumber = 1;
        searchUniversity(pageNumber);
    });

    function previousPage(pageNumber) {
        if (pageNumber > 1) {
            displayUniversity(pageNumber - 1);
        }
    }

    function nextPage(pageNumber, totalPages) {
        if (pageNumber < totalPages) {
            displayUniversity(pageNumber + 1);
        }
    }

    function changePage(pageNumber) {
        displayUniversity(pageNumber);
    }
</script>

</html>