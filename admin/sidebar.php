
<!doctype html>
<html lang="en">

<head>
    <title>ITECH PRISON</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/alter.css">
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
</head>

<body>

    <!-- <div id="appointmentWrapper" class="wrapper d-flex align-items-stretch"> -->
        <?php
        $f1 = "00:00:00";
        $from = date('Y-m-d') . " " . $f1;
        $t1 = "23:59:59";
        $to = date('Y-m-d') . " " . $t1;

        $con = connect();
        $selectQuery  =  " SELECT * FROM appointment WHERE stats ='Pending'";
        $selectStmt = $con->query($selectQuery);
        if (!$selectStmt) {
            $error = $con->errno . ' ' . $con->error;
            echo $error;
        }
        $select_rows = $selectStmt->num_rows;

        $todayQuery  =  " SELECT * FROM appointment WHERE appointment_added BETWEEN '$from' AND '$to' AND stats ='Pending'";
        $todayStmt = $con->query($todayQuery);
        if (!$todayStmt) {
            $error = $con->errno . ' ' . $con->error;
            echo $error;
        }
        $today_rows = $todayStmt->num_rows;

        // $con = connect();
        // $approveQuery  =  " SELECT * FROM appointment WHERE stats ='Approved'";
        // $approveStmt = $con->query($selectQuery);
        // if (!$approveStmt) {
        //     $error = $con->errno . ' ' . $con->error;
        //     echo $error;
        // }
        // $approve_rows = $approveStmt->num_rows;

        ?>
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" data-toggle="collapse" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <h1><a href="index.html" class="logo">ITECH PRISON</a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-home mr-3 "></span>Appointments <span class="badge badge-danger"><?php echo $select_rows ?></span> <span class="dropdown-toggle mr-3"></span></a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="today-appointment.php">Today <span class="badge badge-danger"><?php echo $today_rows ?></span></a>
                        </li>
                        <li>
                            <a href="pending.php">Pending <span class="badge badge-danger"><?php echo $select_rows ?></span></a>
                        </li>
                        <li>
                            <a href="approved.php">Approved</a>
                        </li>
                        <li>
                            <a href="declined.php">Declined</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#officerSubmenu" data-toggle="collapse" aria-expanded="false"><span class="fa-solid fa-user mr-3"></span>Officers<span class="dropdown-toggle mr-3"></span></a>
                    <ul class="collapse list-unstyled" id="officerSubmenu">
                        <li>
                            <a href="officer-directory.php">Officer Directory</a>
                        </li>
                        <li>
                            <a href="add-officer-form.php">Add Officers</a>
                        </li>
                        <li>
                            <a href="removed-officer.php">Removed Officers</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#prisonerSubmenu" data-toggle="collapse" aria-expanded="false"><span class="fa fa-handcuffs mr-3 "></span>Prisoners<span class="dropdown-toggle mr-3"></span></a>
                    <ul class="collapse list-unstyled" id="prisonerSubmenu">
                        <li>
                            <a href="#">Prisoner Directory</a>
                        </li>
                        <li>
                            <a href="#">Add Prisoners</a>
                        </li>
                        <li>
                            <a href="#">Edit Prisoners</a>
                        </li>
                        <li>
                            <a href="#">Released Prisoners</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><span class="fa fa-gear mr-3"></span> Settings</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-paper-plane mr-3"></span>Logout</a>
                </li>
            </ul>
        </nav>
    <!-- </div> -->
</body>

</html>