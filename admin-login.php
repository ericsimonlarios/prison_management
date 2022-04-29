<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITECH PRISON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container for-image">
        <!-- PHP SLIDE SHOW -->
    </div>
    <div class="container for-forms" id="login-form">
        <form class="form-1" action="login-form.php" method="POST">
            <div class="form-group">
                <h1 class="admin-form-heading" style="text-align:center;">Login Form</h1>
                <?php
                if(isset($_GET['status'])){
                    $status  = $_GET['status'];
                    $message = $_GET['message'];
                    if($status == 'success'){
                       echo <<<end
                        <div style="display:block;" class="alert alert-success alert-handler" role="alert">
                        $message
                        </div>
                       end;
                    }else{
                        echo <<<end
                        <div style="display:block;" class="alert alert-danger alert-handler" role="alert">
                        $message
                        </div>
                       end; 
                    }
                }
                ?>
                <label for="name">Username: </label>
                <input type="text" id="name" class="form-control" placeholder="Name" name="name"><br>
                <label for="password">Password: </label>
                <input type="password" id="password" class="form-control" placeholder="Password" name="pass"><br>
                <label for="ranking">Level of Authority:</label>
                <select id="ranking" class="form-control" name="rank">
                    <option value="" selected hidden>Choose...</option>
                    <option value="admin">Admin</option>
                    <option value="officer">Officer</option>
                </select><br><br>
                <input type="submit" class="form-control btn btn-outline-primary" value="Login" name="login-submit">
            </div>
        </form>
    </div>
</body>
<script src="index.js">

</script>

</html>