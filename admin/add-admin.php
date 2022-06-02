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
    <title>Settings</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../temp.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/alter.css">
    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">

</head>

<body>

    <div class="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="content" class="p-4 p-md-5 pt-5 ">
            <h3 class="mb-5" style="text-align: center;">Settings</h3>
            <?php
            if (isset($_GET['status'])) {
                $status  = $_GET['status'];
                $message = $_GET['message'];
                echo "<script>alert('$message')</script>";
                if ($status == 'success') {
                    echo <<<end
                        <div style="display:block;" class=" alert alert-success alert-handler mb-3" role="alert">
                        $message
                        </div>
                       end;
                } else {
                    echo <<<end
                        <div style="display:block;" class=" alert alert-danger alert-handler mb-3" role="alert">
                        $message
                        </div>
                       end;
                }
            }

            ?>

            <form class="form alert alert-secondary" role="alert" method="POST" enctype="multipart/form-data" action="actions.php">
                <div class="row">
                    <div class="form-group col">
                        <label for="fName">Admin Name</label>
                        <input type="text" class="form-control" id="fName" name="admin_name" >
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="lName">Password</label>
                        <input type="password" class="form-control" id="lName" name="pass">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="rank">Confirm Password</label>
                        <input type="password" class="form-control" id="rank" name="conf_pass">
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="form-group col-4">
                        <input type="submit" class="btn btn-success btn-lg btn-block" id="add" name="add_admin" value="Create New Admin">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>