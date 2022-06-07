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
    <title>Officer Directory</title>
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
            $selectQuery  =  " SELECT * FROM police";
            $selectStmt = $con->query($selectQuery);
            if (!$selectStmt) {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
            $select_rows = $selectStmt->num_rows;
      

            echo <<< END
            <h3 class="mb-5" style="text-align: center;">Officer Directory</h3>
            END;
            if ($select_rows == 0) {
                echo <<<END
            <div class="container block">
            <span style="font-size:20px;margin:auto;">No Officers in the directory yet...</span>
            <i style="margin:auto;" class="fa-regular fa-face-sad-tear fa-10x mt-5"></i>
            </div>
            END;
            } else {

                echo <<<END
        <table id="table_id"  class="table table-bordered" style="text-align: center;">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Officer</th>
            <th scope="col">Rank</th>
            <th scope="col">Badge no.</th>
            <th scope="col">Date Employed</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
      END;

                for ($i = 0; $select_rows > $i; ++$i) {
                    $row = $selectStmt->fetch_array(MYSQLI_ASSOC);
                    $pol_id = htmlentities($row['police_id']);
                    $pol_pic = htmlentities($row['police_pic']);
                    $fname  = htmlentities($row['first_name']);
                    $lname  = htmlentities($row['last_name']);
                    $mname  = htmlentities($row['middle_name']);
                    $rank  = htmlentities($row['rank']);
                    $bno  = htmlentities($row['badge_no']);
                    $address  = htmlentities($row['address']);
                    $started = htmlentities($row['date_started']);
                    $status = htmlentities($row['status']);

                    echo <<<  END
        <tr>
        <td>$fname $lname </td>
        <td>$rank</td>
        <td>$bno</td>
        <td>$started</td>
        <td>$status</td>
        <td><a href="view-officer.php?id=$pol_id">View</a> | <a href="edit-officer-form.php?id=$pol_id">Edit</a></td>
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