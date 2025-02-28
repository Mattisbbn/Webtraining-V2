<?php
use App\Models\Subjects;
$subjectsModel = new Subjects;
$subjects = $subjectsModel->fetchAll();
?>

    <div class="mb-2">
        <button class="p-2 selected text-white border-0 rounded-3" data-bs-toggle="modal" data-bs-target="#makeSubjectForm">Créer une matière</button>
    </div>
   <div class=" d-flex  overflow-x-auto">
    <table >
        <thead>
            <th class="p-2">Nom</th>
            <th class="p-2">Action</th>
        </thead>

        <tbody>

            <?php foreach($subjects as $subject): ?>

            <tr subject_id="<?php echo $subject["id"] ?>">
                <td class="p-2 fw-medium editable" name="name"><?php echo $subject["name"] ?></td>
                <td class="p-2 text-center"><i user_id="<?php echo $subject["id"] ?>" class="fa-solid fa-trash-can pointer deleteSubjectButton"></i></td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
   </div>

   <form method="post" class="modal fade" id="makeSubjectForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Créer une matière
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body subjects-modal-body position-relative">
                <div class="p-1"><label for="class-input"><i class="fa-solid fa-book me-2"></i></label><input id="class-input" autocomplete="name" class="border-0 p-1 rounded-3" name="subject" placeholder="Nom" type="text"></div>  
                
        

            </div>
            <div class="modal-footer">
                <button type="button" class="p-2 border-0 rounded-3" data-bs-dismiss="modal"> Fermer</button>
                <button type="submit" class="p-2 selected text-white border-0 rounded-3">Sauvegarder</button>
            </div>
        </div>
    </div>
</form>   
