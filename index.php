<?php
    include_once 'includes/autoloader.php';
    include_once 'header.php';
    $init = new UniversityView();
    $data = $init->retrieveUniversityView();


    $new = new UniversityControllers();


?>



<body class="bg-green-50">
    <div class="parent_class p-[2rem] pt-0 pb-5 flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%] mx-auto  bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
            <?php include_once 'banner.php';?>
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
                                <div class="mb-2 flex justify-between items-center">
                                    <h5 class=" text-md font-bold tracking-tight text-gray-900"><?= $university['university_name']; ?></h5>
                                    <h5 class="text-md font-bold tracking-tight text-gray-900"><?= $university['university_type']; ?>School</h5>
                                </div>
                                <p class="mb-3 font-normal text-gray-700 text-sm"></p>
                                <a href="view_university.php" class="inline-flex items-center px-2 py-1~ text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
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

    //display the university rating 
    

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
                    // find the university_rating class

                    // Update the container's HTML and fade it back in
                    $('.whole_container').html(response).animate({
                    opacity: 1
                    }, 200);
                    // checkChildElement(); // Call the function here

                    $('.university_rating').each(function() {
                        var university_id = $(this).attr('university_id');
                        var university_rating = $(this);
                        $.ajax({
                            url: 'includes/displayUniversityRating.php',
                            type: 'POST',
                            data: {
                                university_id: university_id,
                            },
                            success: function(data) {
                                console.log(data);
                                let rating = JSON.parse(data);
                                university_rating.html(`Rating: ${rating['rating'] === null ? '0':Math.floor(rating['rating'] * 100) /100}`);
                            }
                        });
                    });

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
                        // checkChildElement(); // Call the function here
                        
                        $('.university_rating').each(function() {
                        var university_id = $(this).attr('university_id');
                        var university_rating = $(this);
                        $.ajax({
                            url: 'includes/displayUniversityRating.php',
                            type: 'POST',
                            data: {
                                university_id: university_id,
                            },
                            success: function(data) {
                                console.log(data);
                                let rating = JSON.parse(data);
                                university_rating.html(`Rating: ${rating['rating'] === null ? '0':Math.floor(rating['rating'] * 100) /100}`);
                            }
                        });
                    });
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
        // checkChildElement(); // Call the function here

    }

    function nextPage(pageNumber, totalPages) {
        if (pageNumber < totalPages) {
            displayUniversity(pageNumber + 1);
        }
        // checkChildElement(); // Call the function here

    }

    function changePage(pageNumber) {
        displayUniversity(pageNumber);
        // checkChildElement(); // Call the function here

    }

    //check whole_container child element
    // function checkChildElement(){
    //     let mainContent = $('.main_content');
    //     let parent_class = $('.parent_class');
    //     if(mainContent.children().length <= 3 ){
    //         parent_class.addClass('h-screen');
    //     }else{
    //         parent_class.removeClass('h-screen');
    //     }
    // }



</script>

</html>