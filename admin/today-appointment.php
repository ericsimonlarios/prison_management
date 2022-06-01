<?php
include "../dbcon.php";
session_start();
if (!isset($_SESSION['name'])) {
  header('location: ../temp.php');
}
?>
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

      echo <<< END
      <h3 class="mb-5" style="text-align: center;">Pending Appointment Request for Today</h3>
      END;
      if ($today_rows == 0) {
        echo <<<END
        <div class="container block">
        <span style="font-size:20px;margin:auto;">No Appointments for Today</span>
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

        for ($i = 0; $today_rows > $i; ++$i) {
          $row = $todayStmt->fetch_array(MYSQLI_ASSOC);
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