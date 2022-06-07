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
    <title>ITECH PRISON</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/alter.css">
    <link rel="stylesheet" href="../temp.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    
    <div class="wrapper d-flex align-items-stretch">
        <?php
        include 'sidebar.php';
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
        <div id="content" class="p-4 p-md-5 pt-5">
            <h3 class="mb-5" style="text-align: center;">Appointment Details</h3>
            <div class="appointment-form alert alert-secondary" role="alert" action="">
                <div class="form-group inline mb-3">
                    <label for="floatingInput">Appointment Requestee: <strong><?php echo $vname; ?></strong></label>
                    <label for="floatingInput">Date Requested: <strong><?php echo $appointment_added; ?></strong></label>
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
                <div class="form-group inline mb-3">
                    <label for="floatingInput">Prisoner to be visited: <strong><?php echo $pfirst . " " . $plast; ?></strong> <a target="_blank" href="view-appointment.php?id=$app_id">View details</a></label>
                </div>
                <form action="actions.php" method="POST">
                    <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">
                    <input type="submit" name="appointment-submit" class="btn btn-success" style="margin:auto;" value="Approve">
                    <input type="submit" name="appointment-submit" class="btn btn-danger" style="margin:auto;" value="Decline">
            </div>

        </div>
    </div>

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>