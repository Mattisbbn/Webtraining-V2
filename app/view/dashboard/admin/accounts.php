<?php
use App\Models\Users;
$userModel = new Users;
$users = $userModel->fetchUsers();

use App\Models\Classes;
$classesModel = new Classes;
$classes = $classesModel->fetchClasses();

use App\Models\Roles;
$rolesModel = new Roles;
$roles = $rolesModel->fetchRoles();
?>
   
<div class="mb-2">
        <button class="p-2 selected text-white border-0 rounded-3" data-bs-toggle="modal" data-bs-target="#makeAccountForm">Créer un compte</button>
        <button id="saveAccountsChanges" class="p-2 selected text-white border-0 rounded-3 d-none">Sauvegarder les changements</button>
</div>

<div class="d-flex overflow-x-auto">
    <table>
        <thead>
            <th class="p-2 editable">Nom</th>
            <th class="p-2">Email</th>
            <th class="p-2">Classe</th>
            <th class="p-2">Role</th>
            <th class="p-2">Action</th>
        </thead>

        <tbody>

            <?php foreach($users as $user): ?>

            <tr user_id="<?php echo $user["id"]?>">
                <td  class="p-2 fw-medium editable " name="username"><?php echo $user["username"] ?></td>
                <td class="p-2 editable" name="email"><?php echo $user["email"] ?></td>
                <td class="p-2"> 
                    <select name="class" class=" border-0 focus-ring rounded-2 w-100 classSelect" user_id="<?php echo $user["id"] ?>">
                        <?php foreach($classes as $class):

                                if($class["id"] === $user["class_id"]) {
                                    echo "<option disabled selected value='{$class['id']}'>{$class['name']}</option>";
                                }elseif($user["class_id"] === null){
                                    echo "<option disabled selected></option>";
                                }else{
                                    echo "<option value='{$class['id']}'>{$class['name']}</option>";
                                }

                            ?>
                     
                         
                         <?php endforeach  ?>
                       
                    </select>
                </td>

               
                <td class="p-2">
                    <select name="role" class="border-0 focus-ring rounded-2 w-100 rolesSelect" user_id="<?php echo $user["id"]?>">
                    <?php foreach($roles as $role): 
                        if($user['role_id'] === $role["id"]){
                            echo "<option selected disabled value='{$role['id']}'>{$role['name']}</option>";
                        }else{
                            echo "<option value='{$role['id']}'>{$role['name']}</option>";
                        }
                       

                     endforeach; ?>
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
                    <select name="class_id" class="border-0 p-1 rounded-3" id="class-input">
                        <?php foreach($classes as $class):?>
                            <option value="<?php echo $class["id"]?>"><?php echo $class["name"]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="p-1">
                    <label for="role-input"> <i class="fa-solid fa-user-tag"></i></label>
                    <select name="role_id" class="border-0 p-1 rounded-3" id="role-input">
                        <?php foreach($roles as $role):?>
                            <option value="<?php echo $role["id"]?>"><?php echo $role["name"]?></option>
                        <?php endforeach;?>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="p-2 border-0 rounded-3" data-bs-dismiss="modal"> Fermer</button>
                <button type="submit" class="p-2 selected text-white border-0 rounded-3">Sauvegarder</button>
            </div>
        </div>
    </div>
</form>