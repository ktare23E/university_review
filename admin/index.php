<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
session_start();
$init = new UniversityControllers();
$init->checkNoSession('isAdmin');
?>

<body>
    <div class="main_container w-screen h-screen bg-green-50 grid grid-cols-[13%,80%] gap-2">
        <?php include_once 'sidebar.php'; ?>
        <div class="main_information w-full mt-5">
            <h1 class="text-xl">Dashboard</h1>
            <div class="analytics_container mt-3 grid grid-cols-3 gap-3">
                <div class="card bg-white p-[2rem] rounded-md shadow-lg">
                    
                </div>
                <div class="card bg-white p-[2rem] rounded-md shadow-lg">
                    
                </div>
                <div class="card bg-white p-[2rem] rounded-md shadow-lg">
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>