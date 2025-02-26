<?php
use App\Models\Users;
$userModel = new Users;
$users = $userModel->fetchUsers();

use App\Models\Classes;
$classesModel = new Classes;
$classes = $classesModel->fetchClasses();
?>



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
            <th class="p-2">Action</th>
        </thead>

        <tbody>

            <?php foreach($users as $user): ?>

            <tr>
                <td class="p-2"><h6><?php echo $user["username"] ?></h6></td>
                <td class="p-2"><?php echo $user["email"] ?></td>
                <td class="p-2"> 
                    <select name="class" class=" border-0 focus-ring rounded-2 w-100">
                        <?php foreach($classes as $class):?>
                            <?php 
                                if($class["id"] === $user["class_id"]) {
                                    echo "<option disabled selected value'{$class['id']}'>{$class['name']}</option>";
                                }elseif($user["class_id"] === null){
                                    echo "<option disabled selected></option>";
                                }else{
                                    echo "<option value'{$class['id']}'>{$class['name']}</option>";
                                }

                            ?>
                     
                         
                         <?php endforeach  ?>
                       
                        
                        <option value="classId">BTS SIO SISR</option>
                    </select>
                </td>
                <td class="p-2">
                    <select name="role" class="border-0 focus-ring rounded-2">
                        <option selected value="admin">Admin</option>
                        <option value="teacher">Animateur</option>
                        <option value="admin">Étudiant</option>
                    </select>
                </td>

                <td class="p-2 text-center"><i user_id="<?php echo $user["id"] ?>" class="fa-solid fa-trash-can pointer deleteUserButton"></i></td>
            </tr>


            <?php endforeach; ?>
        </tbody>
    </table>
   </div>
    


<form class="modal fade" id="makeAccountForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId">
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
            <div class="modal-body accounts-modal-body position-relative">
     
                <div class="p-1"><label for="username-input"><i class="fa-solid fa-user me-2"></i></label><input id="username-input" autocomplete="username" class="border-0 p-1 rounded-3" name="username" placeholder="Nom" type="text"></div>  
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
                <button type="button" class="p-2 border-0 rounded-3" data-bs-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="p-2 selected text-white border-0 rounded-3">Sauvegarder</button>
            </div>
        </div>
    </div>
</form>
