<?php
include "../dbcon.php";
session_start();
if (!isset($_SESSION['name'])) {
    header('location: ../temp.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Management</title>

    <link href="css_new/bootstrap.min.css" rel="stylesheet">
    <link href="css_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css_new/custom.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include 'sidebar.php'; ?>
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row col-12" style="display: inline-block;">
                    <div id="content" class="p-4 ">
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-right">
                                            <li class="breadcrumb-item"><a href="admin-directory.php.">Admin Directory</a></li>
                                            <li class="breadcrumb-item active">Edit Admin</li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <div class="form-group text-center">
                            <h3 class="mb-4" style="text-align: center;">Edit Admin</h3>
                        </div>
                        <?php
                        if (isset($_GET['status'])) {
                            $status  = $_GET['status'];
                            $message = $_GET['message'];
                            echo "<script>alert('$message')</script>";
                            if ($status == 'success') {
                                echo <<<end
                        <div style="display:block;" class=" alert alert-success alert-handler mb-3" role="alert">
                        $message
                        </div>
                       end;
                            } else {
                                echo <<<end
                        <div style="display:block;" class=" alert alert-danger alert-handler mb-3" role="alert">
                        $message
                        </div>
                       end;
                            }
                        }

                        $id = $_GET['id'];
                        $con = connect();
                        $select = "SELECT * FROM admin WHERE admin_id='$id'";
                        if (!$stmt = $con->query($select)) {
                            $error = $con->errno . ' ' . $con->error;
                            echo $error;
                            die();
                        }
                        $count = $stmt->num_rows;
                        $rows = $stmt->fetch_all(MYSQLI_ASSOC);
                        if ($count > 0) {
                            foreach ($rows as $row) {
                                $fname =  $row['fname'];
                                $mname =  $row['mname'];
                                $lname =  $row['lname'];
                                $a_name = $row['admin_name'];
                                $getPic = $row['admin_pic'];
                            }
                        } else {
                            header('location: admin-directory.php');
                            die();
                        }
                        echo <<<END
                        <form class="form shadow p-5 bg-white rounded"  method="POST" enctype="multipart/form-data" action="actions.php">
                        <div class="row">
                            <div class="form-group col">
                                <label for="fName">First Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="fName" name="fname" placeholder="First Name" value="$fname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="fName">Middle Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="fName"  name="mname" placeholder="Middle Name" value="$mname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="fName">Last Name <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="fName" name="lname" placeholder="Last Name" value="$lname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="fName">Username <span class="text-danger">(Required)</span></label>
                                <input type="text" class="form-control" id="fName" name="admin_name" placeholder="Username" value="$a_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="lName">Old Password <span class="text-danger">(Required)</span></label>
                                <input type="password" class="form-control" id="lName" name="old_pass" placeholder="Old Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="lName">New Password <span class="text-danger">(Required)</span></label>
                                <input type="password" class="form-control" id="lName" name="new_pass" placeholder="New Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="rank">Confirm Password <span class="text-danger">(Required)</span></label>
                                <input type="password" class="form-control" id="rank" placeholder="Confirm Password" name="conf_pass" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                        <div class="form-group col">
                            <label for="police_pic">Add a picture</label>
                            <br>
                            <input type="file" id="police_pic" name="admin_pic">
    
                        </div>
                        <div class="form-group col-7">
                            <span><strong>Preview :</strong></span>
                            <br>
                            <input type="hidden" value="../icon.png" name="nullPic">
                            <img id="product_img_container" height="150px" width="150px" src="$getPic" alt="">
                            <input type="hidden" value="$getPic" name="current_admin_pic">

                        </div>
                    </div>
                        <input type="hidden" value="$id" name="id">
                        <input type="hidden" value="admin" name="role">
                        <div class="row mt-3">
                            <div class="form-group col-auto">
                                <input type="submit" class="btn btn-success btn-lg btn-block" id="add" name="edit_admin" value="Edit">
                            </div>
                            <div class="col-auto">     
                                <button type='button' class="btn btn-danger btn-lg btn-block" id="cancel" data-whatever = "admin-directory">Cancel</button>
                            </div>
                        </div>
                    </form>
                END;

                        ?>


                    </div>
                </div>
            </div>
            <?php include "profile.php";  ?>
        </div>
        <footer>
            <div class="pull-right">
                <strong>Copyright &copy; 2022 <a href="#">Prison Management</a>.</strong> All rights reserved.
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
    <script src="custom.js"></script>
    <script src="js_new/jquery.min.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>
</body>

</html>