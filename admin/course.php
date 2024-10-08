<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
include_once 'modals/createCourseModal.php';
include_once 'modals/editCourseModal.php';

$init = new UniversityControllers();

// $init->checkNoSession('isAdmin');

$views = new UniversityView();
$courses = $views->courseData();
?>

<body>
    <div class="main_container w-screen h-screen bg-[#f6f6f6] grid grid-cols-[13%,84%] gap-5">
        <?php include_once 'sidebar.php'; ?>
        <div class="main_information w-full mt-5">
            <h1 class="text-xl font-bold">Course</h1>
            <div class="w-full flex justify-end">
                <button class="add_course py-1 px-1 bg-blue-600 text-white text-sm" data-modal-target="add_course" data-modal-toggle="add_course">Add Course</button>
            </div>
            <div class="table_container mt-3 bg-white p-[2rem] rounded-md shadow-lg">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Course Name </th>
                            <th>Course Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($courses as $course) :?>  
                            <tr>
                                <td><?= $course['course_name']; ?></td>
                                <td><?= $course['course_description']; ?></td>
                                <td>
                                    <button class="edit px-2 py-1 bg-black text-white rounded-md text-[12px]" onclick='editModal(<?= $course["course_id"]?>,<?= json_encode($course["course_name"]) ?>,<?= json_encode($course["course_description"]) ?>,"edit_course_modal")'>Edit</button>
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
    closeModal('add_course');
    closeModal('edit_course_modal');

    function editModal(course_id,course_name,course_description,modal){
        $('#edit_course_id').val(course_id);
        $('#edit_course_name').val(course_name);
        $('#edit_course_description').val(course_description);

        $('#' + modal).toggleClass('hidden');
    }

    $('.add_course_btn').click(function(){
        let course_name = $('#course_name').val();
        let course_description = $('#course_description').val();
        let submit = $(this).attr('name');

        $.ajax({
            url: '../includes/createCourse.php',
            type: 'POST',
            data: {
                course_name: course_name,
                course_description: course_description,
                submit: submit
            },
            success: function(data){
                console.log(data);
                if(data == 'success'){
                    alert('Course added successfully');
                    location.reload();
                }else{
                    alert('Failed to add course');
                }
            }
        })
    })

    $('.update_course_btn').click(function(){
        let edit_course_id =  $('#edit_course_id').val();
        let edit_course_name = $('#edit_course_name').val();
        let edit_course_description = $('#edit_course_description').val();
        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateCourse.php',
            type: 'POST',
            data : {
                edit_course_id: edit_course_id,
                edit_course_name: edit_course_name,
                edit_course_description: edit_course_description,
                update: update
            },
            success: function(data){
                console.log(data);
                if(data == 'success'){
                    alert('Course updated successfully');
                    location.reload();
                }else{
                    alert('Failed to update course');
                }
            }
        })
    })
</script>

</html>