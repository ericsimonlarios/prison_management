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
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link href="css_new/bootstrap.min.css" rel="stylesheet">
    <link href="css_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css_new/custom.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/print_rules.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php
            include 'sidebar.php';

            if (isset($_GET['status'])) {
                $status  = $_GET['status'];
                $message = $_GET['message'];
                echo "<script>alert('$message')</script>";
            }

            if (isset($_GET['id'])) {
                $prisoner_id = $_GET['id'];

                $selectQuery  =  " SELECT * FROM prisoner 
            LEFT JOIN block_list ON prisoner.cell_id = block_list.id 
            LEFT JOIN prison_list ON block_list.building_id = prison_list.id 
            LEFT JOIN record_list ON prisoner.prisoner_id = record_list.inmate_id
            LEFT JOIN action_list ON record_list.action_id = action_list.id 
            WHERE prisoner.prisoner_id ='$prisoner_id'";
                $selectStmt = $con->query($selectQuery);
                if (!$selectStmt) {
                    $error = $con->errno . ' ' . $con->error;
                    echo $error;
                }
                $select_rows = $selectStmt->num_rows;
                $rows = $selectStmt->fetch_all(MYSQLI_ASSOC);
                foreach ($rows as $row) {
                }
            } else {
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];

                $selectQuery = "SELECT * FROM prisoner 
            LEFT JOIN block_list ON prisoner.cell_id = block_list.id 
            LEFT JOIN prison_list ON block_list.building_id = prison_list.id 
            LEFT JOIN record_list ON prisoner_id = record_list.inmate_id
            LEFT JOIN action_list ON record_list.action_id = action_list.id 
            WHERE first_name='$fname' AND last_name='$lname'";
                if (!$selectStmt = $con->query($selectQuery)) {
                    $error = $con->errno . " " . $con->error;
                    echo $error;
                }
                $select_rows = $selectStmt->num_rows;
                $rows = $selectStmt->fetch_all(MYSQLI_ASSOC);
                foreach ($rows as $row) {
                }
                $prisoner_id = $row['prisoner_id'];
            }

            ?>

            <!-- Page Content  -->
            <div class="right_col " role="main">
                <!-- top tiles -->
                <div class="row col-12" style="display: inline-block;">
                    <div id="content" class="p-4 ">
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-right">
                                            <li class="breadcrumb-item"><a href="prisoner-directory.php.">Prisoner Directory</a></li>
                                            <li class="breadcrumb-item"><a href="released-prisoner.php.">Released Prisoner</a></li>
                                            <li class="breadcrumb-item active">View Prisoner</li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <div id="main-body">
                            <button class="btn btn-outline-dark mr-5 float-right" id="print">Print</button>
                            <div class="form-group text-center">
                                <h3 class="mb-4" style="text-align: center;">View Prisoner</h3>
                            </div>

                            <div class="appointment-form shadow p-3 m-5 bg-white rounded officer-view prisoner-view p-4" role="alert" action="">
                                <div class="form-group d-flex flex-row p-0 m-0 align-items-center col w-100 mb-3">
                                    <div class="form-group pl-0 mb-0 col-auto d-flex align-items-center">
                                        <img id="product_img_container" height="180px" width="180px" src="<?php echo $row['prisoner_pic'] ?>" alt="">
                                    </div>
                                    <div class="form-group p-0 m-0 col">
                                        <div class="form-group p-0 m-0 d-flex flex-row ">
                                            <div class=" d-flex flex-row m-0 p-0 col-auto">
                                                <div class=" border border-secondary h-auto bg-dark col-auto text-white">
                                                    <p class="m-0">Prisoner Code</p>
                                                </div>
                                                <div class=" border border-secondary h-auto col">
                                                    <p class="m-0"><strong><?php echo $row['code']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class=" d-flex flex-row m-0 p-0 col">
                                                <div class=" border border-secondary bg-dark col-auto text-white">Cell Block</div>
                                                <div class=" border border-secondary col"><strong><?php echo $row['name'] . " - " . $row['cell_name']; ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="form-group p-0 m-0 d-flex flex-row ">
                                            <div class="d-flex flex-row m-0 p-0 w-100">
                                                <div class="border border-secondary bg-dark col-auto text-white">Name</div>
                                                <div class="border border-secondary col"><strong><?php echo $row['first_name'] . " " . strtoupper($row['middle_name'][0]) . "." . " " . $row['last_name']; ?></strong></div>
                                            </div>
                                        </div>

                                        <div class="form-group p-0 m-0 col-auto d-flex flex-row ">
                                            <div class="d-flex flex-row m-0 p-0 col">
                                                <div class="border border-secondary bg-dark col-auto text-white">Sex</div>
                                                <div class="border border-secondary col"><strong><?php echo $row['sex']; ?></strong></div>
                                            </div>
                                            <div class="d-flex flex-row m-0 p-0 col">
                                                <div class="border border-secondary bg-dark col-auto text-white">Birthday</div>
                                                <div class="border m-0 border-secondary col"><strong><?php echo date('F j, Y', strtotime($row['birthdate'])); ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="form-group p-0 m-0 d-flex flex-row ">
                                            <div class="d-flex flex-row m-0 p-0 w-100">
                                                <div class="border border-secondary bg-dark col-auto text-white">Address</div>
                                                <div class="border border-secondary col"><strong><?php echo $row['address'] ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="form-group p-0 m-0 col-auto d-flex flex-row ">
                                            <div class="d-flex flex-row m-0 p-0 col">
                                                <div class="border border-secondary bg-dark col-auto text-white">Marital Status</div>
                                                <div class="border border-secondary col"><strong><?php echo $row['marital_status']; ?></strong></div>
                                            </div>
                                            <div class="d-flex flex-row m-0 p-0 col">
                                                <div class="border border-secondary bg-dark col-auto text-white">Complexion</div>
                                                <div class="border border-secondary col"><strong><?php echo $row['complexion']; ?></strong></div>
                                            </div>
                                            <div class="d-flex flex-row m-0 p-0 col">
                                                <div class="border border-secondary bg-dark col-auto text-white">Eye Color</div>
                                                <div class="border border-secondary col"><strong><?php echo $row['eye_color']; ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="form-group p-0 m-0 d-flex flex-row ">
                                            <div class="d-flex flex-row m-0 p-0 w-100">
                                                <div class="border border-secondary bg-dark col-auto text-white">Alias</div>
                                                <div class="border border-secondary col"><strong><?php echo $row['alias'] ?></strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="pt-3 pb-3">Case Details</h3>
                                <div class="form-group p-0">
                                    <div class="form-group  p-0 m-0 col-auto d-flex flex-row ">
                                        <div class="d-flex flex-row m-0 p-0 w-100">
                                            <div class="border border-secondary bg-dark col-auto text-white">Crime Committed</div>
                                            <div class="border border-secondary col"><strong><?php echo $row['crime']; ?></strong></div>
                                        </div>
                                    </div>
                                    <div class="form-group  p-0 m-0 col-auto d-flex flex-row ">
                                        <div class="d-flex flex-row m-0 p-0 w-100">
                                            <div class="border border-secondary bg-dark col-auto text-white">Sentence</div>
                                            <div class="border border-secondary col"><strong><?php echo $row['sentence']; ?></strong></div>
                                        </div>
                                    </div>
                                    <div class="form-group p-0 m-0 col-auto d-flex flex-row ">
                                        <div class="d-flex flex-row m-0 p-0 col">
                                            <div class="border border-secondary bg-dark col-auto text-white ">Date Serve Start</div>
                                            <div class="border border-secondary col"><strong><?php echo date('F j, Y', strtotime($row['date_jailed'])); ?></strong></div>
                                        </div>
                                        <div class="d-flex flex-row m-0 p-0 col">
                                            <div class="border border-secondary bg-dark col-auto text-white">Date Serve End</div>
                                            <div class="border border-secondary col"><strong><?php echo date('F j, Y', strtotime($row['discharge_date'])); ?></strong></div>
                                        </div>
                                    </div>
                                    <div class="form-group p-0 m-0 col-auto d-flex flex-row ">
                                        <div class="d-flex flex-row m-0 p-0 w-100">
                                            <div class="border border-secondary bg-dark col-auto text-white">Status</div>
                                            <div class="border border-secondary col"><strong><?php echo $row['status']; ?></strong></div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="pt-3 pb-3">Emergency Details</h3>
                                <div class="form-group p-0">
                                    <div class="form-group p-0 m-0 col-auto d-flex flex-row ">
                                        <div class="d-flex flex-row m-0 p-0 w-100">
                                            <div class="border border-secondary bg-dark col-auto text-white">Name</div>
                                            <div class="border border-secondary col"><strong><?php echo $row['emergency_name']; ?></strong></div>
                                        </div>
                                    </div>
                                    <div class="form-group p-0 m-0 col-auto d-flex flex-row col">
                                        <div class="d-flex flex-row p-0 col">
                                            <div class="border border-secondary bg-dark col-auto text-white">Relation</div>
                                            <div class="border border-secondary col"><strong><?php echo $row['emergency_relation']; ?></strong></div>
                                        </div>
                                        <div class="d-flex flex-row p-0 col">
                                            <div class="border border-secondary bg-dark col-auto text-white">Contact</div>
                                            <div class="border border-secondary col"><strong><?php echo $row['emergency_contact']; ?></strong></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="appointment-form shadow p-3 m-5 bg-white rounded officer-view prisoner-view p-4" role="alert" id="hist-div" action="" data-val="<?php echo $prisoner_id ?>">
                                <h3 class="pt-3 pb-3">Family Details</h3>
                                <?php if ($row['status'] != 'Released') {
                                    echo '<button id="no-print-this" class="btn float-right btn-primary mb-4" data-toggle="modal" data-target="#addFamModal"><i class="fa fa-plus-circle"></i> Create New</button>';
                                } ?>
                                <table id="table_fam" class="table table-bordered dataTable table-hover display" width="100%" style="text-align: center;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Sex</th>
                                            <th scope="col">Relation</th>
                                            <th scope="col">Occupation</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="appointment-form shadow p-3 m-5 bg-white rounded officer-view prisoner-view p-4" role="alert" id="hist-div" action="" data-val="<?php echo $prisoner_id ?>">
                                <h3 class="pt-3 pb-3">Prisoner History Record</h3>
                                <?php if ($row['status'] != 'Released') {
                                    echo '<button id="no-print-this" class="btn float-right btn-primary mb-4" data-toggle="modal" data-target="#addRecordModal"><i class="fa fa-plus-circle"></i> Create New</button>';
                                } ?>
                                <table id="table_id" class="table table-bordered dataTable table-hover display" width="100%" style="text-align: center;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <input type="hidden" id="type" value="record_list">
                        <input type="hidden" id="p_id" value="<?php echo $prisoner_id ?>">
                        <?php
                        include "add-record-form.php";
                        include "edit-record-form.php";
                        include "delete-form.php";
                        include "edit-fam-form.php";
                        include "add-fam-form.php";
                        include "delete-fam-model.php";
                        include "profile.php";

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var id = '<?php echo $prisoner_id ?>'
        document.getElementById('btn').onclick = function() {
            window.location.href = 'edit-prisoner-form.php?id=' + id
        }
    </script>
    <script src="custom.js"></script>
    <script src="assets/jasonday-printThis-23be1f8/printThis.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</body>
<script>
    reload()
    var id = '<?php echo $prisoner_id ?>'
    $("#print").click(function() {
        $("#table_id").dataTable().fnDestroy();
        $("#table_fam").dataTable().fnDestroy();
        $("#main-body").printThis({
            base: "view-prisoner.php",
            importCSS: true,
            importStyle: true,
            loadCSS: "css/print_rules.css",
            afterPrint: reload
        });
    });

    function reload() {
        $("#table_id").dataTable({
            responsive: true,
            ajax: {
                type: 'POST',
                url: 'actions.php',
                data: {
                    getTable: 'table',
                    prisoner_id: id
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
                    data: [3],
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
                    columns: [0, 1, 2]
                }
            }, {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }, {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }, {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }, {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }]
        })
        $('#table_fam').dataTable({
            "language": {
                "emptyTable": "No data available in table"
            },
            searching: true,
            "ordering": true,
            "columnDefs": [{
                targets: 5,
                searchable: false,
                orderable: false,
            }],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copyHtml5',
                title: 'Family Details',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }, {
                extend: 'csvHtml5',
                title: 'Family Details',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }, {
                extend: 'excelHtml5',
                title: 'Family Details',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }, {
                extend: 'pdfHtml5',
                title: 'Family Details',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }, {
                extend: 'print',
                title: 'Family Details',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }],
            ajax: {
                type: 'POST',
                url: 'actions.php',
                data: {
                    getFam: 'fam',
                    prisoner_id: id
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
                    data: [4]
                },
                {
                    data: [5],
                    className: "align-middle"
                }
            ]
        })
    }
    $.ajax({
        type: "POST",
        url: 'actions.php',
        data: {
            getVal: 'get'
        },
        cache: false,
        success: function(data1) {
            var id = '<?php echo $prisoner_id ?>'
            var code = '<?php echo $row['code'] ?>'
            var obj = JSON.parse(data1)
            $('#actionDate').val(obj[0]['date'])
            var htl = 'Add a record for Prisoner - ' + code
            $('#addRecordModalLabel').html(htl)
            $('#prisoner_id').val(id)
            $('#ref').val('view')
            var ctr = obj.length
            for (let i = 0; i < ctr; i++) {
                var aname = obj[i]['action']
                var id = obj[i]['action_id']
                $('#a-cell').append($("<option> </option>").val(id).html(aname))
                $('#a-cell').selectpicker('refresh');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr)
        }
    })
</script>

</html>