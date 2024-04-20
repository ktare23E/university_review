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
                        <?php foreach ($universities as $university) : ?>
                            <tr>
                                <td><?= $university['university_name']; ?></td>
                                <td><?= $university['university_description']; ?></td>
                                <td><?= $university['university_address']; ?></td>
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

<script type="module">
    import {
        region
    } from './ph-json/region_copy.js';
    import {
        province
    } from './ph-json/province_copy.js';
    import {
        city
    } from './ph-json/city_copy.js';
    import {
        barangay
    } from './ph-json/barangay_copy.js';
    import {
        myfunct,
        hello
    } from './experiment.js';

    $('.edit_university').click(function() {
        let university_id = $(this).attr('university_id');
        let modal = 'edit_university_modal';

        $.ajax({
            url: '../includes/fetchCertainUniversity.php',
            type: 'POST',
            data: {
                university_id: university_id
            },
            success: function(data) {
                let university = JSON.parse(data);
                $('#edit_university_id').val(university.university_id);
                $('#edit_university_name').val(university.university_name);
                $('#edit_university_description').val(university.university_description);
                $('#edit_university_status').val(university.university_status);
                $('#edit_university_email').val(university.university_email);
                $('#edit_university_type').val(university.university_type);

                //append all region to select and select the region of the university
                region.forEach(r => {
                    $('#edit_region').append(`<option value="${r.region_name}" ${r.region_name == university.region ? 'selected' : ''}>${r.region_name}</option>`);
                });

                //append all province that corresponds to province code to select and select the province of the university, but first retrieve region code using region name
                const regionEntry = region.find(r => r.region_name === university.region);
                const regionCode = regionEntry ? regionEntry.region_code : null;
                const retrieveProvince = province.filter(p => p.region_code === regionCode);
                retrieveProvince.forEach(p => {
                    $('#edit_province').append(`<option value="${p.province_name}" ${p.province_name == university.province ? 'selected' : ''}>${p.province_name}</option>`);
                });

                //append all city that corresponds to province code to select and select the city of the university, but first retrieve province code using province name
                const provinceEntry = retrieveProvince.find(p => p.province_name === university.province);
                const provinceCertainCode = provinceEntry ? provinceEntry.province_code : null;
                const retrieveCity = city.filter(c => c.province_code === provinceCertainCode);
                retrieveCity.forEach(c => {
                    $('#edit_city').append(`<option value="${c.city_name}" ${c.city_name == university.city ? 'selected' : ''}>${c.city_name}</option>`);
                });


                //append all barangay that corresponds to city code to select and select the barangay of the university, but first retrieve city code using city name
                const cityEntry = retrieveCity.find(c => c.city_name === university.city);
                const cityCertainCode = cityEntry ? cityEntry.city_code : null;
                const retrieveBarangay = barangay.filter(b => b.city_code === cityCertainCode);
                retrieveBarangay.forEach(b => {
                    $('#edit_barangay').append(`<option value="${b.brgy_name}" ${b.brgy_name == university.barangay ? 'selected' : ''}>${b.brgy_name}</option>`);
                });


                $(document).ready(function() {
                    $('#edit_region').change(function() {
                        $('#edit_province').empty();
                        $('#edit_city').empty();
                        $('#edit_barangay').empty();
                        $('#edit_province').append(`<option selected>Choose a Province</option>`);
                        $('#edit_city').append(`<option selected>Choose a City</option>`);
                        $('#edit_barangay').append(`<option selected>Choose a Barangay</option>`);
                        const regionName = $(this).val();
                        const regionEntry = region.find(r => r.region_name === regionName);
                        const regionCode = regionEntry ? regionEntry.region_code : null;
                        const retrieveProvince = province.filter(p => p.region_code === regionCode);
                        retrieveProvince.forEach(p => {
                            $('#edit_province').append(`<option value="${p.province_name}">${p.province_name}</option>`);
                        });
                    });

                    $('#edit_province').change(function() {
                        $('#edit_city').empty();
                        $('#edit_barangay').empty();
                        $('#edit_city').append(`<option selected>Choose a City</option>`);
                        $('#edit_barangay').append(`<option selected>Choose a Barangay</option>`);
                        const provinceName = $(this).val();
                        const provinceEntry = province.find(p => p.province_name === provinceName);
                        const provinceCode = provinceEntry ? provinceEntry.province_code : null;
                        const retrieveCity = city.filter(c => c.province_code === provinceCode);
                        retrieveCity.forEach(c => {
                            $('#edit_city').append(`<option value="${c.city_name}">${c.city_name}</option>`);
                        });
                    });

                    $('#edit_city').change(function() {
                        $('#edit_barangay').empty();
                        $('#edit_barangay').append(`<option selected>Choose a Barangay</option>`);
                        const cityName = $(this).val();
                        const cityEntry = city.find(c => c.city_name === cityName);
                        const cityCode = cityEntry ? cityEntry.city_code : null;
                        const retrieveBarangay = barangay.filter(b => b.city_code === cityCode);
                        retrieveBarangay.forEach(b => {
                            $('#edit_barangay').append(`<option value="${b.brgy_name}">${b.brgy_name}</option>`);
                        });
                    });
                });

                //address
                // $('#edit_region').val(university.region);
                // $('#edit_province-text').val(university.province);
                // $('#edit_city-text').val(university.city);
                // $('#edit_barangay-text').val(university.barangay);
                $('#' + modal).toggleClass('hidden');
            }
        });



        // $('#edit_region').append(`<option value="${region}" selected>${region}</option>`);

        // $('#edit_province').append(`<option value="${province}" selected>${province}</option>`);

        // $('#edit_city').append(`<option value="${city}" selected>${city}</option>`);

        // $('#edit_barangay').append(`<option value="${barangay}" selected>${barangay}</option>`);
        // // $('#edit_barangay-text').val(barangay);


        // console.log(region);

    })
</script>

<script>
    let table = new DataTable('#myTable');
    closeModal('add_university_modal');
    closeModal('edit_university_modal');



    $('.add_university_btn').click(function() {
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
                university_status: university_status,
                university_description: university_description,
                region: region,
                province: province,
                city: city,
                barangay: barangay,
                university_email: university_email,
                university_type: university_type,
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

    $('.update_university_btn').click(function() {
        let edit_university_id = $('#edit_university_id').val();
        let edit_university_name = $('#edit_university_name').val();
        let edit_university_description = $('#edit_university_description').val();
        let update = $(this).attr('name');

        $.ajax({
            url: '../includes/updateuniversity.php',
            type: 'POST',
            data: {
                edit_university_id: edit_university_id,
                edit_university_name: edit_university_name,
                edit_university_description: edit_university_description,
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