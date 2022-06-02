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
    <title>Add Prisoner</title>
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
            <h3 class="mb-5" style="text-align: center;">Add Prisoner</h3>
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
                        <label for="fName">First Name</label>
                        <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name">
                    </div>
                    <div class="form-group col">
                        <label for="mName">Middle Name</label>
                        <input type="text" class="form-control" id="mName" name="mName" placeholder="Middle Name">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="lName">Last Name</label>
                        <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="rank">Crime Convicted</label>
                        <input type="text" class="form-control" id="rank" name="crime" placeholder="Crime">
                    </div>
                    <div class="form-group col">
                        <label for="bno">Sentence Ordered</label>
                        <input type="text" class="form-control" id="bno" name="sentence" placeholder="Sentence">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="cont">Discharge Date</label>
                        <input type="date" class="form-control" id="cont" name="ddate" placeholder="discharge">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="cont">Parole Date</label>
                        <input type="date" class="form-control" id="cont" name="pdate" placeholder="Parole Date">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="Jailed" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="police_pic">Add a picture</label>
                        <br>
                        <input type="file" id="police_pic" name="prisoner_pic">
                        <br>
                        <br>
                        <span><strong>Preview :</strong></span>
                        <br>
                        <img id="product_img_container" height="150px" width="150px" src="../placeholder-image.png" alt="">
                    </div>
                </div>
                <div class="form-group purple-border">
                    <label for="exampleFormControlTextarea4">Remarks</label>
                    <br>
                    <textarea class="text" id="exampleFormControlTextarea4" name="remark" rows="5"></textarea>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-4">
                        <input type="submit" class="btn btn-outline-success btn-lg btn-block" id="add" name="add_prisoner" value="Add Prisoner">
                    </div>
                </div>
            </form>
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