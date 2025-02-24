<?php
use App\Models\Users;
$userModel = new Users;
$users = $userModel->fetchUsers();
?>


<section class="container-bg m-4 p-4 rounded-2 " >
    <div class="mb-2">
        <button class="p-2 selected text-white border-0 rounded-3" data-bs-toggle="modal" data-bs-target="#makeAccountForm">Créer un compte</button>
    </div>
   <div class=" d-flex  overflow-x-auto">
    <table >
        <thead>
            <th class="p-2">Nom</th>
            <th class="p-2">Email</th>
            <th class="p-2">Classe</th>
            <th class="p-2">Role</th>
           
            <th class="p-2">Mis à jour le</th>
            <th class="p-2">Crée le</th>
        </thead>

        <tbody>

            <?php foreach($users as $user): ?>

            <tr>
                <td class="p-2"><h6><?php echo $user["username"] ?></h6></td>
                <td class="p-2"><?php echo $user["email"] ?></td>
                <td class="p-2">
                    <select name="class" id="class" class=" border-0 focus-ring rounded-2">
                        <option selected value="classId">BTS SIO SLAM</option>
                        <option value="classId">BTS SIO SISR</option>
                    </select>
                </td>
                <td class="p-2">
                    <select name="role" id="role" class="border-0 focus-ring rounded-2">
                        <option selected value="admin">Admin</option>
                        <option value="teacher">Animateur</option>
                        <option value="admin">Étudiant</option>
                    </select>
                </td>
                <td class="p-2 ">
                    <?php
                    $date = new DateTime($user["updated_at"]);
                    echo $date->format('d/m/y H:i:s');
                    ?>
                </td>
                <td class="p-2">
                    <?php
                    $date = new DateTime($user["created_at"]);
                    echo $date->format('d/m/y H:i:s');
                    ?>
                </td>
            </tr>


            <?php endforeach; ?>
        </tbody>
    </table>
   </div>
    
</section>

<form class="modal fade" id="makeAccountForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId"aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Créer un compte
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
     
            <div class="p-1"><label for="username-input"><i class="fa-solid fa-user me-2"></i></label><input id="username-input" class="border-0 p-1 rounded-3" name="username" placeholder="Nom" type="text"></div>  
            <div class="p-1"><label for="email-input"><i class="fa-solid fa-envelope me-2"></i></label><input class="border-0 p-1 rounded-3" autocomplete="email" placeholder="Adresse mail" name="email" id="email-input" type="text"></div>  
            <div class="p-1"><label for="password-input"><i class="fa-solid fa-key me-2"></i></label><input class="border-0 p-1 rounded-3" autocomplete="new-password" name="password" id="password-input" placeholder="Mot de passe" type="password"></div>  
            <div class="p-1">
                <label for="class-input"><i class="fa-solid fa-graduation-cap"></i></label>
                <select name="class-input" class="border-0 p-1 rounded-3" id="class-input">
                    <option disabled selected value="1">BTS SIO SLAM</option>
                    <option value="2">BTS SIO SLAM</option>
                </select>
            </div>
            <div class="p-1">
                <label for="role-input"> <i class="fa-solid fa-user-tag"></i></label>
                <select name="role" class="border-0 p-1 rounded-3" id="role-input">
                    <option disabled selected value="">Admin</option>
                </select>
            </div>

            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</form>

<script defer src="js/Admin/accounts.js"></script>