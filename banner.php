<div class="header flex justify-between items-center mb-3"> <!-- Adding bottom margin for spacing -->
    <div class="logo_container flex items-center gap-4"> <!-- Adjusted gap -->
        <img src="imgs/logo.jpg" alt="" class="rounded-full w-10 h-10"> <!-- Removed object-cover and mt-5 for logo -->
        <h1 class="font-bold text-xl">RateMeSchool</h1> <!-- Adjusted font size -->
    </div>
    <div class="py-6">
        <?php if(isset($_SESSION['isStudent'])):?>
            <a href="logout.php" class="text-sm text-red-500">Logout</a>
        <?php else:?>
            <a href="login.php" class="-mx-3 bg-black text-white block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 hover:bg-white-50">Log in</a>
        <?php endif;?>
    </div>
</div>