<?php
    include_once '../includes/autoLoader.php';
    $views = new UniversityView();
    $university_college_id = $_GET['university_college_id'];
    
    $university_college = $views->displaySingleUniversityCollegeView($university_college_id);
    $courses = $views->courseData();
?>
<!-- Main modal -->
<div id="edit_college_course_modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full bg-black bg-opacity-30 backdrop-blur-sm">
    <div class="flex justify-center items-center min-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-[24%]">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit College Course
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit_college_course_modal">
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
                        <input type="hidden" id="edit_university_course_id">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">University College</label>
                        <select id="edit_university_college_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a University</option>
                                <option value="<?= $university_college['university_college_id']; ?>"><?= $university_college['university_name'].' '.$university_college['college_name']; ?></option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                        <select id="edit_course_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a College</option>
                            <?php foreach($courses as $course): ?>
                                <option value="<?= $course['course_id']; ?>"><?= $course['course_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Course Status</label>
                        <select id="edit_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Course Tuition</label>
                        <input type="number" id="edit_tuition_per_sem" name="tuition_per_sem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type University name" required="">
                    </div>
                </div>
                <button class="update_college_course_btn bg-blue-800 p-2 rounded-md text-white" type="button" name="update">
                    Update College Course
                </button>
            </form>
        </div>
    </div>
</div>