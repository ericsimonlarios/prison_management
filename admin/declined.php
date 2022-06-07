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
    <title>Approved Appointment</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/alter.css">
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({

            });
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5 ">
            <?php
           
            $con = connect();
            $selectQuery  =  " SELECT * FROM appointment WHERE stats ='Declined'";
            $selectStmt = $con->query($selectQuery);
            if (!$selectStmt) {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
            $select_rows = $selectStmt->num_rows;
      

            echo <<< END
            <h3 class="mb-5" style="text-align: center;">Declined Appointments Request</h3>
            END;
            if ($select_rows == 0) {
                echo <<<END
            <div class="container block">
            <span style="font-size:20px;margin:auto;">No Declined Appointments</span>
            <i style="margin:auto;" class="fa-regular fa-face-sad-tear fa-10x mt-5"></i>
            </div>
            END;
            } else {

                echo <<<END
        <table id="table_id"  class="table table-bordered" style="text-align: center;">
        <thead class="thead-dark">
          <tr>
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
                        <td>$vname</td>
                        <td>$email</td>
                        <td>$pdate</td>
                        <td>$padded</td>
                        <td>$stats</td>
                        <td><a href="view-appointment.php?id=$app_id">View</a></td>
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

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>