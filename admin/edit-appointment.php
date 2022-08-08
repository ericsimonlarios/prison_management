
<div class="modal fade" id="editModal" tabindex="1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="editModalLabel">Edit an Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="appointment-form mt-4" role="alert" method="POST" action="../actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">
                        <div class="modal-body">
                           
                            <div class="form-group">
                                <label for="floatingInput">Visitor Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="vname" placeholder="Name" name="vname" required>
                            </div>

                            <div class="form-group">
                                <label for="floatingInput">Email <span class="text-danger">(Required)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="vemail">
                            </div>

                            <div class="form-group ">
                                <label for="floatingInput">Contact no. <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="contactno" placeholder="Contact no." maxlength="11" name="vcontact" required>
                            </div>

                            <div class="form-group">
                                <label for="floatingInput">Address <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="address" placeholder="Address" name="vadd" required>
                            </div>

                            <div class="form-group">
                                <label for="floatingInput">Inmate First Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="pfirst" placeholder="First Name" name="pfirst" required>
                            </div>
                            <div class="form-group">
                            <label for="floatingInput">Inmate Last Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="plast" placeholder="Last Name" name="plast" required>            
                            </div>
                            <div class="form-group">
                            <label for="floatingInput">Relation <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="rela" name="relation" placeholder="Relation" required>           
                            </div>
                            <div class="form-group">
                            <label for="floatingInput">Status <span class="text-danger">(Required)</span></label>
                                <select class="form-control" name="status" id="stats" required>
                                    <option id="selected" value="" hidden selected></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Declined">Declined</option>
                                </select>
                            </div>
                            <input type="hidden" id="id" name="app_id">
                            <input type="hidden" id="type" name="type" value="edit">
                            <div class="form-group">
                                <label for="floatingInput">Appointment Date <span class="text-danger">(Required)</span></label>
                                <input type="date" class="form-control" id="pdate" placeholder="name@example.com" name="pdate" required>         
                            </div>  
                            <div class="modal-footer">         
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="appointment-submit">Save changes</button>
                            </div>
                    </form>
                </div>
                

                

            </div>
        </div>

    </div>
