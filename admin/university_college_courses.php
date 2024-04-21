<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
if(isset($_GET['university_college_id']) && isset($_GET['university_id'])){
    $university_college_id = $_GET['university_college_id'];
    $university_id = $_GET['university_id'];
    $init = new UniversityView();
    $courses = $init->displayUniversityCollegeCourseView($university_college_id);
}else{
    include_once '../404.php';
}
?>

<body>
    <div class="main_container p-[2rem] w-full gap-5">
        <div class="main_information w-[85%] mx-auto mt-5">
            <h1 class="text-xl font-bold">Universities</h1>
            <div class="w-full flex justify-between">
                <button type="button" class="back_button flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                    <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg> <span>Go back</span>
                </button>

                <button class="add_university py-1 px-1 bg-blue-600 text-white text-sm" data-modal-target="add_university_college_modal" data-modal-toggle="add_university_college_modal">Add College Course</button>
            </div>
            <div class="table_container mt-3 bg-white p-[2rem] rounded-md shadow-lg">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>College Name</th>
                            <th>Course Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($universities as $university) : ?>
                            <tr>
                                <td><?= $university['university_name']; ?></td>
                                <td><?= $university['university_description']; ?></td>
                                <td><?= $university['barangay'].','.$university['city']; ?></td>
                                <td><?= $university['university_email']; ?></td>
                                <td><?= $university['university_status']; ?></td>
                                <td><?= $university['university_type']; ?></td>
                                <td>
                                    <button class="edit_university px-2 py-1 bg-black text-white text-[12px] rounded-md" university_id="<?= $university['university_id'] ?>">edit</button>
                                    <button class="edit px-2 py-1 bg-green-950 text-white text-[12px] rounded-md">
                                        <a href="view_university.php?university_id=<?= $university['university_id']; ?>">view</a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="../assets/index.js"></script>



<script>
    let table = new DataTable('#myTable');
    closeModal('add_university_modal');
    closeModal('edit_university_modal');
    
    $('.back_button').click(function(){
        window.location.href = 'view_university.php?university_id=<?= $university_id;?>';
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