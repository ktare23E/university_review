<?php 

include_once 'includes/autoloader.php';
if(isset($_GET['errors'])){
    $errors = json_decode(urldecode($_GET['errors']));
    foreach($errors as $error){
        echo "<script>alert('".$error."')</script>";
    }
}

if(isset($_GET['success'])){
    echo "<script>alert('Successful Registration!')</script>";
}

$init = new UniversityView();
$universities = $init->universityData();

if(isset($_POST['submit'])){
    $student_firstname = $_POST['student_fistname'];
    $student_lastname = $_POST['student_lastname'];
    $student_email = $_POST['student_email'];
    $student_password = $_POST['student_password'];
    $university_id = $_POST['university_id'];

    $controllers = new UniversityControllers();
    $controllers->insertStudent($student_firstname,$student_lastname,$student_email,$student_password,$university_id);
    
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <section class="bg-green-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold text-center leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#" method="POST">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                <input type="text" name="student_fistname" id="student_fistname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="First Name" required="">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                <input type="text" name="student_lastname" id="student_lastname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Last Name" required="">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                                <input type="email" name="student_email" id="student_email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@nmsc.edu.ph" required="">
                                <p class="result text-[10px]"></p>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="student_password" id="student_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                        </div>
                        <div>
                            <label for="university_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your University/College</label>
                            <select id="university_id" name="university_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose your University/College</option>
                                <?php foreach($universities as $university):?>
                                    <option value="<?php echo $university['university_id']?>"><?php echo $university['university_name']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="w-full bg-blue-600 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    //check student email if it is institutional email
    $('#student_email').on('input',function(){
        var student_email = $(this).val();
        $.ajax({
            url: 'includes/checkStudentEmail.php',
            type: 'POST',
            data: {student_email:student_email},
            success: function(response){
                if(response === 'error'){
                    $('.result').html('Invalid Email').addClass('text-red-500').removeClass('text-green-500');
                }else{
                    $('.result').removeClass('text-red-500').html('Valid Email').addClass('text-green-500');
                }

                if(student_email === ''){
                    $('.result').html('');
                }
            }
        });
    });
</script>
</html>