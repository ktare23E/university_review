<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
include_once 'modals/createCollegeModal.php';
include_once 'modals/editCollegeModal.php';

$init = new UniversityControllers();

// $init->checkNoSession('isAdmin');

$views = new UniversityView();
$colleges = $views->displayCollegeView();
?>

<body>
    <div class="main_container w-screen h-screen bg-[#f6f6f6] grid grid-cols-[13%,84%] gap-5">
        <?php include_once 'sidebar.php'; ?>
        <div class="main_information w-full mt-5">
            <h1 class="text-xl font-bold">Colleges</h1>
            <div class="w-full flex justify-end">
                <button class="add_college py-1 px-1 bg-blue-600 text-white text-sm" data-modal-target="add_college_modal" data-modal-toggle="add_college_modal">Add College</button>
            </div>
            <div class="table_container mt-3 bg-white p-[2rem] rounded-md shadow-lg">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>College Name </th>
                            <th>College Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($colleges as $college) :?>  
                            <tr>
                                <td><?= $college['college_name']; ?></td>
                                <td><?= $college['college_description']; ?></td>
                                <td>
                                    <button class="edit px-2 py-1 bg-black text-white text-[12px] rounded-md" onclick='editModal(<?= $college["college_id"]?>,<?= json_encode($college["college_name"]) ?>,<?= json_encode($college["college_description"]) ?>,"edit_college_modal")'>Edit</button>
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
    closeModal('add_college_modal');
    closeModal('edit_college_modal');

    function editModal(college_id,college_name,college_description,modal){
        $('#edit_college_id').val(college_id);
        $('#edit_college_name').val(college_name);
        $('#edit_college_description').val(college_description);

        $('#' + modal).toggleClass('hidden');
    }

    $('.add_college_btn').click(function(){
        let college_name = $('#college_name').val();
        let college_description = $('#college_description').val();
        let submit = $(this).attr('name');

        $.ajax({
            url: '../includes/createCollege.php',
            type: 'POST',
            data: {
                college_name: college_name,
                college_description: college_description,
                submit: submit
            },
            success: function(data){
                console.log(data);
                if(data == 'success'){
                    alert('college added successfully');
                    location.reload();
                }else{
                    alert('Failed to add college');
                }
            }
        })
    })

    $('.update_college_btn').click(function(){
        let edit_college_id =  $('#edit_college_id').val();
        let edit_college_name = $('#edit_college_name').val();
        let edit_college_description = $('#edit_college_description').val();
        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateCollege.php',
            type: 'POST',
            data : {
                edit_college_id: edit_college_id,
                edit_college_name: edit_college_name,
                edit_college_description: edit_college_description,
                update: update
            },
            success: function(data){
                console.log(data);
                if(data == 'success'){
                    alert('college updated successfully');
                    location.reload();
                }else{
                    alert('Failed to update college');
                }
            }
        })
    })
</script>

</html>