<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
include_once 'modals/editStudentModal.php';

$init = new UniversityControllers();

// $init->checkNoSession('isAdmin');

$views = new UniversityView();
$students = $views->studentDataForAdmin();
?>

<body>
    <div class="main_container w-screen h-screen bg-[#f6f6f6] grid grid-cols-[13%,84%] gap-5">
        <?php include_once 'sidebar.php'; ?>
        <div class="main_information w-full mt-5">
            <h1 class="text-xl font-bold">Student</h1>
            
            <div class="table_container mt-3 bg-white p-[2rem] rounded-md shadow-lg">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Student Firstname</th>
                            <th>Student Lastname</th>
                            <th>Student Email</th>
                            <th>Student University</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student) :?>  
                            <tr>
                                <td><?= $student['student_firstname']; ?></td>
                                <td><?= $student['student_lastname']; ?></td>
                                <td><?= $student['student_email']; ?></td>
                                <td><?= $student['university_name']; ?></td>
                                <td>
                                    <button class="edit px-2 py-1 bg-black text-white rounded-md text-[12px]" onclick='editModal(<?= $student["student_id"]?>,<?= json_encode($student["student_firstname"]) ?>,<?= json_encode($student["student_lastname"]) ?>,<?= json_encode($student["student_email"])?>,<?= $student["university_id"]?>,"edit_student_modal")'>edit</button>
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
    closeModal('edit_student_modal');

    function editModal(student_id,student_firstname,student_lastname,student_email,university_id,modal){
        $('#edit_student_id').val(student_id);
        $('#edit_student_firstname').val(student_firstname);
        $('#edit_student_lastname').val(student_lastname);
        $('#edit_student_email').val(student_email);
        $('#edit_university_id').val(university_id);

        $('#' + modal).toggleClass('hidden');
    }

    $('.update_student_btn').click(function(){
        let student_id = $('#edit_student_id').val();
        let student_firstname = $('#edit_student_firstname').val();
        let student_lastname = $('#edit_student_lastname').val();
        let student_email = $('#edit_student_email').val();
        let university_id = $('#edit_university_id').val();
        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateStudent.php',
            type: 'POST',
            data : {
                student_id: student_id,
                student_firstname: student_firstname,
                student_lastname: student_lastname,
                student_email : student_email,
                university_id: university_id,
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