<?php
include "../dbcon.php";
session_start();
if (!isset($_SESSION['name'])) {
    header('location: ../temp.php');
}
$con = connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Management</title>
    <link href="css_new/bootstrap.min.css" rel="stylesheet">
    <link href="css_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css_new/custom.min.css" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include 'sidebar.php';
           
            ?>

            <!-- Page Content  -->
            <div class="right_col" role="main">
            
                <!-- top tiles -->
                <div class="row" style="display: inline-block;">
                    <div id="content" class="container-fluid p-4 p-md-5  ">
                        <h3 class="mb-5">Welcome, <?php
                                                    if ($_SESSION['rank'] == 'admin') {
                                                        echo 'Administrator ' . $_SESSION['fname'];
                                                    } else {
                                                        echo 'Officer ' . $_SESSION['fname'];
                                                    }
                                                    ?>!</h3>
                        <div class="row text-size">
                            <div class="col-12 col-sm-3 col-md-3 ">
                                <div class="row shadow-lg bg-white rounded p-2 m-1">
                                    <div class="col-auto shadow bg-secondary rounded p-3">
                                        <i class="fa fa-list-alt fa-3x text-light"></i>
                                    </div>
                                    <div class="row col d-flex justify-content-center">
                                        <div class="col-auto text-center">
                                            <span>Prison List</span>
                                        </div>
                                        <div class="col-auto text-center">
                                            <span class="text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM prison_list where status_prison = 1")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-3 col-md-3">
                                <div class="row shadow-lg rounded p-2 m-1">
                                    <div class="col-auto shadow bg-danger rounded p-3">
                                        <i class="fa fa-unlock-alt fa-3x text-white"></i>
                                    </div>
                                    <div class="row col d-flex justify-content-center">
                                        <div class="col-auto text-center">
                                            <span class="col">Cell Block</span>
                                        </div>
                                        <div class="col text-center">
                                            <span class="info-box-number text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM block_list where status_cell = 1")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-3 col-md-3">
                                <div class="row shadow-lg bg-white rounded p-2 m-1">
                                    <div class="col-auto shadow bg-primary rounded p-3">
                                        <i class="fa fa-user fa-3x text-white"></i>
                                    </div>
                                    <div class="row col d-flex justify-content-center">
                                        <div class="col-auto text-center">
                                            <span class="text-center">Active Officers</span>
                                        </div>
                                        <div class="col-auto text-center">
                                            <span class="info-box-number text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM police where status = 'Employed'")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 ">
                                <div class="row shadow-lg bg-white rounded p-2 m-1">
                                    <div class="col-auto shadow bg-info rounded p-3">
                                        <i class="fa fa-list fa-3x text-light"></i>
                                    </div>
                                    <div class="row col">
                                        <div class="col text-center">
                                            <span class="col text-center">Actions</span>
                                        </div>
                                        <div class="col text-center">
                                            <span class="info-box-number text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM action_list where status_action = 1")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 my-4">
                                <div class="row shadow-lg bg-white rounded col-auto p-2 m-1">
                                    <div class="col-auto shadow bg-danger rounded p-3">
                                        <i class="fa fa-user fa-3x text-white"></i>
                                    </div>
                                    <div class="row col d-flex justify-content-center">
                                        <div class="col-auto">
                                            <span class="text-center">Current Inmates</span>
                                        </div>
                                        <div class="col-auto text-center">
                                            <span class="text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM prisoner where status = 'Jailed'")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 my-4">
                                <div class="row shadow-lg bg-white rounded px-2 p-2 m-1">
                                    <div class="col-auto shadow bg-success rounded p-3">
                                        <i class="fa fa-user fa-3x text-light"></i>
                                    </div>
                                    <div class="row col d-flex justify-content-center">
                                        <div class="col-auto">
                                            <span class="text-center">Released Inmates</span>
                                        </div>
                                        <div class="col text-center">
                                            <span class="info-box-number text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM prisoner where status = 'Released'")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 my-4">
                                <div class="row shadow-lg bg-white rounded  p-2 m-1">
                                    <div class="col-auto shadow bg-warning rounded p-3">
                                        <i class="fa fa-book fa-3x text-light"></i>
                                    </div>
                                    <div class="row col d-flex justify-content-center">
                                        <div class="col-auto text-center">
                                            <span>Appointments</span>
                                        </div>
                                        <div class="col-auto text-center">
                                            <span class="info-box-number text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM appointment where stats = 'Pending'")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 my-4">
                                <div class="row shadow-lg bg-white rounded p-2 m-1">
                                    <div class="col-auto shadow bg-white rounded p-3">
                                        <i class="fa fa-users fa-3x text-Dark"></i>
                                    </div>
                                    <div class="row col d-flex justify-content-center">
                                        <div class="col-auto text-center">
                                            <span class="col">Admin</span>
                                        </div>
                                        <div class="col-auto text-center">
                                            <span class="info-box-number text-right h5 col">
                                                <?php $prison = $con->query("SELECT * FROM admin")->num_rows;
                                                echo $prison; ?>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                        </div>
                        <div class=" text-center">
                            <img src="../background-image-3.jpg" class="img-fluid">
                        </div>
                    </div>
                </div>
                <?php include "profile.php";?>                                       
            </div>
            <footer>
                <div class="pull-right">
                    <strong>Copyright &copy; 2022 <a href="#">Prison Management</a>.</strong> All rights reserved.
                </div>
                <div class="clearfix"></div>
            </footer>
        </div>
        <input type="hidden" id="type" value="admin">

    </div>



    <script src="js_new/jquery.min.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>

</body>


</html>