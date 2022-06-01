<?php

include "../dbcon.php";

if (isset($_POST['appointment-submit'])) {
  $app_id = $_POST['app_id'];
  $decision = $_POST['appointment-submit'];
  if ($decision == "Approve") {
    $stats =  "Approved";
  } else {
    $stats =  "Declined";
  }
  $con = connect();
  $updateStatsQuery   = "UPDATE appointment SET stats = ? WHERE appointment_id = ?";
  $updateStatsStmt    = $con->prepare($updateStatsQuery);
  $updateStatsStmt->bind_param('si', $stats, $app_id);
  if (!$updateStatsStmt->execute()) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
  }
  $con->close();
  header('location: today-appointment.php?status=Success&message=Request Successfully ' .  $stats . "'");
  die();
}
if (isset($_POST['add_officer'])) {
  $fname          = trim($_POST['fName']);
  $mname          = trim($_POST['mName']);
  $lname          = trim($_POST['lName']);
  $rank           = trim($_POST['rank']);
  $bno            = trim($_POST['bno']);
  $address        = trim($_POST['address']);
  $contact        = trim($_POST['contact_no']);
  $police_pic     = trim(basename($_FILES['police_pic']['name']));
  $status         = trim($_POST['status']);
  $role           = 'police';

  if (empty($fname) || empty($mname) || empty($lname) || empty($rank) || empty($bno) || empty($address) || empty($police_pic) || empty($contact)) {
    header("location: add-officer-form.php?status=error&message=Should fill all input fields");
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $rank)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $bno) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $address)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $contact)
  ) {
    header('location: add-officer-form.php?status=error&message=Only alphanumeric characters are allowed');
    die();
  }

  if(checkOfficer($fname,$mname, $lname, $bno, 'add')){
    header('location: add-officer-form.php?status=error&message=Officer already exist in our directory');
    die();
  }

  $getPic = getPic($police_pic, $role, $lname, $bno, 'add');

  $con = connect();
  $selectQuery  = "SELECT * fROM officer";
  if (!$selectStmt = $con->query($selectQuery)) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  }
  $lastID = "";
  $selectRows = $selectStmt->num_rows;
  for ($i = 0; $selectRows > $i; ++$i) {
    $row = $selectStmt->fetch_array(MYSQLI_ASSOC);
    $lastID = htmlentities($row['officer_id']);
  }
  $lastID++;
  $policeQuery  = "INSERT into police (police_pic,first_name,middle_name,last_name,rank,badge_no,address,status,officer_id,contact_no) VALUES(?,?,?,?,?,?,?,?,?,?)";
  $policeStmt   = $con->prepare($policeQuery);
  $policeStmt->bind_param('ssssssssis', $getPic, $fname, $mname, $lname, $rank, $bno, $address, $status, $lastID,$contact);
  if (!$policeStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    $newID = $policeStmt -> insert_id;
    $policeQuery  = "INSERT into officer (officer_name,officer_pass,police_id) VALUES(?,?,?)";
    $policeStmt   = $con->prepare($policeQuery);
    $bno = password_hash($bno, PASSWORD_DEFAULT);
    $policeStmt->bind_param('ssi', $lname, $bno, $newID);
    if (!$policeStmt->execute()) {
      $error = $con->errno . " " . $con->error;
      echo $error;
    }else{
      header('location: add-officer-form.php?status=success&message=Officer added Succesfully');
      die();
    }
  }
}
if(isset($_POST['edit_officer'])){
  $pol_id         = ($_POST['id']);
  $fname          = trim($_POST['fName']);
  $mname          = trim($_POST['mName']);
  $lname          = trim($_POST['lName']);
  $rank           = trim($_POST['rank']);
  $bno            = trim($_POST['bno']);
  $address        = trim($_POST['address']);
  $contact        = trim($_POST['cont']);
  $police_pic     = "";
  if(empty(trim(basename($_FILES['police_pic']['name'])))){
    $police_pic     = trim($_POST['current_police_pic']);
  }else{
    $police_pic     = trim(basename($_FILES['police_pic']['name']));
  }
  $status         = trim($_POST['status']);
  $role           = 'police';

 
  if (empty($fname) || empty($mname) || empty($lname) || empty($rank) || empty($bno) || empty($address) || empty($contact)) {
    header("location: edit-officer.php?status=error&message=Should fill all input fields&id=". $pol_id);
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $rank)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $bno) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $address)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $contact)
  ) {
    header('location: edit-officer.php?status=error&message=Only alphanumeric characters are allowed&id='. $pol_id);
    die();
  }

  if(checkOfficer($fname,$mname, $lname, $bno, 'edit')){
    header('location: edit-officer.php?status=error&message=Officer already exist in our directory&id='. $pol_id);
    die();
  }

  $getPic = getPic($police_pic, $role, $lname, $bno, 'edit');

  $con = connect();
  $policeQuery  = "UPDATE police SET police_pic = ?,first_name = ?,middle_name = ? ,last_name = ?,rank = ?,badge_no = ?,address = ?,status = ?,contact_no = ? WHERE police_id = '$pol_id'";
  $policeStmt   = $con->prepare($policeQuery);
  $policeStmt->bind_param('sssssssss', $getPic, $fname, $mname, $lname, $rank, $bno, $address, $status,$contact);
  if (!$policeStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else{
    header('location: edit-officer.php?status=success&message=Officer added Succesfully&id='. $pol_id);
    die();
  }
}
function checkOfficer($fname,$mname,$lname,$bno, $url){
  $con = connect();
  $checkQuery = "SELECT * FROM police where first_name = '$fname' AND middle_name='$mname' AND last_name = '$lname' OR badge_no = '$bno'"  ;
  $checkStmt = $con->query($checkQuery); 
  if(!$checkStmt){
      $error = $con->errno . " " . $con->error;
      echo $error;
  }
  $checkRows = $checkStmt -> num_rows;
  if($url == 'edit'){
    if($checkRows > 1){
      return true;
   }else{
     return false;
   }
  }else{
    if($checkRows >= 1){
      return true;
   }else{
     return false;
   }
  }
  
  
}

function getPic($obj, $role, $lname, $bno, $url)
{
  $targetDir      = $role . '_pic/';
  $targetPath     = $targetDir;
  $filetype       = pathinfo($targetPath . $obj, PATHINFO_EXTENSION);
  $changePicName  = $targetPath . $bno . "-" . $lname . '.' . $filetype;
  $allowedTypes   =   array('jpg', 'jpeg', 'png', 'gif', 'tif');
  $fileName       = $role . '_pic';
  if (in_array($filetype, $allowedTypes)) {
    move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName);
  } else {
    header('location: ' . $url . 'add-officer-form.php?status=error&message=Only JPG, PNG, GIF, AND TIF extensions are allowed');
    die();
  }

  return $changePicName;
}
