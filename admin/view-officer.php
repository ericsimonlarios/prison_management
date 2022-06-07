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
            $pol_id = $_GET['id'];

            $selectQuery  =  " SELECT * FROM police WHERE police_id ='$pol_id'";
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
            }
        } else {
            header('location: officer-directory.php?status=Error&message=Page is not found');
            die();
        }
        ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h3 class="mb-5" style="text-align: center;">Officer Details</h3>
            <div class="appointment-form officer-view alert alert-secondary p-4" role="alert" action="">
                <div class="form-group inline mb-3">
                    <div class="form-group">
                        <img id="product_img_container" height="180px" width="180px" src="<?php echo $police_pic ?>" alt="">
                    </div>

                    <div class="form-group">
                        <label for="floatingInput">Status: <strong><?php echo $status; ?></strong></label><br>
                        <label for="floatingInput">Date Started: <strong><?php echo $started; ?></strong></label><br>
                        <label for="floatingInput">Badge no: <strong><?php echo $bno; ?></strong></label>
                    </div>
                </div>
                <div class="form-group inline mb-3">
                    <label for="floatingInput">Name: <strong><?php echo $fname . " " . $mname[0] . "." . " " . $lname; ?></strong></label>
                </div>
                <div class="form-group inline mb-3">
                    <label for="floatingInput">Rank: <strong><?php echo $rank; ?></strong></label>
                </div>
                <div class="form-group inline mb-3">
                    <label for="floatingInput">Contact no: <strong><?php echo $contact; ?></strong></label>
                </div>
                <div class="form-group inline mb-3">
                    <label for="floatingInput">Address: <strong><?php echo $address; ?></strong></label>
                </div>
                <button id="btn" class="btn btn-primary btn-lg btn-block">Edit</button>
                
            </div>

        </div>
    </div>
    <script>
        var id = '<?php echo $pol_id ?>'
        document.getElementById('btn').onclick = function(){
            window.location.href = 'edit-officer-form.php?id=' + id
        }
    </script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>