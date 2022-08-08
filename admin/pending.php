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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Management</title>

    <link href="css_new/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link href="css_new/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include 'sidebar.php'; ?>
            <!-- Page Content  -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row col-12" style="display: inline-block;">
                    <div id="content" class="p-4 ">
                        <?php

                        if (isset($_GET['status'])) {
                            $status  = $_GET['status'];
                            $message = $_GET['message'];
                            echo "<script>alert('$message')</script>";
                        }
                        $con = connect();
                        $selectQuery  =  " SELECT * FROM appointment WHERE stats ='Pending'";
                        $selectStmt = $con->query($selectQuery);
                        if (!$selectStmt) {
                            $error = $con->errno . ' ' . $con->error;
                            echo $error;
                        }
                        $select_rows = $selectStmt->num_rows;
                        $appointment = 'appointment';

                        echo <<< END
                        <div class="form-group text-center">
                        <h3 class="mb-4" style="text-align: center;">Pending Appointment Request</h3>
                        <button class="btn float-right btn-primary mb-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                        END;
                        if ($select_rows == 0) {
                            echo <<<END
                        <div class="container block text-center form-group d-flex flex-column justify-content center">
                            <div class="form-group col">
                            <span class="h5 ">No Pending Appointments</span>
                            </div>
                            <div class="form-group col">
                            <i class="fa-regular fa-face-sad-tear fa-10x mt-5 text-center "></i>
                            </div> 
                        </div>
                        END;
                        } else {

                            echo <<<END
                    <table id="table_id"  class="table table-bordered table-hover display" style="text-align: center;">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Visitor</th>
                        <th scope="col">Email</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Added</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                  END;

                            for ($i = 0; $select_rows > $i; ++$i) {
                                $row = $selectStmt->fetch_array(MYSQLI_ASSOC);
                                $app_id = htmlentities($row['appointment_id']);
                                $vname  = htmlentities($row['vname']);
                                $email  = htmlentities($row['vemail']);
                                $pdate  = htmlentities($row['pdate']);
                                $padded = htmlentities($row['appointment_added']);
                                $stats = htmlentities($row['stats']);

                                echo <<<  END
                    <tr>
                    <td>$app_id</td>
                    <td>$vname</td>
                    <td>$email</td>
                    <td>$pdate</td>
                    <td>$padded</td>
                    <td><span class="badge badge-warning bg-gradient-warning px-3 rounded-pill">$stats</span></td>
                    <td><a href="view-appointment.php?id=$app_id"><i class="fa fa-eye"></i>&nbsp</a><a id="edit" data-whatever='$app_id' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i>&nbsp</a><a id="delete" data-whatever='$app_id' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    
                  END;
                            }

                            echo <<<END
                </tbody>
                </table>
                END;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php include "add-appointment.php";
            include "edit-appointment.php";
            include "delete-form.php";
            include "profile.php";
            ?>
        </div>
        <input type="hidden" id="type" value="<?php echo $appointment ?>">
        <footer>
            <div class="float-right">
                <strong>Copyright &copy; 2022 <a href="#">Prison Management</a>.</strong> All rights reserved.
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>



    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="js_new/jquery.min.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="custom.js"></script>
<script>
    $('#table_id').DataTable({
        searching: true,
        "ordering": true,
        "columnDefs": [{
                targets: 6,
                searchable: false,
                orderable: false,
            }, {
                targets: 5,
                searchable: false,
                orderable: false,
            }

        ],
        dom: 'Bfrtip',
        buttons: [{
            extend: 'copyHtml5',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        }, {
            extend: 'csvHtml5',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        }, {
            extend: 'excelHtml5',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        }, {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        }, {
            extend: 'print',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        }]
    });
</script>

</html>