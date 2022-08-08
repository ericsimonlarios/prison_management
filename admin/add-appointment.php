<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Add an Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="appointment-form mt-4" role="alert" method="POST" action="../actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">
                        <div class="modal-body">
                           
                            <div class="form-group">
                                <label for="floatingInput">Visitor Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="vname" required>
                            </div>

                            <div class="form-group">
                                <label for="floatingInput">Email <span class="text-danger">(Required)</span></label>
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="vemail">
                            </div>

                            <div class="form-group ">
                                <label for="floatingInput">Contact no. <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="floatingInput" placeholder="Contact no." maxlength="11" name="vcontact" required>
                            </div>

                            <div class="form-group">
                                <label for="floatingInput">Address <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="floatingInput" placeholder="Address" name="vadd" required>
                            </div>

                            <div class="form-group">
                                <label for="floatingInput">Inmate First Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="floatingInput" placeholder="First Name" name="pfirst" required>
                            </div>
                            <div class="form-group">
                            <label for="floatingInput">Inmate Last Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="floatingInput" placeholder="Last Name" name="plast" required>            
                            </div>
                            <div class="form-group">
                            <label for="floatingInput">Relation <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="relation" placeholder="Relation" name="relation" required>            
                            </div>
                            <div class="form-group">
                            <label for="floatingInput">Status <span class="text-danger">(Required)</span></label>
                                <select class="form-control" name="status" id="stats" required>
                                    <option value="" hidden selected>Choose a Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Declined">Declined</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="floatingInput">Appointment Date <span class="text-danger">(Required)</span></label>
                                <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com" name="pdate" required>         
                            </div>
                            <input type="hidden" value="admin" name="rank">
                            <input type="hidden" id="type" name="type" value="add">
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="appointment-submit">Add</button>
                            </div>
                    </form>
                </div>
                

                

            </div>
        </div>

    </div>