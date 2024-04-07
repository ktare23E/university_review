<?php
require 'includes/autoloader.php';
$init = new UniversityControllers();
// echo $init->insertRating(1,1,'bati sya',3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RateMeSchool</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-screen h-screen ">
        <div class="parent_container w-[70%] mx-auto bg-[#f6f6f9] h-full flex flex-col gap-20">
            <div class="header flex justify-between w-full items-start text-sm h-[5%]">
                <div class="logo_container flex items-center justify-center gap-2 h-5"> <!-- Added flex and items-center for vertical alignment -->
                    <img src="imgs/logo.jpg" alt="" class="rounded-full w-10 h-10 object-cover mt-5"> <!-- Tailwind classes added here -->
                    <h1 class="font-bold">RateMeSchool</h1>
                </div>
                <a href="" class="text-sm rounded-sm text-[12px]">Sign in</a>
            </div>
            <div class="main_content">
                Content
            </div>
        </div>
    </div>
</body>

</html>