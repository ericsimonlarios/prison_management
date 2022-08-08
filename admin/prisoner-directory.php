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
    <title>Prisoner Directory</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <link href="css_new/bootstrap.min.css" rel="stylesheet">
    <link href="css_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css_new/custom.min.css" rel="stylesheet">

    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

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
                        <?php

                        $con = connect();
                        $selectQuery  =  " SELECT * FROM prisoner WHERE status='Jailed'";
                        $selectStmt = $con->query($selectQuery);
                        if (!$selectStmt) {
                            $error = $con->errno . ' ' . $con->error;
                            echo $error;
                        }
                        $select_rows = $selectStmt->num_rows;
                        $type = "prisoner";
                        echo <<< END
            <h3 class="mb-5" style="text-align: center;">Prisoner Directory</h3>
            END;

                        echo '<button class="btn float-right btn-primary mb-4" id="redirectPrisoner"><i class="fa fa-plus-circle"></i> Create New</button>';

                        if ($select_rows == 0) {
                            echo <<<END
                <div class="container block text-center form-group d-flex flex-column justify-content center">
                <div class="form-group col">
                <span class="h5 ">No Prisoners in the directory yet...</span>
                </div>
                <div class="form-group col">
                <i class="fa-regular fa-face-sad-tear fa-10x mt-5 text-center "></i>
                </div> 
            END;
                        } else {

                            echo <<<END
                    <table id="table_id"  class="table table-bordered table-hover display" style="text-align: center;">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Prisoner</th>
                        <th scope="col">Code</th>
                        <th scope="col">Sentence</th>
                        <th scope="col">Discharge Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                END;

                            for ($i = 0; $select_rows > $i; ++$i) {
                                $row = $selectStmt->fetch_array(MYSQLI_ASSOC);
                                $prisoner_id    = htmlentities($row['prisoner_id']);
                                $code          = htmlentities($row['code']);
                                $fname          = htmlentities($row['first_name']);
                                $lname          = htmlentities($row['last_name']);
                                $mname          = htmlentities($row['middle_name']);
                                $sentence       = htmlentities($row['sentence']);
                                $discharge_date = htmlentities($row['discharge_date']);
                                $status         = htmlentities($row['status']);

                                echo <<<  END
                        <tr>
                        <td>$prisoner_id</td>
                        <td>$fname $lname </td>
                        <td>$code</td>
                        <td>$sentence</td>
                        <td>$discharge_date</td>
                    
                    END;
                                if ($status == "Released") {
                                    echo '<td><span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">' . $status . '</span></td>';
                                } else {
                                    echo '<td><span class="badge badge-success bg-gradient-success px-3 rounded-pill">' . $status . '</span></td>';
                                }

                                echo ' <td><a href="view-prisoner.php?id=' . $prisoner_id . '"><i class="fa fa-eye"></i>&nbsp</a><a href="edit-prisoner-form.php?id=' . $prisoner_id . '"><i class="fa fa-edit"></i>&nbsp</a><a id="delete" data-whatever="' . $prisoner_id . '" class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash text-danger"></i></a></td></tr>';
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
            <input type="hidden" id="type" value="<?php echo $type ?>">
            <?php
            include "delete-form.php";
            include "profile.php";
            ?>
        </div>
    </div>
    <footer>
        <div class="pull-right">
            <strong>Copyright &copy; 2022 <a href="#">Prison Management</a>.</strong> All rights reserved.
        </div>
        <div class="clearfix"></div>
    </footer>

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
        $(document).ready(function() {
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
        });
    </script>
</body>
<script src="custom.js"></script>

</html>