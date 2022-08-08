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
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include 'sidebar.php';
            if (isset($_GET['status'])) {
                $status  = $_GET['status'];
                $message = $_GET['message'];
                echo "<script>alert('$message')</script>";
            }
            ?>

            <!-- Page Content  -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row col-12" style="display: inline-block;">
                    <div id="content" class="p-4 ">
                        <div class="form-group text-center">
                            <h3 class="mb-4" style="text-align: center;">Admin Directory</h3>
                            <button class="btn float-right btn-primary mb-4" id="redirectAdmin"><i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                        <table id="table_id" class="table table-bordered dataTable table-hover display" style="text-align: center;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <input type="hidden" id="type" value="admin">
            <?php
            include "add-action-form.php";
            include "edit-action-form.php";
            include "delete-form.php";
            include "profile.php";
            ?>
        </div>
        <footer>
            <div class="pull-right">
                <strong>Copyright &copy; 2022 <a href="#">Prison Management</a>.</strong> All rights reserved.
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>

    <script src="js_new/jquery.min.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>
        $('#table_id').DataTable({
            ajax: {
                type: 'POST',
                url: 'actions.php',
                data: {
                    getAdmin: 'table'
                }
            },
            columns: [{
                    data: [0]
                },
                {
                    data: [1]
                },
                {
                    data: [2]
                },
                {
                    data: [3]
                },
                {
                    data: [4],
                    className: "align-middle"
                }
            ],
            "language": {
                "emptyTable": "No data available in table"
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }, {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }, {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }, {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }, {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }]
        });
    </script>
</body>
<script src="custom.js"></script>

</html>