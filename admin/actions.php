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
  $contact        = trim($_POST['cont']);
  $police_pic     = trim(basename($_FILES['police_pic']['name']));
  $status         = trim($_POST['status']);
  $role           = 'police';
  $username       = $bno . "-" . $lname;
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

  if (checkOfficer($fname, $mname, $lname, $bno, 'add', $role)) {
    header('location: add-officer-form.php?status=error&message=Officer already exist in our directory');
    die();
  }

  $getPic = getPic($police_pic, $role, $lname, $bno, 'add', 'na');

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
  $policeStmt->bind_param('ssssssssis', $getPic, $fname, $mname, $lname, $rank, $bno, $address, $status, $lastID, $contact);
  if (!$policeStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    $newID = $policeStmt->insert_id;
    $policeQuery  = "INSERT into officer (officer_name,officer_pass,police_id) VALUES(?,?,?)";
    $policeStmt   = $con->prepare($policeQuery);
    $bno = password_hash($bno, PASSWORD_DEFAULT);
    $policeStmt->bind_param('ssi', $username, $bno, $newID);
    if (!$policeStmt->execute()) {
      $error = $con->errno . " " . $con->error;
      echo $error;
    } else {
      header('location: add-officer-form.php?status=success&message=Officer added Succesfully');
      die();
    }
  }
}
if (isset($_POST['edit_officer'])) {
  $pol_id         = ($_POST['id']);
  $fname          = trim($_POST['fName']);
  $mname          = trim($_POST['mName']);
  $lname          = trim($_POST['lName']);
  $rank           = trim($_POST['rank']);
  $bno            = trim($_POST['bno']);
  $address        = trim($_POST['address']);
  $contact        = trim($_POST['cont']);
  $police_pic     = "";
  $oldname        = $_POST['oldname'];
  if (empty(trim(basename($_FILES['police_pic']['name'])))) {
    $police_pic     = trim($_POST['current_police_pic']);
  } else {
    $police_pic     = trim(basename($_FILES['police_pic']['name']));
  }
  $status         = trim($_POST['status']);
  $role           = 'police';


  if (empty($fname) || empty($mname) || empty($lname) || empty($rank) || empty($bno) || empty($address) || empty($contact)) {
    header("location: edit-officer-form.php?status=error&message=Should fill all input fields&id=" . $pol_id);
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $rank)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $bno) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $address)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $contact)
  ) {
    header('location: edit-officer-form.php?status=error&message=Only alphanumeric characters are allowed&id=' . $pol_id);
    die();
  }

  if (checkOfficer($fname, $mname, $lname, $bno, 'edit', $role)) {
    header('location: edit-officer-form.php?status=error&message=Officer already exist in our directory&id=' . $pol_id);
    die();
  }

  $getPic = getPic($police_pic, $role, $lname, $bno, 'edit', $oldname);

  $con = connect();
  $policeQuery  = "UPDATE police SET police_pic = ?,first_name = ?,middle_name = ? ,last_name = ?,rank = ?,badge_no = ?,address = ?,status = ?,contact_no = ? WHERE police_id = '$pol_id'";
  $policeStmt   = $con->prepare($policeQuery);
  $policeStmt->bind_param('sssssssss', $getPic, $fname, $mname, $lname, $rank, $bno, $address, $status, $contact);
  if (!$policeStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    header('location: edit-officer-form.php?status=success&message=Officer added Succesfully&id=' . $pol_id);
    die();
  }
}

if (isset($_POST['add_prisoner'])) {
  $fname          = trim($_POST['fName']);
  $mname          = trim($_POST['mName']);
  $lname          = trim($_POST['lName']);
  $crime          = trim($_POST['crime']);
  $sentence       = trim($_POST['sentence']);
  $address        = trim($_POST['address']);
  $ddate          = trim($_POST['ddate']);
  $pdate          = trim($_POST['pdate']);
  $prisoner_pic   = trim(basename($_FILES['prisoner_pic']['name']));
  $status         = trim($_POST['status']);
  $remark         = $_POST['remark'];
  $role           = 'prisoner';

  if (empty($fname) || empty($mname) || empty($lname) || empty($crime) || empty($sentence) || empty($address) || empty($prisoner_pic)) {
    header("location: add-prisoner-form.php?status=error&message=Should fill all input fields");
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname)
  ) {
    header('location: add-prisoner-form.php?status=error&message=Only alphanumeric characters are allowed');
    die();
  }

  if (checkOfficer($fname, $mname, $lname, 'nibba', 'add', $role)) {
    header('location: add-prisoner-form.php?status=error&message=Officer already exist in our directory');
    die();
  }

  $getPic = getPic($prisoner_pic, $role, $lname, $mname, 'add', "na");

  $con = connect();

  $prisonerQuery  = "INSERT into prisoner (prisoner_pic,first_name,middle_name,last_name,crime,sentence,address,parole_date,discharge_date, remarks, status) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
  $prisonerStmt   = $con->prepare($prisonerQuery);
  $prisonerStmt->bind_param('sssssssssss', $getPic, $fname, $mname, $lname, $crime, $sentence, $address, $pdate, $ddate, $remark, $status);
  if (!$prisonerStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {

    header('location: add-prisoner-form.php?status=success&message=Prisoner added Succesfully');
    die();
  }
}

if (isset($_POST['edit_prisoner'])) {
  $prisoner_id    = $_POST['id'];
  $fname          = trim($_POST['fName']);
  $mname          = trim($_POST['mName']);
  $lname          = trim($_POST['lName']);
  $crime          = trim($_POST['crime']);
  $sentence       = trim($_POST['sentence']);
  $address        = trim($_POST['address']);
  $ddate          = trim($_POST['ddate']);
  $pdate          = trim($_POST['pdate']);
  $status         = trim($_POST['status']);
  $remark         = $_POST['remark'];
  $role           = 'prisoner';
  $prisoner_pic     = "";
  $oldname = $_POST['oldname'];
  if (empty(trim(basename($_FILES['prisoner_pic']['name'])))) {
    $prisoner_pic     = trim($_POST['current_prisoner_pic']);
  } else {
    $prisoner_pic     = trim(basename($_FILES['prisoner_pic']['name']));
  }

  if (empty($fname) || empty($mname) || empty($lname) || empty($crime) || empty($sentence) || empty($address) || empty($prisoner_pic)) {
    header("location: edit-prisoner-form.php?status=error&message=Should fill all input fields&id=" . $prisoner_id);
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname)
  ) {
    header('location: edit-prisoner-form.php?status=error&message=Only alphanumeric characters are allowed&id=' . $prisoner_id);
    die();
  }

  if (checkOfficer($fname, $mname, $lname, 'nibba', 'edit', $role)) {
    header('location: edit-prisoner-form.php?status=error&message=Officer already exist in our directory&id=' . $prisoner_id);
    die();
  }

  $getPic = getPic($prisoner_pic, $role, $lname, $mname, 'edit', $oldname);

  $con = connect();
  $prisonerQuery  = "UPDATE prisoner SET prisoner_pic = ?,first_name = ?,middle_name = ? ,last_name = ?,crime = ?,sentence = ?,address = ?,status = ?,discharge_date = ?,parole_date = ?,remarks = ? WHERE prisoner_id = '$prisoner_id'";
  $prisonerStmt   = $con->prepare($prisonerQuery);
  $prisonerStmt->bind_param('sssssssssss', $getPic, $fname, $mname, $lname, $crime, $sentence, $address, $status, $ddate, $pdate, $remark);
  if (!$prisonerStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    header('location: edit-prisoner-form.php?status=success&message=Officer added Succesfully&id=' . $prisoner_id);
    die();
  }
}

if (isset($_POST['edit_admin'])) {
  $admin_id   = $_POST['id'];
  $admin_name = trim($_POST['admin_name']);
  $old_pass   = trim($_POST['old_pass']);
  $new_pass   = trim($_POST['new_pass']);
  $conf_pass  = trim($_POST['conf_pass']);
  $role       = $_POST['role'];
 
  if (empty($admin_name) || empty($old_pass) || empty($new_pass) || empty($conf_pass)) {
    header("location: " . $role . "-setting.php?status=error&message=Should fill all input fields&id=" . $admin_id);
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\-\s\/]*$/", $admin_name) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $old_pass)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $new_pass) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $conf_pass)
  ) {
    header('location: ' . $role . '-setting.php?status=error&message=Only alphanumeric characters are allowed&id=' . $admin_id);
    die();
  }

  if($new_pass != $conf_pass){
    header('location: ' . $role . '-setting.php?status=error&message=Confirm pass and New pass does not match&id=' . $admin_id);
    die();
  }
  $con = connect();
  if($role == 'admin'){
    $checkUsername = "SELECT * FROM admin where admin_id = '$admin_id'";
    $adminQuery  = "UPDATE admin SET admin_name = ?,admin_pass = ? WHERE admin_id = '$admin_id'";
  }else{
    $checkUsername = "SELECT * FROM officer where officer_id = '$admin_id'";
    $adminQuery  = "UPDATE officer SET officer_name = ?,officer_pass = ? WHERE officer_id = '$admin_id'";
  }
  
  $checkStmt = $con->query($checkUsername);
  if (!$checkStmt) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  }
  $checkRows = $checkStmt->num_rows;
  // if ($checkRows >= 1) {
  //   header('location: admin-setting.php?status=error&message=Admin already exist in our directory&id=' . $admin_id);
  //   die();
  // }
  for ($i = 0; $checkRows > $i; ++$i) {
    $getRow     = $checkStmt->fetch_array(MYSQLI_ASSOC);
    $getname    = htmlspecialchars($getRow[$role . '_name']);
    $getpass    = htmlspecialchars($getRow[$role . '_pass']);
  }
  // echo $old_pass;

  // die();
  if (!password_verify($old_pass, $getpass)) {
    header('location: ' . $role . '-setting.php?status=error&message=Old password does not match&id=' . $admin_id);
    die();
  }else{
    $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
  }
 
  $adminStmt   = $con->prepare($adminQuery);
  $adminStmt->bind_param('ss', $admin_name, $new_pass);
  if (!$adminStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    header('location: ' . $role . '-setting.php?status=success&message=' . $role . ' edited Succesfully&id=' . $admin_id);
    die();
  }
}

if(isset($_POST['redirect_admin'])){
  header('location: add-admin.php');
  die();
}

if(isset($_POST['add_admin'])){
  $admin_name = trim($_POST['admin_name']);
  $pass       = trim($_POST['pass']);
  $conf_pass  = trim($_POST['conf_pass']);

  if (empty($admin_name) || empty($pass) ) {
    header("location: add-admin.php?status=error&message=Should fill all input fields");
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $admin_name) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $pass)
  ) {
    header('location: add-admin.php?status=error&message=Only alphanumeric characters are allowed');
    die();
  }

  if($pass != $conf_pass){
    header('location: add-admin.php?status=error&message=Confirm pass and New pass does not match');
    die();
  }
  $con = connect();
  $checkUsername = "SELECT * FROM admin where admin_name = '$admin_name'";
  $checkStmt = $con->query($checkUsername);
  if (!$checkStmt) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  }
  $checkRows = $checkStmt->num_rows;
  if ($checkRows == 1) {
    header('location: add-admin.php?status=error&message=Admin already exist in our directory');
    die();
  }
  $pass = password_hash($pass, PASSWORD_DEFAULT);
  $insertQuery = "INSERT INTO admin (admin_name,admin_pass) VALUES (?,?)";
  $insertStmt  = $con->prepare($insertQuery);
  $insertStmt -> bind_param('ss', $admin_name, $pass);
  if (!$insertStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    header('location: add-admin.php?status=success&message=Admin added Succesfully');
    die();
  }

}
function checkOfficer($fname, $mname, $lname, $bno, $url, $role)
{
  $con = connect();
  $checkQuery = "";
  if ($role == 'police') {
    $checkQuery = "SELECT * FROM $role where first_name = '$fname' AND middle_name='$mname' AND last_name = '$lname' OR badge_no = '$bno'";
  } else {
    $checkQuery = "SELECT * FROM $role where first_name = '$fname' AND middle_name='$mname' AND last_name = '$lname'";
  }
  $checkStmt = $con->query($checkQuery);
  if (!$checkStmt) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  }
  $checkRows = $checkStmt->num_rows;
  if ($url == 'edit') {
    if ($checkRows > 1) {
      return true;
    } else {
      return false;
    }
  } else {
    if ($checkRows >= 1) {
      return true;
    } else {
      return false;
    }
  }
}

function getPic($obj, $role, $lname, $bno, $url, $oldname)
{
  $targetDir      = $role . '_pic/';
  $targetPath     = $targetDir;
  $filetype       = pathinfo($targetPath . $obj, PATHINFO_EXTENSION);
  $changePicName  = $targetPath . $bno . "-" . $lname . '.' . $filetype;
  $allowedTypes   =   array('jpg', 'jpeg', 'png', 'gif', 'tif');
  $fileName       = $role . '_pic';

  if (in_array($filetype, $allowedTypes)) {
    if ($url == 'add') {
      move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName);
    } else {
      if ($oldname !=  $changePicName) {
        rename($oldname, $changePicName);
        // move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName); 
        echo $oldname;
      } else {
        move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName);
      }
    }
  } else {
    if ($role == 'police') {
      header('location: ' . $url . '-officer-form.php?status=error&message=Only JPG, PNG, GIF, AND TIF extensions are allowed');
      die();
    } else {
      header('location: ' . $url . '-prisoner-form.php?status=error&message=Only JPG, PNG, GIF, AND TIF extensions are allowed');
      die();
    }
  }
  // die();
  return $changePicName;
}
