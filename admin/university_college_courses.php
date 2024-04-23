<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
include_once './modals/createCollegeCourseModal.php';
include_once './modals/editCollegeCourseModal.php';

if(isset($_GET['university_college_id']) && isset($_GET['university_id'])){
    $university_college_id = $_GET['university_college_id'];
    $university_id = $_GET['university_id'];

    $init = new UniversityView();
    $data = $init->displayCertainCollegeDataView($university_college_id);
    $courses = $init->displayUniversityCollegeCourseView($university_college_id);

    //peso sign
    $peso = '&#8369;';
}else{
    include_once '../404.php';
}
?>

<body class="bg-[#f6f6f6]">
    <div class="main_container p-[2rem] w-full gap-5">
        <div class="main_information w-[85%] mx-auto mt-5">
            <h1 class="text-xl font-bold"><?= $data['university_name'].' '.$data['college_name'].' Course'?></h1>
            <div class="w-full flex justify-between mt-10">
                <button type="button" class="back_button flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                    <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg> <span>Go back</span>
                </button>

                <button class="add_university py-1 px-1 bg-blue-600 text-white text-sm" data-modal-target="add_college_course_modal" data-modal-toggle="add_college_course_modal">Add College Course</button>
            </div>
            <div class="table_container mt-3 bg-white p-[2rem] rounded-md shadow-lg">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>College Name</th>
                            <th>Course Name</th>
                            <th>Tuition</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course) : ?>
                            <tr>
                                <td><?= $course['college_name']; ?></td>
                                <td><?= $course['course_name']; ?></td>
                                <td><?= $peso.number_format($course['tuition_per_sem'],2,'.',',')?></td>
                                <td>
                                    <button class="edit_university px-2 py-1 bg-black text-white text-[12px] rounded-md" onclick='openEditModal(<?=$course["university_course_id"]?>,<?= $course["university_college_id"]?>,<?=$course["course_id"]?>,<?=json_encode($course["status"])?>,<?=$course["tuition_per_sem"]?>,"edit_college_course_modal")'>edit</button>
                                    <button class="edit px-2 py-1 bg-green-950 text-white text-[12px] rounded-md">
                                        <a href="view_college_course_rating.php?university_course_id=<?= $course['university_course_id']; ?>">rating</a>
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
    closeModal('add_college_course_modal');
    closeModal('edit_college_course_modal');
    
    $('.back_button').click(function(){
        window.location.href = 'view_university.php?university_id=<?= $university_id;?>';
    })

    $('.add_college_course_btn').click(function() {
        let university_college_id = $('#university_college_id').val();
        let course_id = $('#course_id').val();
        let status = $('#status').val();
        let tuition_per_sem = $('#tuition_per_sem').val();
        let submit = $(this).attr('name');


        $.ajax({
            url: '../includes/createCollegeCourses.php',
            type: 'POST',
            data: {
                university_college_id: university_college_id,
                course_id: course_id,
                status: status,
                tuition_per_sem: tuition_per_sem,
                submit: submit
            },
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

    function openEditModal(university_course_id,university_college_id,course_id,status,tuition_per_sem,modal) {
        $('#edit_university_course_id').val(university_course_id);
        $('#edit_university_college_id').val(university_college_id);
        $('#edit_course_id').val(course_id);
        $('#edit_status').val(status);
        $('#edit_tuition_per_sem').val(tuition_per_sem);
        
        $('#'+ modal).toggleClass('hidden');
    }


    $('.update_college_course_btn').click(function() {
        let edit_university_course_id = $('#edit_university_course_id').val();
        let edit_university_college_id = $('#edit_university_college_id').val();
        let edit_course_id = $('#edit_course_id').val();
        let edit_status = $('#edit_status').val();
        let edit_tuition_per_sem = $('#edit_tuition_per_sem').val();

        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateCollegeCourse.php',
            type: 'POST',
            data: {
                edit_university_course_id : edit_university_course_id,
                edit_university_college_id : edit_university_college_id,
                edit_course_id : edit_course_id,
                edit_status : edit_status,
                edit_tuition_per_sem : edit_tuition_per_sem,
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