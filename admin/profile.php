<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="profileModalLabel">Your Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-1 d-flex justify-content-center">
                    <div class="p-4">
                        <?php 
                        
                        $aid  = $_SESSION['id'];
                        $rank = $_SESSION['rank'];
                        $con = connect();
                        if($rank == "admin"){
                            $selectAdmin = "SELECT * FROM admin WHERE admin_id = '$aid'";
                        }else{
                            $selectAdmin = "SELECT * FROM officer LEFT JOIN police ON officer.police_id = police.police_id WHERE officer.officer_id = '$aid'";
                        }
                        if(!$profStmt = $con-> query($selectAdmin)){
                            $error = $con->errno . " " . $con->error;
                            echo $error;
                            die();
                        }
                        $profRows = $profStmt -> fetch_all(MYSQLI_ASSOC);
                        foreach($profRows as $profRow){
                            if($rank == 'admin'){
                                $fname = $profRow['fname'];
                                $mname = $profRow['mname'];
                                $lname = $profRow['lname'];
                                $pic   = $profRow['admin_pic'];
                                $username   = $profRow['admin_name'];
                                $url = "edit-admin-form.php";
                            }else{
                                $fname = $profRow['first_name'];
                                $mname = $profRow['middle_name'];
                                $lname = $profRow['last_name'];
                                $pic   = $profRow['police_pic'];
                                $username = $profRow['officer_name'];
                                $url = "edit-officer-form.php";
                            }
                        }
                        ?>
                        <div class=" image d-flex flex-column justify-content-center align-items-center"> <img src="<?php  echo $pic;?>" class="rounded-circle" height="100" width="100" /></button> <span class="name mt-3 h3 text-dark"><?php echo $fname . ' ' . $lname;?></span> 
                            <span class="name mt-1 h5"><?php echo "@". $username?></span> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="<?php echo $url ?>" method="GET">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="id" value="<?php echo $_SESSION['id']?>">Edit</button>
                    </form>
                </div>

            </div>


        </div>
    </div>