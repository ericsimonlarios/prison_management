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
    <link href="css_new/custom.min.css" rel="stylesheet">
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
</head>

<body onload="checkInmate()" class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include 'sidebar.php'; ?>

            <?php
            if (isset($_GET['id'])) {
                $app_id = $_GET['id'];

                $selectQuery  =  " SELECT * FROM appointment WHERE appointment_id ='$app_id'";
                $selectStmt = $con->query($selectQuery);
                if (!$selectStmt) {
                    $error = $con->errno . ' ' . $con->error;
                    echo $error;
                }
                $select_rows = $selectStmt->num_rows;
                for ($i = 0; $select_rows > $i; ++$i) {
                    $select_row        =  $selectStmt->fetch_array(MYSQLI_ASSOC);
                    $vname             = htmlentities($select_row['vname']);
                    $vemail            = htmlentities($select_row['vemail']);
                    $vcontact          = htmlentities($select_row['vcontact']);
                    $vadd              = htmlentities($select_row['vadd']);
                    $pfirst            = htmlentities($select_row['pfirst']);
                    $plast             = htmlentities($select_row['plast']);
                    $pdate             = htmlentities($select_row['pdate']);
                    $appointment_added = htmlentities($select_row['appointment_added']);
                    $stats             = htmlentities($select_row['stats']);
                }
            } else {
                header('location: today-appointment.php?status=Error&message=Page is not found');
                die();
            }
            ?>


            <!-- Page Content  -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row col-12" style="display: inline-block;">
                    <div class="content-wrapper">

                        <div id="content" class=" pl-4 pr-4 pb-4">

                            <button class="btn float-left mb-4" id="back-button"><i class="fa fa-arrow-left"></i></button>
                            <div class="form-group text-center mb-4">
                                <h3 class="mb-4" style="text-align: center;">Appointment Details</h3>
                            </div>
                            <div class="appointment-form alert alert-secondary" role="alert" action="">
                                <div class="form-group inline mb-3">
                                    <label for="floatingInput">Appointment Requestee: <strong><?php echo $vname; ?></strong></label>
                                    <label for="floatingInput" class="float-right"> Date Requested: <strong><?php echo $appointment_added; ?></strong></label>
                                </div>
                                <div class="form-group inline mb-3">
                                    <label for="floatingInput">Appointment Status: <strong><?php echo $stats; ?></strong></label>
                                </div>
                                <div class="form-group inline mb-3">
                                    <label for="floatingInput">Email: <strong><?php echo $vemail; ?></strong></label>
                                </div>
                                <div class="form-group inline mb-3">
                                    <label for="floatingInput">Contact no: <strong><?php echo $vcontact; ?></strong></label>
                                </div>
                                <div class="form-group inline mb-3">
                                    <label for="floatingInput">Appointment Date: <strong><?php echo $pdate; ?></strong></label>
                                </div>
                                <div class="form-group inline mb-3">
                                    <label for="floatingInput">Address: <strong><?php echo $vadd; ?></strong></label>
                                </div>
                                <div id="checkIn" class="form-group inline mb-3">
                                    <form action="view-prisoner.php" id="redirectForm" method="POST">
                                        <input type="hidden" name="fname" value="<?php echo $pfirst ?>">
                                        <input type="hidden" name="lname" value="<?php echo $plast ?>">
                                        <label id="redirectLabel" for="floatingInput">Prisoner to be visited: <strong><?php echo $pfirst . " " . $plast; ?></strong><a type="submit" id="redirectIn" name="redirectIn" href="#"> <i class="fa fa-eye"></i></a>&nbsp<i class="text-success fa fa-check-"></i></label>
                                    </form>
                                </div>

                                <div class="form-group inline mb-3">
                                    <label for="floatingInput">Relation: <strong><?php echo $select_row['relation']; ?></strong></label>
                                </div>
                                <form action="actions.php" method="POST">
                                    <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">
                                    <input type="hidden" name="email" value="<?php echo $vemail; ?>">
                                    <input type="hidden" name="app_date" value="<?php echo $pdate; ?>">
                                    <input type="hidden" name="inname" value="<?php echo $pfirst . " " . $plast; ?>">
                                    <?php
                                    if ($stats == "Pending") {
                                        echo <<< END
                                <input type="submit" name="appointment-submit" class="btn btn-success" style="margin:auto;" value="Approve">
                                <input type="submit" name="appointment-submit" class="btn btn-danger" style="margin:auto;" value="Decline">
                                END;
                                    }
                                    ?>

                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <?php include "profile.php"; ?>

        </div>
        <footer>
            <div class="float-right">
                <strong>Copyright &copy; 2022 <a href="#">Prison Management</a>.</strong> All rights reserved.
            </div>
            <div class="clearfix"></div>
        </footer>
        <script src="js_new/jquery.min.js"></script>
        <script src="js_new/bootstrap.bundle.min.js"></script>
        <script src="js_new/custom.min.js"></script>
        <script>
            var fname = '<?php echo $pfirst ?>'
            var lname = '<?php echo $plast ?>'
            var stats = '<?php echo $stats ?>'
            $('#back-button').click(function() {
                if (stats == 'Pending') {
                    window.location.href = 'pending.php'
                } else if (stats == 'Approved') {
                    window.location.href = 'approved.php'
                } else if (stats == 'Declined') {
                    window.location.href = 'declined.php'
                }
            })

            function checkInmate() {

                var uri = "actions.php?checkIn=check&fname=" + fname + "&lname=" + lname
                var encodedURI = encodeURI(uri)
                var xml = new XMLHttpRequest()
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('redirectLabel').innerHTML = this.response
                    }
                }
                xml.open("GET", encodedURI, true)
                xml.send()
            }
        </script>
</body>

</html>