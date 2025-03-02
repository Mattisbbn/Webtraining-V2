<header class="d-flex p-2 container-bg shadow-sm">
    <div class="w-100"></div>
    <div></div>
    <div class="d-flex align-items-center">
        <div>
            <h6 class="text-end"><?php echo $_SESSION["username"] ?></h6>
            <p class="text-end  fw-light"><?php echo $_SESSION["role_name"] ?></p>
        </div>
        <i class="ms-2 fa-solid fs-5 fa-right-from-bracket ps-2 pe-2" id="logoutButton"></i>
    </div>
</header>
<script src="js/logout.js"></script>