<?php
include_once 'header.php';
include_once '../includes/autoloader.php';
include_once 'modals/createUniversityModal.php';
include_once 'modals/editUniversityModal.php';

$init = new UniversityControllers();

// $init->checkNoSession('isAdmin');

$views = new UniversityView();
$universities = $views->retrieveUniversityView();
?>

<body>
    <div class="main_container w-screen h-screen bg-[#f6f6f6] grid grid-cols-[13%,84%] gap-5">
        <?php include_once 'sidebar.php'; ?>
        <div class="main_information w-full mt-5">
            <h1 class="text-xl font-bold">Universities</h1>
            <div class="w-full flex justify-end">
                <button class="add_university py-1 px-1 bg-blue-600 text-white text-sm" data-modal-target="add_university_modal" data-modal-toggle="add_university_modal">Add University</button>
            </div>
            <div class="table_container mt-3 bg-white p-[2rem] rounded-md shadow-lg">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>University Name </th>
                            <th>University Description</th>
                            <th>University Address</th>
                            <th>University Email</th>
                            <th>University Status</th>
                            <th>University Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($universities as $university) :?>  
                            <tr>
                                <td><?= $university['university_name']; ?></td>
                                <td><?= $university['university_description']; ?></td>
                                <td><?= $university['university_address']; ?></td>
                                <td><?= $university['university_email']; ?></td>
                                <td><?= $university['university_status']; ?></td>
                                <td><?= $university['university_type']; ?></td>
                                <td>
                                    <button class="edit px-2 py-1 bg-black text-white text-[12px] rounded-md" onclick='editModal(<?= $university["university_id"]?>,<?= json_encode($university["university_name"]) ?>,<?= json_encode($university["university_description"]) ?>,<?= json_encode($university["university_status"]) ?>,<?= json_encode($university["region"]); ?>,<?= json_encode($university["province"])?>,<?= json_encode($university["city"]) ?>,<?= json_encode($university["barangay"])?>,<?= json_encode($university["university_email"])?>,<?= json_encode($university["university_type"])?>,"edit_university_modal")'>edit</button>
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

    function editModal(university_id,university_name,university_description,university_status,region,province,city,barangay,university_email,university_type,modal){
        $('#edit_university_id').val(university_id);
        $('#edit_university_name').val(university_name);
        $('#edit_university_description').val(university_description);

        $('#edit_university_status').val(university_status);
        $('#edit_region').append(`<option value="${region}" selected>${region}</option>`);
        $('#edit_region').val(region);
        // $('#edit_province').append(`<option value="${province}" selected>${province}</option>`);
        // $('#edit_province-text').val(province);
        // $('#edit_city').append(`<option value="${city}" selected>${city}</option>`);
        // $('#edit_city-text').val(city);
        // $('#edit_barangay').append(`<option value="${barangay}" selected>${barangay}</option>`);
        // $('#edit_barangay-text').val(barangay);

        $('#edit_university_email').val(university_email);
        $('#edit_university_type').val(university_type);

        console.log(region);

        $('#' + modal).toggleClass('hidden');
    }

    $('.add_university_btn').click(function(){
        let university_name = $('#university_name').val();
        let university_description = $('#university_description').val();
        let university_status = $('#university_status').val();
        let region = $('#region-text').val();
        let province = $('#province-text').val();
        let city = $('#city-text').val();
        let barangay = $('#barangay-text').val();
        let university_email = $('#university_email').val();
        let university_type = $('#university_type').val();

        let submit = $(this).attr('name');

        $.ajax({
            url: '../includes/createUniversity.php',
            type: 'POST',
            data: {
                university_name: university_name,
                university_status : university_status,
                university_description: university_description,
                region : region, 
                province : province,
                city : city,
                barangay : barangay,
                university_email : university_email,
                university_type : university_type,
                submit: submit
            },
            success: function(data){
                console.log(data);
                if(data == 'success'){
                    alert('university added successfully');
                    location.reload();
                }else{
                    alert('Failed to add university');
                }
            }
        })
    })

    $('.update_university_btn').click(function(){
        let edit_university_id =  $('#edit_university_id').val();
        let edit_university_name = $('#edit_university_name').val();
        let edit_university_description = $('#edit_university_description').val();
        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateuniversity.php',
            type: 'POST',
            data : {
                edit_university_id: edit_university_id,
                edit_university_name: edit_university_name,
                edit_university_description: edit_university_description,
                update: update
            },
            success: function(data){
                console.log(data);
                if(data == 'success'){
                    alert('university updated successfully');
                    location.reload();
                }else{
                    alert('Failed to update university');
                }
            }
        })
    })
</script>

</html>