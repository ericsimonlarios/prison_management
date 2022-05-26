<?php 
include 'dbcon.php';
if(isset($_POST['login-submit'])){
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $rank = $_POST['rank'];

    if(empty($name) || empty($pass) || empty($rank)){
        echo  "Please populate all fields";
        header("location: admin-login.php?status=error&message=Should fill all input fields");
        die();
    }
    
    if(!preg_match("/^[a-zA-Z0-9]*$/", $name) || !preg_match("/^[a-zA-Z0-9]*$/", $pass)) {
        header('location: admin-login.php?status=error&message=Only alphanumeric characters are allowed');
        die();
    }

    if(checkUser($name,$pass,$rank)){
        header('location: admin/today-appointment.php?status=success&message=Login is Success');
        die();
    }else{
        header('location: admin-login.php?status=failed&message=The account you entered does not exist');
        die();
    }
}

function checkUser($name,$pass,$rank){

    $con        = connect();
    $name       = mysql_entities_fix_string($name);
    $pass       = mysql_entities_fix_string($pass);

    $admin      = "admin";
    $adminpass  = password_hash("admin", PASSWORD_DEFAULT);

    $officer      = "Jeff";
    $officerpass  = password_hash("jeff", PASSWORD_DEFAULT);

    $getAdminQuery ="";

    $getAdminQuery = "SELECT * FROM $rank";   
  
    $stmt = $con->query($getAdminQuery); 
    if(!$stmt){
        $error = $con->errno . " " . $con->error;
        echo $error;
    }

    $rows = $stmt->num_rows;

    if($rows == 0){
        if($rank == "admin"){
            $insertQuery = "INSERT INTO admin (admin_name, admin_pass) VALUES(?,?)";
            $insertStmt = $con -> prepare($insertQuery);
            $insertStmt -> bind_param("ss", $admin, $adminpass);  
            if(!$insertStmt -> execute()){
                $error = $con->errno . " " . $con->error;
                echo $error;
            }
        }
        else if($rank == "officer"){
            $insertQuery = "INSERT INTO officer (officer_name, officer_pass) VALUES(?,?)";
            $insertStmt = $con -> prepare($insertQuery);
            $insertStmt -> bind_param("ss", $officer, $officerpass);  
            if(!$insertStmt -> execute()){
                $error = $con->errno . " " . $con->error;
                echo $error;
            }
        }
        header("location: admin-login.php");
        die();
    }

    $checkUsername = "SELECT * FROM $rank where $rank" . "_name = '$name'" ;
    $checkStmt = $con->query($checkUsername); 
    if(!$checkStmt){
        $error = $con->errno . " " . $con->error;
        echo $error;
    }
    $checkRows = $checkStmt -> num_rows;

    if($checkRows == 1){
        for($i=0; $checkRows > $i; ++$i){
            $getRow     = $checkStmt ->  fetch_array(MYSQLI_ASSOC);
            $getname    = htmlspecialchars($getRow[$rank . '_name']);
            $getpass    = htmlspecialchars($getRow[$rank . '_pass']);
            $getId      = htmlspecialchars($getRow[$rank . '_id']);
        }

        if(password_verify($pass, $getpass)){
            session_start();
            $_SESSION['start']  = time();
            $_SESSION['id']     = $getId;
            $_SESSION['name']   = $getname;
            $_SESSION['rank']   = $rank; 
            $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);

            $con->close();
            return true;
        }else{
            $con->close();
            return false;
        }
    }else{
        $con->close();
        return false;
    }
   
}

function mysql_entities_fix_string($string)
{
    $string = strip_tags($string); // strips any html tags
    return htmlentities($string);
}