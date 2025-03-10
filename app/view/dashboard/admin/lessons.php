<?php 


use App\Models\Subjects;
$subjectModel = new Subjects;
$subjects = $subjectModel->fetchAll();


use App\Models\Classes;
$classesModel = new Classes;
$classes = $classesModel->fetchAll();

use App\Models\Users;
$usersModel = new Users;
$teachers = $usersModel->fetchTeachers();


?>

<div class="d-flex">
    <h4 class="me-2">Selectionnez une classe : </h4>

    <select id="schedule-class-select" class="border-2 focus-ring rounded-2 mb-4 fs-6">
        <option disabled selected></option>
        <?php foreach($classes as $class):?>
            <option value="<?php echo $class['id'] ?>"  ><?php echo $class['name'] ?></option>
        <?php endforeach;?>
            
    </select>    

</div>






<div id="calendar"></div>


<form method="post" class="modal fade" id="addLessonModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Planifier un cours</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body classes-modal-body position-relative">
                <div class="p-1">
                    <label for="subject-input"><i class="fa-solid fa-chalkboard-user"> </i></label>
                        <select name="subject" class="border-0 p-1 rounded-3" id="subject-input">
                                <option disabled selected>Matière</option>

                                <?php foreach($subjects as $subject):?>

                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['name'] ?></option>

                                <?php endforeach?>

                        </select>
                </div> 
                <div class="p-1">
                    <label for="class-input"><i class="fa-solid fa-graduation-cap "> </i></label>
                        <select name="class" class="border-0 p-1 rounded-3" id="class-input">
                                <option disabled selected>Classe</option>
                                    <?php foreach($classes as $classe):?>s
                                    <option value="<?php echo $classe['id'] ?>"><?php echo $classe['name'] ?></option>
                                    <?php endforeach?>
                        </select>
                </div>  
                <div class="p-1">
                    <label for="teacher-input"><i class="fa-solid fa-person-chalkboard"> </i></label>
                        <select name="teacher" class="border-0 p-1 rounded-3" id="teacher-input">
                                <option disabled selected>Enseignant</option>
                                    <?php foreach($teachers as $teacher):?>
                                    <option value="<?php echo $teacher['id'] ?>"><?php echo $teacher['username'] ?></option>
                                    <?php endforeach?>
                        </select>
                </div>

                <div class="p-1">
                    <label for="duration-input"><i class="fa-solid fa-clock"> </i></label>
                        <select name="duration" class="border-0 p-1 rounded-3" id="duration-input">
                                <option disabled selected>Durée</option>
                                <option value="30">00:30</option>
                                <option value="60">01:00</option>
                                <option value="90">01:30</option>
                                <option value="120">02:00</option>
                                <option value="150">02:30</option>
                                <option value="180">03:00</option>
                                <option value="210">03:30</option>
                                <option value="240">04:00</option>
                        </select>
                </div>
        

            </div>
            <div class="modal-footer">
                <button type="button" class="p-2 border-0 rounded-3" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="p-2 selected text-white border-0 rounded-3">Sauvegarder</button>
            </div>
        </div>
    </div>
</form>   

<form method="post" class="modal fade" id="editSubjectForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Modifier un cours</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body classes-modal-body position-relative">
                <h6 class="p-1 pb-2">Matière : <span id="edit-event-subject"></span></h6>
                <h6 class="p-1 pb-2">Classe : <span id="edit-event-class"></span></h6>
                <h6 class="p-1 pb-2">Enseignant : <span id="edit-event-teacher"></span></h6>
                <h6 class="p-1 pb-2">Début : <span id="edit-event-start"></span></h6>
                <h6 class="p-1 pb-2">Fin : <span id="edit-event-end"></span></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="p-2 border-0 rounded-3" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="p-2 selected text-white border-0 rounded-3">Sauvegarder</button>
            </div>
        </div>
    </div>
</form>   