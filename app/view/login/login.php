<link rel="stylesheet" href="css/login.css">
<section class="h-100 d-flex vh-100">
    <form method="post" class="rounded-4 pb-4 pt-0 m-auto bg-white shadow-sm col-10 col-xl-4 col-lg-5" id="loginForm">
        <h1 class="fw-semibold display-4 p-3 rounded-top-4 text-center">Connection</h1>
        <input type="hidden" value="<?php echo($_SESSION["CSRF"]) ?>" name="CSRF">
        <div class="p-3">
            <div class="d-flex">
                <label class="w-50 text-center p-3 rounded-3 unselected-bg me-1 inputLabels" for="teacherInput">Animateur</label>
                <input type="radio" hidden name="userType" value="teacher" class="userTypeInput" id="teacherInput">
                <label class="w-50 text-center p-3 rounded-3 unselected-bg ms-1 inputLabels" for="studentInput">Étudiant</label>
                <input type="radio" hidden name="userType" value="student" class="userTypeInput" id="studentInput">
            </div>

            <div>
                <input class="p-14 mt-4 rounded-3 border-0 unselected-bg w-100" placeholder="Email" type="email" name="email" id="email" autocomplete="email">
            </div>

            <div>
                <input class=" mt-2 p-14 rounded-3 border-0 unselected-bg w-100" placeholder="Mot de passe" type="password" name="password" id="password" autocomplete="current-password">
            </div>

            <button class=" mt-4 bg-black text-white w-100 rounded-3 border-0 p-3" type="submit">Se connecter</button>
        </div>
    </form>
</section>
<div id="errorContainer" class="position-absolute shadow error-hide top-0 start-50 translate-middle mt-5 p-2 bg-white rounded-4 d-flex justify-content-center align-items-center"><img src="/img/icons/exclamation-triangle.svg" class="ps-1" alt=""><p id="errorMessage" class="ms-2 m-0 pe-2"></p></div>





<!-- <script src="js/login.js"></script> -->

