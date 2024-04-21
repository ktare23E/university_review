<?php
    include_once '../includes/autoLoader.php';
    $views = new UniversityView();
    $university_id = $_GET['university_id'];
    $university = $views->displayCertainUniversityView($university_id);
    $colleges = $views->displayCollegeView();
?>
<!-- Main modal -->
<div id="edit_university_college_modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full bg-black bg-opacity-30 backdrop-blur-sm">
    <div class="flex justify-center items-center min-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-[24%]">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit University College
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit_university_college_modal">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="POST">
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <input type="hidden" id="edit_university_college_id">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">University</label>
                        <select id="edit_university_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a University</option>
                                <option value="<?= $university['university_id']; ?>"><?= $university['university_name']; ?></option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                        <select id="edit_college_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a College</option>
                            <?php foreach($colleges as $college): ?>
                                <option value="<?= $college['college_id']; ?>"><?= $college['college_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">University Status</label>
                        <select id="edit_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload University College Logo</label>
                        <input class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="image" type="file" name="image">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG,JPG,JPEG only</p>
                    </div>
                </div>
                <button class="update_university_college_btn bg-blue-800 p-2 rounded-md text-white" type="button" name="update">
                    update University College
                </button>
            </form>
        </div>
    </div>
</div>