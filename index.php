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
        <div class="w-[70%] mx-auto bg-white px-10 py-5 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
            <div class="header flex justify-between items-center mb-10"> <!-- Adding bottom margin for spacing -->
                <div class="logo_container flex items-center gap-4"> <!-- Adjusted gap -->
                    <img src="imgs/logo.jpg" alt="" class="rounded-full w-10 h-10"> <!-- Removed object-cover and mt-5 for logo -->
                    <h1 class="font-bold text-xl">RateMeSchool</h1> <!-- Adjusted font size -->
                </div>
                <a href="login.php" class="text-white bg-black px-1 rounded-sm hover:text-white transition duration-300 ease-in-out">Sign in</a> <!-- Enhanced link styling -->
            </div>
            <div class="whole_container">
                <div class="main_content grid grid-cols-3 gap-4">

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

        $.ajax({
            url: 'includes/displayUniversity.php',
            type: 'POST',
            data: {
                isDisplay: isDisplay,
                pageNumber: pageNumber
            },
            success: function(response) {
                $('.whole_container').html(response);
            }
        });
    }

    function nextPage(pageNumber, totalPages){
        if(pageNumber < totalPages){
            displayUniversity(pageNumber + 1);
        }
    }
</script>

</html>