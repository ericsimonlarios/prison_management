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
    <div class="container for-forms">
        <form class="form-1" action="" method="GET">
            <h1>Login Form</h1>
            <div class="form-group">
            <label for="name">Police Name: </label>
            <input type="text" id="name" class="form-control" placeholder="Name"><br>
            <label for="password">Password: </label>                
                <input type="password" id="password" class="form-control" placeholder="Password"><br>
            <label for="rank-label">Level of Authority</label>
                <select name="rank" id="rank" class="form-control">
                    <option value="" selected hidden>...</option>
                    <option value="admin">Admin</option>
                    <option value="officer">Officer</option>
                    <option value="officer">Visitor</option>
                </select>   
                <br>
                <a href="https://www.google.com/" class="btn btn-primary">Forgot Password?</a>
                <a href="https://www.google.com/" class="btn btn-secondary">Don't have an Account?</a>
                <br> 
                <br>   
                <input type="submit" class="form-control btn btn-outline-primary" value="Login" >
            </div>
 
        </form>
    </div>
</body>
<script src="index.js">

</script>
</html>