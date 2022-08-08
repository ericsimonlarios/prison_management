<div class="modal fade" id="editFamModal" tabindex="-1" role="dialog" aria-labelledby="editFamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editFamModalLabel">Edit Family Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="appointment-form  mt-4" role="alert" method="POST" action="actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col"><label for="ename">Name <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famname" name="famname" placeholder="Name" required></div>
                    </div>
                    <div class="row">
                        <div class="form-group col"><label for="ename">Age <span class="text-danger">(Required)</span></label><input type="number" class="form-control" id="famage" name="famage" placeholder="Age" required></div>
                    </div>
                    <div class="row">
                        <div class="form-group col"><label for="sex">Sex assigned at Birth<span class="text-danger">(Required)</span></label><select type="text" class="form-control"  name="famsex" placeholder="Sex" required>
                                <option value="" id="famsex" selected hidden></option>
                                <option value="Male" >Male</option>
                                <option value="Female">Female</option>
                            </select></div>
                    </div>
                    <div class="row">
                        <div class="form-group col"><label for="erela">Relation <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famrela" name="famrela" placeholder="Relation" required></div>
                    </div>
                    <div class="row">
                        <div class="form-group col"><label for="erela">Occupation / Source of Income <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="occ" name="occ" placeholder="Occupation / Source of Income" required></div>
                    </div>
                </div>
                <input type="hidden" id="type" name="type" value="edit">
                <input type="hidden" id="famid" name="id">
                <input type="hidden" id="prisoner-id" name="prisoner_id" value = "<?php echo $prisoner_id ?>">
                <input type="hidden" id="ref" name="view">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="fam-submit">Edit</button>
                </div>

            </form>
        </div>


    </div>
</div>