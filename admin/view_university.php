<?php
include_once 'header.php';
include_once '../includes/autoloader.php';

if (isset($_GET['university_id'])) {
    $init = new UniversityControllers();

    // $init->checkNoSession('isAdmin');
    $university_id = $_GET['university_id'];
    $views = new UniversityView();
    $university = $views->displayCertainUniversityView($university_id);
    $colleges = $views->displayCertainUniversityCollegesView($university_id);

}


?>

<body class="bg-[#f6f6f6]">
    <div class="main_container p-[2rem] w-full gap-5">
        <div class="main_information w-[80%] mt-5 mx-auto">
            <div class="first">
                <h1 class="text-xl font-bold"><?= $university['university_name']; ?> Colleges</h1>
                <div class="w-full flex justify-between">
                    <button type="button" class="back_button flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                        <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg> <span>Go back</span>
                    </button>

                    <button class="add_university py-1 px-1 bg-blue-600 text-white text-sm" data-modal-target="add_university_modal" data-modal-toggle="add_university_modal">Add University College</button>
                </div>
                <div class="university_colleges mt-3 bg-white p-[2rem] rounded-md shadow-lg grid grid-cols-3 gap-4">
                    <?php foreach ($colleges as $college) :?>
                        <div class="flex flex-col items-center w-full bg-white border border-gray-200 rounded-lg shadow md:flex-row  hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="../imgs/sict.jpg" alt="">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $college['college_name']?></h5>
                                <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400"><?= $college['college_description']; ?></p>
                                <a href="college_courses.php?university_college_id=<?= $college['university_college_id'];?>" class="bg-blue-700 w-fit text-white py-1 px-2 rounded-md text-sm text-end">View Courses</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="../assets/index.js"></script>



<script>
    let table = new DataTable('#myTable');
    closeModal('add_university_modal');
    closeModal('edit_university_modal');

    $('.back_button').click(function() {
        window.location.href = 'university.php';
    })

    $('.add_university_btn').click(function() {
        let formData = new FormData();
        let fileInput = $('#image')[0].files[0];
        formData.append('image', fileInput);
        formData.append('university_name', $('#university_name').val());
        formData.append('university_description', $('#university_description').val());
        formData.append('region', $('#region-text').val());
        formData.append('province', $('#province-text').val());
        formData.append('city', $('#city-text').val());
        formData.append('barangay', $('#barangay-text').val());
        formData.append('university_email', $('#university_email').val());
        formData.append('university_type', $('#university_type').val());
        formData.append('university_status', $('#university_status').val());


        $.ajax({
            url: '../includes/createUniversity.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data == 'success') {
                    alert('university added successfully');
                    location.reload();
                } else {
                    alert('Failed to add university');
                }
            }
        })
    })

    $('.update_university_btn').click(function() {
        let edit_university_id = $('#edit_university_id').val();
        let edit_university_name = $('#edit_university_name').val();
        let edit_university_description = $('#edit_university_description').val();
        let edit_university_status = $('#edit_university_status').val();
        let edit_university_email = $('#edit_university_email').val();
        let edit_university_type = $('#edit_university_type').val();
        let edit_region = $('#edit_region').val();
        let edit_province = $('#edit_province').val();
        let edit_city = $('#edit_city').val();
        let edit_barangay = $('#edit_barangay').val();

        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateUniversity.php',
            type: 'POST',
            data: {
                edit_university_id: edit_university_id,
                edit_university_name: edit_university_name,
                edit_university_description: edit_university_description,
                edit_university_status: edit_university_status,
                edit_university_email: edit_university_email,
                edit_university_type: edit_university_type,
                edit_region: edit_region,
                edit_province: edit_province,
                edit_city: edit_city,
                edit_barangay: edit_barangay,
                update: update
            },
            success: function(data) {
                console.log(data);
                if (data == 'success') {
                    alert('university updated successfully');
                    location.reload();
                } else {
                    alert('Failed to update university');
                }
            }
        })
    })
</script>

</html>