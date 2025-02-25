<?php use App\Router\AdminSubRouter; ?>

<link rel="stylesheet" href="css/aside.css">
<main class="min-vh-100 d-flex">
    <aside class="h-100  p-4 p-2 pt-5 container-bg position-sticky shadow-sm min-vh-100  ">
        <ul class="list-unstyled d-flex mt-4 flex-column">
        <a href="">
    <li class="p-3 ps-4 pe-5 rounded-5 selected text-white">
        <h6><i class="fa-solid fa-gauge me-2"></i> Dashboard</h6>
    </li>
</a>
<a href="#accounts">
    <li class="p-3 mt-1 ps-4 pe-5 rounded-5">
        <h6><i class="fa-solid fa-user-group me-2"></i> Comptes</h6>
    </li>
</a>
<a href="#classes">
    <li class="p-3 mt-1 ps-4 pe-5 rounded-5">
        <h6><i class="fa-solid fa-graduation-cap me-2"></i> Classes</h6>
    </li>
</a>
<a href="#subjects">
    <li class="p-3 mt-1 ps-4 pe-5 rounded-5">
        <h6><i class="fa-solid fa-book me-2"></i> Matières</h6>
    </li>
</a>
<a href="#lessons">
    <li class="p-3 mt-1 ps-4 pe-5 rounded-5">
        <h6><i class="fa-solid fa-chalkboard-user me-2"></i> Cours</h6>
    </li>
</a>
<a href="#signatures">
    <li class="p-3 mt-1 ps-4 pe-5 rounded-5">
        <h6><i class="fa-solid fa-signature me-2"></i> Signatures</h6>
    </li>
</a>

        </ul>
    </aside>
    <div class="d-flex flex-column flex-grow-1  overflow-x-auto" id="dashboard-content">
        <?php require_once(__DIR__ ."/partials/header.html") ?>
        <section class="container-bg m-4 p-4 rounded-2" id="pagesContainer">
           
        </section>


 
    

        <?php 
       
        ?>

    </div>
    <input type="hidden" id="CSRF" name="CSRF" value="<?php echo $_SESSION["CSRF"] ?>">

</main>
<script defer src="js/Admin/adminPages.js"></script>