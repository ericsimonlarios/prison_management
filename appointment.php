<?php
include "nav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="temp.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Appointment</title>
</head>

<body>
    <div class="img-appointment">

        <div class="floating-text">
            Want to visit someone in REFORM? <br><br> Alert the authorities and set up an Appointment now!
        </div>

    </div>
    <br>
    <div class="container">

        <div class="alert alert-info" role="alert">
            Note:
            <ul>
                <li>Visiting hours are only available from 8:00 AM to 5:00 PM </li>
                <li>You may see the result of your appointment request in your GMAIL</li>
                <li>Appointment results may take 1-2 days to approve</li>
                <li>Requesting an appointment to prisoners that already used up their monthly visitation capacity will be automatically declined</li>
                <li>Valid ID are required upon visiting the Detention Facility, failure to provide one will invalidate your appointment</li>
            </ul>
        </div>

        <br>
        <br>
        <h1 class="text-center">Appointment Form</h1>
            <?php
            if (isset($_GET['status'])) {
                $status  = $_GET['status'];
                $message = $_GET['message'];
                echo "<script>alert('$message')</script>";
                if ($status == 'success') {
                    echo <<<end
                        <div style="display:block;" class="alert alert-success alert-handler" role="alert">
                        $message
                        </div>
                       end;
                } else {
                    echo <<<end
                        <div style="display:block;" class="alert alert-danger alert-handler" role="alert">
                        $message
                        </div>
                       end;
                }
            }
            ?>
            <form class="appointment-form shadow p-5 bg-white rounded alert alert-dark mt-4" role="alert" method="POST" action="actions.php" style="width: 80%;  margin-left: auto; margin-right: auto;">

                <div class="form-group">
                      
                    <div class="form-group mb-3">
                        <label for="floatingInput">Visitor Name <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="vname" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="floatingInput">Email <span class="text-danger">(Required)</span></label>
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="vemail">
                    </div>

                    <div class="form-group mb-3">
                        <label for="floatingInput">Contact no. <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="Contact no." maxlength="11" name="vcontact" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="floatingInput">Address <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="Address" name="vadd" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="floatingInput">Inmate First Name <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="First Name" name="pfirst" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="floatingInput">Inmate Last Name <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="Last Name" name="plast" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="floatingInput">Relation <span class="text-danger">(Required)</span></label>
                        <input type="text" class="form-control" id="relation" placeholder="Relation" name="relation" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="floatingInput">Appointment Date <span class="text-danger">(Required)</span></label>
                        <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com" name="pdate" required>
                    </div>
                    <input type="hidden" value="not" name="rank">
                    <input type="hidden" id="type" name="type" value="add">

                </div>    
                
                <input type="submit" name="appointment-submit" class="btn btn-success" style="margin:auto;" value="Request Appointment">

            </form>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php
    include 'footer.php';
    ?>
</body>

</html>