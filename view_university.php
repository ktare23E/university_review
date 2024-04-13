<?php

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
    <div class="parent_class w-screen h-screen bg-green-50 flex items-start justify-center"> <!-- Centering the whole page content -->
        <div class="w-[70%] h-[100%] mx-auto  bg-white px-10 py-3 rounded-lg shadow-lg"> <!-- Added padding, rounded corners, and shadow -->
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

            <div class="university_info mt-5">


                <div id="carousel-example" class="relative bg-gray-600 w-full">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                        <!-- Item 1 -->
                        <div id="carousel-item-1" class="hidden duration-700 ease-in-out">
                            <img src="imgs/gadtc.jpg" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="..." />
                        </div>
                        <!-- Item 2 -->
                        <div id="carousel-item-2" class="hidden duration-700 ease-in-out">
                            <img src="imgs/mit.jpg" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="..." />
                        </div>
                        <!-- Item 3 -->
                        <div id="carousel-item-3" class="hidden duration-700 ease-in-out">
                            <img src="imgs/nmsc.jpg" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="..." />
                        </div>
                        <!-- Item 4 -->
                        <div id="carousel-item-4" class="hidden duration-700 ease-in-out">
                            <img src="imgs/medina.png" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="..." />
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse">
                        <button id="carousel-indicator-1" type="button" class="h-3 w-3 rounded-full" aria-current="true" aria-label="Slide 1"></button>
                        <button id="carousel-indicator-2" type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 2"></button>
                        <button id="carousel-indicator-3" type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 3"></button>
                        <button id="carousel-indicator-4" type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 4"></button>
                    </div>
                    <!-- Slider controls -->
                    <button id="data-carousel-prev" type="button" class="group absolute left-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                            <svg class="h-4 w-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="hidden">Previous</span>
                        </span>
                    </button>
                    <button id="data-carousel-next" type="button" class="group absolute right-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                            <svg class="h-4 w-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="hidden">Next</span>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</body>

<script>
    const carouselElement = document.getElementById('carousel-example');

const items = [
    {
        position: 0,
        el: document.getElementById('carousel-item-1'),
    },
    {
        position: 1,
        el: document.getElementById('carousel-item-2'),
    },
    {
        position: 2,
        el: document.getElementById('carousel-item-3'),
    },
    {
        position: 3,
        el: document.getElementById('carousel-item-4'),
    },
];

// options with default values
const options = {
    defaultPosition: 1,
    interval: 3000,

    indicators: {
        activeClasses: 'bg-white dark:bg-gray-800',
        inactiveClasses:
            'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
        items: [
            {
                position: 0,
                el: document.getElementById('carousel-indicator-1'),
            },
            {
                position: 1,
                el: document.getElementById('carousel-indicator-2'),
            },
            {
                position: 2,
                el: document.getElementById('carousel-indicator-3'),
            },
            {
                position: 3,
                el: document.getElementById('carousel-indicator-4'),
            },
        ],
    },

    // callback functions
    onNext: () => {
        console.log('next slider item is shown');
    },
    onPrev: () => {
        console.log('previous slider item is shown');
    },
    onChange: () => {
        console.log('new slider item has been shown');
    },
};

// instance options object
const instanceOptions = {
  id: 'carousel-example',
  override: true
};
</script>

</html>