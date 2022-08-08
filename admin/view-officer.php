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
        <?php
        include 'sidebar.php';
        if (isset($_GET['id'])) {
            $pol_id = $_GET['id'];

            $selectQuery  =  " SELECT * FROM police LEFT JOIN officer ON police.police_id = officer.police_id WHERE police.police_id ='$pol_id'";
            $selectStmt = $con->query($selectQuery);
            if (!$selectStmt) {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
            $select_rows = $selectStmt->num_rows;
            for ($i = 0; $select_rows > $i; ++$i) {
                $select_row        =  $selectStmt->fetch_array(MYSQLI_ASSOC);
                $fname             = htmlentities($select_row['first_name']);
                $mname       = htmlentities($select_row['middle_name']);
                $lname         = htmlentities($select_row['last_name']);
                $rank              = htmlentities($select_row['rank']);
                $bno               = htmlentities($select_row['badge_no']);
                $address           = htmlentities($select_row['address']);
                $started           = htmlentities($select_row['date_started']);
                $status            = htmlentities($select_row['status']);
                $police_pic        = htmlentities($select_row['police_pic']);
                $contact           = htmlentities($select_row['contact_no']);
                $usern             = htmlentities($select_row['officer_name']);
                $sex               = htmlentities($select_row['officer_sex']);
            }
        } else {
            header('location: officer-directory.php?status=Error&message=Page is not found');
            die();
        }
        ?>

        <!-- Page Content  -->
        <div class="right_col" role="main">
              <!-- top tiles -->
              <div class="row col-12" style="display: inline-block;" >
                <div id="content" class="p-4 ">
                    <div class="content-header">
                      <div class="container-fluid">
                        <div class="row mb-2">
                          <div class="col-sm-12">
                            <ol class="breadcrumb float-right">
                              <li class="breadcrumb-item"><a href="officer-directory.php.">Officer Directory</a></li>
                              <li class="breadcrumb-item"><a href="removed-officer.php.">Removed Officer</a></li>
                              <li class="breadcrumb-item active">View Officer</li>
                            </ol>
                          </div><!-- /.col -->
                        </div><!-- /.row -->
                      </div><!-- /.container-fluid -->
                    </div>
                <div class="form-group text-center">
                    <h3 class="mb-4" style="text-align: center;">Officer Details</h3>  
                </div>  
                <div class="form-group align-self-end p-3 no-print-this">
                    <button class="btn btn-outline-dark float-right" id="print">Print</button>
                </div>

                <div class="appointment-form officer-view shadow-lg px-5 bg-white  border border-secondary rounded alert-dark m-5 mt-0 text-dark" role="alert" action="">
                    <div class="form-group d-flex flex-row mt-4 p-3 m-0 justify-content-between col w-100 mb-3">
                        <div class="form-group pl-0 mb-0 col-auto d-flex align-items-center">
                            <img id="product_img_container" height="180px" width="180px" src="<?php echo $police_pic ?>" alt="">
                        </div>
                        <div class="form-group p-0 m-0 col-auto">
                            <div class=" d-flex flex-row m-0 p-0 col-auto" style="font-size: 20px;">
                                <div class=" border border-secondary h-auto bg-dark col-auto text-white">
                                    <p class="m-0">Status</p>
                                </div>
                                <div class=" border border-secondary h-auto col">
                                    <p class="m-0"><strong><?php echo $status; ?></strong></p>
                                </div>
                            </div>

                            <div class=" d-flex flex-row m-0 p-0 col-auto" style="font-size: 20px;">
                                <div class=" border border-secondary h-auto bg-dark col-auto text-white">
                                    <p class="m-0">Date Started</p>
                                </div>
                                <div class=" border border-secondary h-auto col">
                                    <p class="m-0"><strong><?php echo $started; ?></strong></p>
                                </div>
                            </div>
                            <div class=" d-flex flex-row m-0 p-0 col-auto" style="font-size: 20px;">
                                <div class=" border border-secondary h-auto bg-dark col-auto text-white">
                                    <p class="m-0">Badge no</p>
                                </div>
                                <div class=" border border-secondary h-auto col">
                                    <p class="m-0"><strong><?php echo $bno; ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-5 m-0 d-flex flex-row ">
                        <div class="d-flex flex-row m-0 p-0 w-100" style="font-size: 20px;">
                            <div class="border border-secondary bg-dark col-auto text-white">Name</div>
                            <div class="border border-secondary col"><strong><?php echo $fname . " " . $mname[0] . "." . " " . $lname; ?></strong></div>
                        </div>
                    </div>
                    <div class="form-group px-5 m-0 col-auto d-flex flex-row " style="font-size: 20px;">
                        <div class="d-flex flex-row m-0 p-0 col">
                            <div class="border border-secondary bg-dark col-auto text-white">Rank</div>
                            <div class="border border-secondary col"><strong><?php echo $rank; ?></strong></div>
                        </div>
                    </div>
                    <div class="form-group px-5 m-0 d-flex flex-row " style="font-size: 20px;">
                        <div class="d-flex flex-row m-0 p-0 w-100">
                            <div class="border border-secondary bg-dark col-auto text-white">Sex assigned at Birth</div>
                            <div class="border m-0 border-secondary col"><strong><?php echo $sex; ?></strong></div>
                        </div>
                    </div>
                    <div class="form-group px-5 m-0 d-flex flex-row " style="font-size: 20px;">
                        <div class="d-flex flex-row m-0 p-0 w-100">
                            <div class="border border-secondary bg-dark col-auto text-white">Contact No.</div>
                            <div class="border m-0 border-secondary col"><strong><?php echo $contact; ?></strong></div>
                        </div>
                    </div>
                    <div class="form-group px-5 m-0 d-flex flex-row " style="font-size: 20px;">
                        <div class="d-flex flex-row m-0 p-0 w-100">
                            <div class="border border-secondary bg-dark col-auto text-white">Address</div>
                            <div class="border m-0 border-secondary col"><strong><?php echo $address; ?></strong></div>
                        </div>
                    </div>
                    <div class="form-group px-5 m-0 mb-5 d-flex flex-row " style="font-size: 20px;">
                        <div class="d-flex flex-row m-0 p-0 w-100">
                            <div class="border border-secondary bg-dark col-auto text-white">Username</div>
                            <div class="border m-0 border-secondary col"><strong><?php echo $usern; ?></strong></div>
                        </div>
                    </div>

                    <?php
                    if ($_SESSION['rank'] == 'admin') {
                        echo <<<END
                    <div class="form-group px-5 m-0 mb-5 d-flex flex-row justify-content-end no-print-this">
                    <button type="button" id="back" class="btn btn-danger btn-lg mx-3 back">Back</button>
                    <button type="button" id="btn" class="btn btn-success btn-lg">Edit</button>
                    </div>
                    END;
                    } else {
                        echo <<<END
                    <div class="form-group px-5 m-0 mb-5 d-flex flex-row justify-content-end no-print-this">
                    <button type="button" id="back" class="btn btn-danger btn-lg">Back</button>
                    </div>
                    END;
                    }
                    ?>

                </div>
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

    <script src="assets/jasonday-printThis-23be1f8/printThis.js"></script>

    <script>
        $("#print").click(function() {
            $("#main-body").printThis({
                base: "view-prisoner.php",
                importCSS: true,
                importStyle: true,
                loadCSS: "css/print_rules.css",
            });
        });
        var id = '<?php echo $pol_id ?>'
        var rank = '<?php echo $_SESSION['rank'] ?>'

        $('#btn').click(function() {
            window.location.href = 'edit-officer-form.php?id=' + id
        })

        $('#back').click(function() {
            window.location.href = 'officer-directory.php'
        })

        // document.getElementsByClassName('back').onclick = function() {
        //     window.location.href = 'officer-directory.php'
        // }
    </script>
    <script src="custom.js"></script>
    <script src="js_new/jquery.min.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>

</body>

</html>