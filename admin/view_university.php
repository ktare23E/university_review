<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
$university_id = $_GET['university_id'];
include_once './modals/createUniversityCollegeModal.php';
include_once './modals/editUniversityCollegeModal.php';
include_once './modals/createUniversityImage.php';

if (isset($_GET['university_id'])) {
    $init = new UniversityControllers();

    // $init->checkNoSession('isAdmin');

    $views = new UniversityView();
    $university = $views->displayCertainUniversityView($university_id);
    $colleges = $views->displayCertainUniversityCollegesView($university_id);
    $images = $views->displayCertainUniversityImageView($university_id);


}else{
    include_once '404.php';
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

                    <button class="add_university py-1 px-1 bg-blue-600 text-white text-sm rounded-md" data-modal-target="add_university_college_modal" data-modal-toggle="add_university_college_modal">Add University College</button>
                </div>
                <div class="university_colleges mt-3 bg-white p-[2rem] rounded-md shadow-lg grid grid-cols-3 gap-4">
                    <?php if(!empty($colleges)):?>
                        
                    <?php foreach ($colleges as $college) :?>
                        <div class="flex flex-col items-center w-full relative bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="w-full h-56 md:h-64 lg:h-72 xl:h-80">
                                <!-- Ensure the image covers the full width and height of this div -->
                                <img class="w-full h-full object-cover object-center rounded-t-lg md:rounded-none md:rounded-t-lg" src="../imgs/<?= $college['logo']?>" alt="">
                            </div>
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $college['college_name']?></h5>
                                <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400"><?= $college['college_description']; ?></p>
                                <a href="university_college_courses.php?university_college_id=<?= $college['university_college_id'];?>&university_id=<?= $college['university_id']?>" class="bg-blue-700 w-fit text-white py-1 px-2 rounded-md text-sm text-end">View Courses</a>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="settings cursor-pointer w-6 h-6 absolute top-0 right-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                            <div class="edit_settings hidden py-2 px-4 absolute top-0 right-0 bg-gray-100 rounded-lg shadow-lg">
                                <button class="text-blue-600 hover:text-blue-800 font-medium" onclick='openEditModal(<?= $college["university_college_id"]?>,<?= $college["university_id"]?>,<?= $college["college_id"]?>,<?= json_encode($college["status"])?>,"edit_university_college_modal")'>Edit</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php else:?>
                        <h1 class="text-xl font-bold text-center w-full">No Colleges Yet.</h1>
                    <?php endif; ?>
                </div>
            </div>
            <div class="second mt-20">
                <h1 class="text-xl font-bold"><?= $university['university_name']; ?> Image</h1>
                <div class="w-full flex justify-end">
                    <button class="add_university py-1 px-1 bg-blue-600 text-white text-sm rounded-md" data-modal-target="add_university_image_modal" data-modal-toggle="add_university_image_modal">Add University Image</button>
                </div>
                <div class="university_colleges mt-3 bg-white p-[2rem] rounded-md shadow-lg grid grid-cols-3 gap-4">
                    <?php if(!empty($images)):?>
                        
                    <?php foreach ($images as $image) :?>
                        <div class="flex flex-col items-center w-full relative bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="w-full h-56 md:h-64 lg:h-72 xl:h-80">
                                <!-- Ensure the image covers the full width and height of this div -->
                                <img class="w-full h-full object-cover object-center rounded-t-lg md:rounded-none md:rounded-t-lg" src="../imgs/<?= $image['university_image']?>" alt="">
                            </div>
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <a href="university_college_courses.php?university_college_id=<?= $college['university_college_id'];?>&university_id=<?= $college['university_id']?>" class="bg-blue-700 w-fit text-white py-1 px-2 rounded-md text-sm text-end">View Courses</a>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="settings cursor-pointer w-6 h-6 absolute top-0 right-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                            <div class="edit_settings hidden py-2 px-4 absolute top-0 right-0 bg-gray-100 rounded-lg shadow-lg">
                                <button class="text-blue-600 hover:text-blue-800 font-medium" onclick='openEditModal(<?= $college["university_college_id"]?>,<?= $college["university_id"]?>,<?= $college["college_id"]?>,<?= json_encode($college["status"])?>,"edit_university_college_modal")'>Edit</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php else:?>
                        <h1 class="text-xl font-bold text-center">No Image Yet.</h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="../assets/index.js"></script>



<script>
    let table = new DataTable('#myTable');
    closeModal('add_university_college_modal');
    closeModal('edit_university_college_modal');

    $('.back_button').click(function() {
        window.location.href = 'university.php';
    })

    $('.settings').click(function() {
        $(this).siblings('.edit_settings').toggleClass('hidden');
    })

    //if click outside the edit settings display none
    $(document).click(function(e) {
        if (!$(e.target).closest('.settings').length) {
            $('.edit_settings').addClass('hidden');
        }
    })

    function openEditModal(university_college_id,university_id, college_id,status,modal) {
        $('#edit_university_college_id').val(university_college_id);
        $('#edit_university_id').val(university_id);
        $('#edit_college_id').val(college_id);
        $('#edit_status').val(status);
        
        $('#'+ modal).toggleClass('hidden');
    }

    $('.add_university_image_btn').click(function(){
        let files = $('#file_input')[0].files;
        let university_id = <?= $university_id; ?>

        if(files.length > 0){
            let formData = new FormData();
            for(let i = 0; i < files.length; i++){
                formData.append('images[]', files[i]);
            }

            formData.append('university_id', university_id);
            $.ajax({
                url: '../includes/createUniversityImage.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    if(data == 'success'){
                        alert('Image uploaded successfully');
                        location.reload();
                    }else{
                        alert('Failed to upload image');
                    }
                }
            })
        }else{
            alert('Please select an image');
        }
    });


    $('.add_university_college_btn').click(function() {
        let formData = new FormData();
        let fileInput = $('#image')[0].files[0];
        formData.append('image', fileInput);
        formData.append('university_id', $('#university_id').val());
        formData.append('college_id', $('#college_id').val());
        formData.append('status', $('#status').val());
     

        $.ajax({
            url: '../includes/createUniversityCollege.php',
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

    $('.update_university_college_btn').click(function() {
        let edit_university_college_id = $('#edit_university_college_id').val();
        let edit_university_id = $('#edit_university_id').val();
        let edit_college_id = $('#edit_college_id').val();
        let edit_status = $('#edit_status').val();
        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateUniversityCollege.php',
            type: 'POST',
            data: {
                edit_university_college_id : edit_university_college_id,
                edit_university_id : edit_university_id,
                edit_college_id : edit_college_id,
                edit_status : edit_status,
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