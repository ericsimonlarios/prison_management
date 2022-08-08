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
                    <div id="content" class="pt-4 pl-4 pr-4  pb-0">
                        <div class="content-wrapper">
                            <!-- Content Header (Page header) -->
                            <div class="content-header">
                                <div class="container-fluid">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <ol class="breadcrumb float-right">
                                                <li class="breadcrumb-item"><a href="officer-directory.php.">Officer Directory</a></li>
                                                <li class="breadcrumb-item active">Add Officer</li>
                                            </ol>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div><!-- /.container-fluid -->
                            </div>
                            <div class="form-group text-center">
                                <h3 class="mb-4" style="text-align: center;">Add Officer</h3>
                            </div>
                            <?php
                            if (isset($_GET['status'])) {
                                $status  = $_GET['status'];
                                $message = $_GET['message'];
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
                            ?>
                            <form class="form shadow p-5 bg-white rounded" role="alert" method="POST" enctype="multipart/form-data" action="actions.php">
                                <h3 class="pt-3 pb-3">Officer Details</h3>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="fName">First Name <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="mName">Middle Name <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="mName" name="mName" placeholder="Middle Name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="lName">Last Name <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="rank">Rank <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="rank" name="rank" placeholder="Rank" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="bno">Badge no. <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="bno" name="bno" placeholder="Badge no." maxlength="6" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="address">Address <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="cont">Contact no. <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="cont" name="cont" placeholder="Contact no" maxlength="11" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="sex">Sex assigned at Birth <span class="text-danger">(Required)</span></label>
                                        <select type="text" class="form-control" id="sex" name="sex" placeholder="sex" required>
                                            <option value="Male" selected>Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" value="Employed" readonly>
                                    </div>
                                </div>

                                <h3 class="pt-3 pb-3">Officer Account Information</h3>

                                <div class="row">
                                    <div class="form-group col">
                                        <label for="lName">Username <span class="text-danger">(Required)</span></label>
                                        <input type="text" class="form-control" id="uname" name="uname" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="lName">Password <span class="text-danger">(Required)</span></label>
                                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                                    </div>
                                </div>

                                <h3 class="pt-3 pb-3">Officer Image</h3>

                                <div class="row">
                                    <div class="form-group col">
                                        <label for="police_pic">Add a picture <span class="text-danger">(Required)</span></label>
                                        <br>
                                        <input type="file" id="police_pic" name="police_pic" required>
                                        <br>
                                        <br>
                                        <span><strong>Preview :</strong></span>
                                        <br>
                                        <img id="product_img_container" height="150px" width="150px" src="../placeholder-image.png" alt="">
                                    </div>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="col-auto">
                                        <input type="submit" class="btn btn-success btn-lg btn-block" id="add" name="add_officer" value="Add">
                                    </div>
                                    <div class="col-auto">
                                        <button type='button' class="btn btn-danger btn-lg btn-block" id="cancel" data-whatever="officer-directory">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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


    <script>
        var product_img = document.getElementById('police_pic');
        product_img.onchange = function(event) {
            const [file] = product_img.files
            if (file) {
                document.getElementById('product_img_container').src = URL.createObjectURL(file);
            }
        }
    </script>
    <script src="custom.js"></script>
    <script src="js_new/jquery.min.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>
</body>

</html>