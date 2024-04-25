<?php
include_once 'header.php';
include_once 'includes/autoloader.php';
if (isset($_GET['university_course_id'])) {
    $university_course_id = $_GET['university_course_id'];


    $init = new UniversityView();
    $courseData = $init->tryDataView($university_course_id);
    $ratingsData = $init->displayCertainCOllegeCourseRatingView($university_course_id);
    $ratingCount = $init->displayCertainCollegeCourseRatingCountView($university_course_id);
    $avgCourseRating = $init->displayCollegeCourseAvgRatingVIew($university_course_id);


    $avgRating = bcdiv($avgCourseRating['rating'],'1',2);

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
                <h1 class="text-2xl font-bold text-center mb-5"><?= $courseData['university_name'].' '.$courseData['college_name'].' '.$courseData['course_name'].' Reviews'; ?></h1>
                <section class="bg-gray-100 mt-5 rounded-lg shadow-lg dark:bg-gray-900 py-0 lg:py-16 antialiased">
                    <div class="w-full px-4 mt-[-3rem]">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion(<?= $ratingCount['count']; ?>)</h2>
                            <h2>Total Reviews: <?= $avgRating; ?></h2>
                        </div>
                        <form class="mb-6">
                            <div class="grid grid-cols-[70%,25%] gap-5">
                                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <textarea id="course_rating_description" rows="2" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Write a review..."></textarea>
                                </div>
                                <!-- Create container for dropdown rating value with design -->
                                <div class="rating flex items-center">
                                    <input type="radio" id="star1" name="rating" value="1" class="hidden" />
                                    <label for="star1" class="flex items-center cursor-pointer" title="1">
                                        <svg class="w-6 h-6 fill-current text-gray-400 hover:text-orange-400 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </label>
                                    <input type="radio" id="star2" name="rating" value="2" class="hidden" />
                                    <label for="star2" class="flex items-center cursor-pointer" title="2">
                                        <svg class="w-6 h-6 fill-current text-gray-400 hover:text-orange-400 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </label>
                                    <input type="radio" id="star3" name="rating" value="3" class="hidden" />
                                    <label for="star3" class="flex items-center cursor-pointer" title="3">
                                        <svg class="w-6 h-6 fill-current text-gray-400 hover:text-orange-400 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </label>
                                    <input type="radio" id="star4" name="rating" value="4" class="hidden" />
                                    <label for="star4" class="flex items-center cursor-pointer" title="4">
                                        <svg class="w-6 h-6 fill-current text-gray-400 hover:text-orange-400 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </label>
                                    <input type="radio" id="star5" name="rating" value="5" class="hidden" />
                                    <label for="star5" class="flex items-center cursor-pointer" title="5">
                                        <svg class="w-6 h-6 fill-current text-gray-400 hover:text-orange-400 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    </label>
                                </div>
                            </div>
                            <button type="button" class="college_course_rating_btn inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                Post review
                            </button>
                        </form>
                        <?php if(!empty($ratingsData)):?>
                            <?php foreach($ratingsData as $ratings):?>
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
                                    
                                </footer>
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-500 dark:text-gray-400"><?= $ratings['course_rating_description']; ?></p>
                                    <img src="ratings/rating-<?= $ratings['course_rating']?>0.png" alt="" class="h-5">
                                </div>
                                
                            </article>
                            <?php endforeach;?>
                        <?php else:?>
                            <p class="text-center">No reviews Yet.</p>
                        <?php endif;?>
                        
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

<script>
    $('.back_button').click(function() {
        window.location.href = 'college_courses.php?university_college_id=<?php echo $courseData['university_college_id'] ?>';
    });

    //rating
    $('.rating label').click(function() {
        let rating = $(this).attr('title');
        $('#rating').val(rating);

        //change colors of stars depending on the rating
        let star = $(this).attr('title');
        let starCount = 1;
        $('.rating label').each(function() {
            if (starCount <= star) {
                $(this).children('svg').removeClass('text-gray-400').addClass('text-orange-400');
            } else {
                $(this).children('svg').removeClass('text-orange-400').addClass('text-gray-400');
            }
            starCount++;
        });
    });

    $('.college_course_rating_btn').click(function(){
        let course_rating_description = $('#course_rating_description').val();
        let course_rating = $('input[name="rating"]:checked').val();
        let university_course_id = <?= $university_course_id; ?>;
        let isCourseRate = true;

        $.ajax({
            url: 'includes/insertUniversityCollegeCourseRating.php',
            type: 'POST',
            data: {
                course_rating_description: course_rating_description,
                course_rating: course_rating,
                university_course_id: university_course_id,
                isCourseRate: isCourseRate
            },
            success: function(data) {
                console.log(data);
                if(data === 'login'){
                    alert('Please login first to rate');
                    setTimeout(() => {
                        location.href = 'login.php';
                    }, 1000);
                }else if(data === 'already rated'){
                    alert('You already rated this university');
                }else if(data === 'different university'){
                    alert('You are rating a different university');
                }else if(data === '["Rating description is required","Rating is required"]'){
                    alert('Rating and Rating description is required');
                }
                else{
                    alert('Rating posted');
                    location.reload();
                }
            }
        });
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