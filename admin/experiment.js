export const myfunct = function editModal(university_id,university_name,university_description,university_status,region,province,city,barangay,university_email,university_type,modal){
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
export function hello(){
    console.log('hello');
}