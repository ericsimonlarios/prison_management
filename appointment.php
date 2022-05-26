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
            Want to visit someone in ITECH Prison? <br><br> Alert the authorities and Set up an appointment now!
        </div>

    </div>
    <br>
    <div class="container">

        <div class="alert alert-info" role="alert">
            Note:
            <ul>
                <li>Visiting hours are only available from 8:00 AM to 5:00 PM </li>
                <li>You may see the result of your appointment request are your GMAIL</li>
                <li>Appointment results may take 1-2 days to approve</li>
                <li>Requesting an appointment to prisoners that already used up their monthly visitation capacity will be automatically declined</li>
                <li>Valid ID are required upon visiting the Detention Facility, failure to provide one will invalidate your appointment</li>
            </ul>
        </div>

        <br>
        <br>
        <h1 style="text-align: center;">Appointment Form</h1>
        <form class="appointment-form alert alert-secondary" role="alert" method="POST" action="actions.php">
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
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="vname">
                <label for="floatingInput">Enter Visitor's Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="vemail">
                <label for="floatingInput">Enter Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" maxlength="11" name="vcontact">
                <label for="floatingInput">Enter Contact no.</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="vadd">
                <label for="floatingInput">Enter Address</label>
            </div>

            <div class="form-group inline">
                <div class="form-floating mb-3 wd-45">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="pfirst">
                    <label for="floatingInput">Enter Prisoner's First Name</label>
                </div>
                <div class="form-floating mb-3 wd-45">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="plast">
                    <label for="floatingInput">Enter Prisoner's Last Name</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com" name="pdate">
                <label for="floatingInput">Choose Appointment Date</label>
            </div>
            <input type="submit" name="appointment-submit" class="btn btn-primary" style="margin:auto;" value="Request Appointment">
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>

</html>