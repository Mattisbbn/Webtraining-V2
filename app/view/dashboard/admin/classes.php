<?php
use App\Models\Classes;
$classesModel = new Classes;
$classes = $classesModel->fetchClasses();
?>

    <div class="mb-2">
        <button class="p-2 selected text-white border-0 rounded-3" data-bs-toggle="modal" data-bs-target="#makeAccountForm">Créer une classe</button>
    </div>
   <div class=" d-flex  overflow-x-auto">
    <table >
        <thead>
            <th class="p-2">Nom</th>
            <th class="p-2">Action</th>
        </thead>

        <tbody>

            <?php foreach($classes as $class): ?>

            <tr>
                <td class="p-2"><h6><?php echo $class["name"] ?></h6></td>
                <td class="p-2 text-center"><i user_id="<?php echo $class["id"] ?>" class="fa-solid fa-trash-can pointer deleteClassButton"></i></td>
            </tr>


            <?php endforeach; ?>
        </tbody>
    </table>
   </div>
    


<form class="modal fade" id="makeAccountForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId"aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Créer une classe
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
     
            <div class="p-1"><label for="className-input"><i class="fa-solid fa-graduation-cap me-2"></i></label><input id="className-input" class="border-0 p-1 rounded-3" name="username" placeholder="Nom de la classe." type="text"></div>  


            
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
