<?php
    include 'dbcon.php';
    if(isset($_POST['appointment-submit'])){
        $vname      = $_POST['vname'];
        $vemail     = $_POST['vemail'];
        $vcontact   = $_POST['vcontact'];
        $vadd       = $_POST['vadd'];
        $pfirst     = $_POST['pfirst'];
        $plast      = $_POST['plast'];
        $pdate      = $_POST['pdate'];
        
        if(empty($vname) || empty($vemail) || empty($vcontact) || empty($vadd) || empty($pfirst) || empty($plast) || empty($pdate)){
            echo  "Please populate all fields";
            header("location: appointment.php?status=error&message=Should fill all input fields");
            die();
        }   
        
        if(insertAppointment($vname,$vemail,$vcontact,$vadd,$pfirst,$plast,$pdate)){
            header('location: appointment.php?status=success&message=Appointment Request Successful');
            die();
        }else{
            header('location: appointment.php?status=failed&message=Appointment Request Failed');
            die();
        }
    }

    function insertAppointment($vname,$vemail,$vcontact,$vadd,$pfirst,$plast,$pdate){
        $vname = mysqlentities_fix_string($vname);
        $vemail = mysqlentities_fix_string($vemail);
        $vcontact = mysqlentities_fix_string($vcontact);
        $vadd = mysqlentities_fix_string($vadd);
        $pfirst = mysqlentities_fix_string($pfirst);
        $plast = mysqlentities_fix_string($plast);

        $con = connect();
        $insertSQL = "INSERT into appointment (vname,vemail,vcontact,vadd,pfirst,plast,pdate) VALUES(?,?,?,?,?,?,?)";
        $stmt = $con -> prepare($insertSQL);
        $stmt->bind_param('sssssss',  $vname, $vemail, $vcontact, $vadd,$pfirst,$plast,$pdate);
        if(!$stmt->execute()){
            $error = $con->errno . " " . $con->error;
            echo $error;
        }
        return true;
    }
    function mysqlentities_fix_string($string){
        $string = strip_tags($string);
        return  htmlentities($string);
    }