<link rel="stylesheet" href="css/aside.css">
<main class="min-vh-100 d-flex">
    <aside class="h-100  p-4 p-2 pt-5 container-bg position-sticky shadow-sm min-vh-100  ">
        <ul class="list-unstyled d-flex mt-4 flex-column">
            <li class="p-3 ps-4 pe-5 rounded-5 selected text-white"><a href=""><h6><i class="fa-solid fa-gauge me-2"></i> Dashboard</h6></a></li>
            <li class="p-3 mt-1 ps-4 pe-5 rounded-5"><a href=""><h6><i class="fa-solid fa-user-group me-2"></i> Comptes</h6></a></li>
            <li class="p-3 mt-1 ps-4 pe-5 rounded-5"><a href=""><h6><i class="fa-solid fa-graduation-cap me-2"></i> Classes</h6></a></li>
            <li class="p-3 mt-1 ps-4 pe-5 rounded-5"><a href=""><h6><i class="fa-solid fa-book me-2"></i> Matières</h6></a></li>
            <li class="p-3 mt-1 ps-4 pe-5 rounded-5"><a href=""><h6><i class="fa-solid fa-chalkboard-user me-2"></i> Cours</h6></a></li>
            <li class="p-3 mt-1 ps-4 pe-5 rounded-5"><a href=""><h6><i class="fa-solid fa-signature me-2"></i> Signatures</h6></a></li>
        </ul>
    </aside>
    <div class="d-flex flex-column flex-grow-1  overflow-x-auto" id="dashboard-content">
        <?php require_once(__DIR__ ."/partials/header.html") ?>
        <?php require_once(__DIR__ ."/admin/accounts.php") ?>
    </div>
    <input type="hidden" id="CSRF" name="CSRF" value="<?php echo $_SESSION["CSRF"] ?>">
    <script defer src="https://kit.fontawesome.com/72bcbb7dd8.js" crossorigin="anonymous"></script>
</main>