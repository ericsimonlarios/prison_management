<?php
    include 'dbcon.php';
    if(isset($_POST['appointment-submit'])){
        $id=0;
        if(isset($_POST['app_id'])){
            $id = $_POST['app_id'];
        }
        $vname      = $_POST['vname'];
        $vemail     = $_POST['vemail'];
        $vcontact   = $_POST['vcontact'];
        $vadd       = $_POST['vadd'];
        $pfirst     = $_POST['pfirst'];
        $plast      = $_POST['plast'];
        $pdate      = $_POST['pdate'];
        $pdate      = $_POST['pdate'];
        $relation   = $_POST['relation'];
        $stats      = $_POST['status'];
        if(empty($stats)){
            $stats = "Pending";
        }
        $type = $_POST['type'];
        $url = "";
        
        if(isset($_POST['stats'])){
            $stats = $_POST['stats'];
        }
        if(empty($vname) || empty($vemail) || empty($vcontact) || empty($vadd) || empty($pfirst) || empty($plast) || empty($pdate) || empty($relation)){
            header("location: appointment.php?status=error&message=Should fill all input fields");
            die();
        }   
        if($type == "add"){
            $type = "add";
            if( $_POST['rank'] == 'admin'){
                $url = "admin/" .strtolower($stats);
            }else{
                $url = "appointment";
            }
            
        }if ($type == "edit"){
            
            $type = "edit";
            $url = "admin/" . strtolower($stats);
        }
        if(insertAppointment($id,$vname,$vemail,$vcontact,$vadd,$pfirst,$plast,$pdate,$stats,$relation,$type)){
            header('location:'. $url .'.php?status=success&message=Appointment Request Successful');
            die();
        }
        else{
            header('location: '. $url .'.php?status=failed&message=Appointment Request Failed');
            die();
        }
    }

    function insertAppointment($id,$vname,$vemail,$vcontact,$vadd,$pfirst,$plast,$pdate,$stats,$relation,$type){
        $vname = mysqlentities_fix_string($vname);
        $vemail = mysqlentities_fix_string($vemail);
        $vcontact = mysqlentities_fix_string($vcontact);
        $vadd = mysqlentities_fix_string($vadd);
        $pfirst = mysqlentities_fix_string($pfirst);
        $plast = mysqlentities_fix_string($plast);
        $relation = mysqlentities_fix_string($relation);
        $date =  date_create($pdate);
        $date =  date_format($date,"F d, Y");
        $con = connect();
        if($type == 'add'){
            $insertSQL = "INSERT into appointment (vname,vemail,vcontact,vadd,pfirst,plast,pdate,stats,relation) VALUES(?,?,?,?,?,?,?,?,?)";
        }else{
            $insertSQL = "UPDATE appointment SET vname=?,vemail=?,vcontact=?,vadd=?,pfirst=?,plast=?,pdate=?,stats=?,relation=? WHERE appointment_id='$id'";
        }
       
        $stmt = $con -> prepare($insertSQL);
        $stmt->bind_param('sssssssss',  $vname, $vemail, $vcontact, $vadd,$pfirst,$plast,$pdate,$stats,$relation);
        if(!$stmt->execute()){
            $error = $con->errno . " " . $con->error;
            echo $error;
        }
        if ($stats == "Approved") {
            $dest = $vemail;
            $subjetc = "Appointment Request";
            $body = "Your appointment Request to Inmate " . $pfirst . " ". $plast . " on " . $date . " has been Approved.";
            $headers = "From: reformpims@gmail.com";
            if (mail($dest, $subjetc, $body, $headers)) {
              echo "Email successfully sent to $dest ...";
            } else {
              echo "Failed to send email...";
            }
          }else if ($stats == "Declined" ){
            $dest = $vemail;
            $subjetc = "Appointment Request";
            $body = "Your appointment Request to Inmate " . $pfirst . " ". $plast . " on " . $date . " has been Declined.";
            $headers = "From: reformpims@gmail.com";
            if (mail($dest, $subjetc, $body, $headers)) {
              echo "Email successfully sent to $dest ...";
            } else {
              echo "Failed to send email...";
            }
          }
        return true;
    }
    function mysqlentities_fix_string($string){
        $string = strip_tags($string);
        return  htmlentities($string);
    }