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
    <div class="w-fit h-fit bg-green-50 flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%] mx-auto bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
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
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search University/College" required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
            <div class="whole_container mt-5">
                <div class="main_content page-content grid grid-cols-3 gap-4">

                </div>
                <div class="page_number">

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
                    // Update the container's HTML and fade it back in
                    $('.whole_container').html(response).animate({
                        opacity: 1
                    }, 200);
                }
            });
        });
    }

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