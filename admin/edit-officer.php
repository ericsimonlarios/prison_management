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
    <title>Edit Officers</title>
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
            <h3 class="mb-5" style="text-align: center;">Add Officer</h3>
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
                    $mname             = htmlentities($select_row['middle_name']);
                    $lname             = htmlentities($select_row['last_name']);
                    $rank              = htmlentities($select_row['rank']);
                    $bno               = htmlentities($select_row['badge_no']);
                    $address           = htmlentities($select_row['address']);
                    $started           = htmlentities($select_row['date_started']);
                    $status            = htmlentities($select_row['status']);
                    $police_pic        = htmlentities($select_row['police_pic']);
                    $contact           = htmlentities($select_row['contact_no']);
                }
                echo <<<END
                    <form class="form alert alert-secondary" role="alert" method="POST" enctype="multipart/form-data" action="actions.php">
                    <div class="row">
                        <div class="form-group col">
                            <label for="fName">First Name</label>
                            <input type="text" class="form-control" id="fName" name="fName" value='$fname'>
                        </div>
                        <div class="form-group col">
                            <label for="mName">Middle Name</label>
                            <input type="text" class="form-control" id="mName" name="mName" value='$mname'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="lName">Last Name</label>
                            <input type="text" class="form-control" id="lName" name="lName" value='$lname'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="rank">Rank</label>
                            <input type="text" class="form-control" id="rank" name="rank" value='$rank'>
                        </div>
                        <div class="form-group col">
                            <label for="bno">Badge no.</label>
                            <input type="text" class="form-control" id="bno" name="bno" value='$bno' maxlength="6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value='$address'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="cont">Contact no.</label>
                            <input type="text" class="form-control" id="cont" name="cont" value='$contact'">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="cont">Status</label>
                            <select class="form-select" id="cont" name="status" value='$status'">
                            <option value="$status" selected hidden>$status</option>
                            <option value="Employed">Employed</option>
                            <option value="Removed">Removed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="police_pic">Add a picture <span style="color:red;">(Leave blank if there are no changes)</span></label>
                            <br>
                            <input type="file" id="police_pic" name="police_pic" >
                            <br>
                            <br>
                            <span><strong>Preview :</strong></span>
                            <br>
                            <img id="product_img_container" height="150px" width="150px" src="$police_pic" alt="">
                            <input type="hidden" value="$police_pic" name="current_police_pic">
                        </div>
                    </div>
                    <input type="hidden" value="$pol_id" name="id">
                    <div class="row mt-3">
                        <div class="form-group col-4">     
                            <input type="submit" class="btn btn-outline-success btn-lg btn-block" id="add" name="edit_officer" value="Edit Officer">
                        </div>
                    </div>                
                </form>
                END;
            } else {
                header('location: officer-directory.php?status=Error&message=Page is not found');
                die();
            }
            ?>
            
            
        </div>
    </div>

    <script>
        var product_img = document.getElementById('police_pic');
        product_img.onchange = function(event) {
            const [file] = product_img.files
            if (file) {
                document.getElementById('product_img_container').src = URL.createObjectURL(file);
            }
        }
    </script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
