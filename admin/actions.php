<?php

include "../dbcon.php";
session_start();
 

if (isset($_POST['appointment-submit'])) {
  $app_id = $_POST['app_id'];
  $decision = $_POST['appointment-submit'];
  $email = $_POST['email'];
  $appdate = $_POST['app_date'];
  $inname = $_POST['inname'];
  $date =  date_create($appdate);
  $date =  date_format($date,"F d, Y");
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
  if ($decision == "Approve") {
    $dest = $email;
    $subjetc = "Appointment Request";
    $body = "Your appointment Request to Inmate " . $inname . " on " . $date . " has been Approved.";
    $headers = "From: reformpims@gmail.com";
    if (mail($dest, $subjetc, $body, $headers)) {
      echo "Email successfully sent to $dest ...";
    } else {
      echo "Failed to send email...";
    }
  }else{
    $dest = $email;
    $subjetc = "Appointment Request";
    $body = "Your appointment Request to Inmate " . $inname . " on " . $date . " has been Declined.";
    $headers = "From: reformpims@gmail.com";
    if (mail($dest, $subjetc, $body, $headers)) {
      echo "Email successfully sent to $dest ...";
    } else {
      echo "Failed to send email...";
    }
  }
  $con->close();
  header('location: pending.php?status=Success&message=Request Successfully ' .  $stats . "'");
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
  $username       = trim($_POST['uname']);
  $pass           = trim($_POST['pass']);
  $sex            = trim($_POST['sex']);
  $role           = 'police';
  if (empty($fname) || empty($mname) || empty($lname) || empty($rank) || empty($bno) || empty($address) || empty($police_pic) || empty($contact)) {
    header("location: add-officer-form.php?status=error&message=Should fill all input fields");
    die();
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $rank)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $bno) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $contact)
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
  $policeQuery  = "INSERT into police (police_pic,first_name,middle_name,last_name,rank,badge_no,address,status,officer_id,contact_no, officer_sex) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
  $policeStmt   = $con->prepare($policeQuery);
  $policeStmt->bind_param('ssssssssiss', $getPic, $fname, $mname, $lname, $rank, $bno, $address, $status, $lastID, $contact, $sex);
  if (!$policeStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    $newID = $policeStmt->insert_id;
    $policeQuery  = "INSERT into officer (officer_name,officer_pass,police_id) VALUES(?,?,?)";
    $policeStmt   = $con->prepare($policeQuery);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $policeStmt->bind_param('ssi', $username, $pass, $newID);
    if (!$policeStmt->execute()) {
      $error = $con->errno . " " . $con->error;
      echo $error;
    } else {
      header('location: officer-directory.php?status=success&message=Officer added Succesfully');
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
  $sex        = trim($_POST['sex']);
  $police_pic     = "";
  $oldname        = $_POST['oldname'];
  $username =     trim($_POST['uname']);
  if (!empty($_POST['pass']) && !empty($_POST['oldpass'])) {
    $pass =         trim($_POST['pass']);
    $oldpass =         trim($_POST['oldpass']);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
  }
  if (empty(trim(basename($_FILES['police_pic']['name'])))) {
    $police_pic     = trim($_POST['current_police_pic']);
  } else {
    $police_pic     = trim(basename($_FILES['police_pic']['name']));
  }
  $status         = trim($_POST['status']);
  $role           = 'police';

  $con = connect();
  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $rank)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $bno) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $contact)
  ) {
    header('location: edit-officer-form.php?status=error&message=Only alphanumeric characters are allowed&id=' . $pol_id);
    die();
  }

  $checkUsername = "SELECT * FROM officer";
  $checkStmt = $con->query($checkUsername);
  if (!$checkStmt) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  }
  $checkRows = $checkStmt->num_rows;
  $rows = $checkStmt->fetch_all(MYSQLI_ASSOC);
  foreach ($rows as $row) {
  }
  if (empty($_POST['pass']) && !empty($_POST['oldpass'])) {
    header('location: edit-officer-form.php?status=error&message=Enter your New Pass please&id=' . $pol_id);
    die();
  }
  if (!empty($_POST['pass']) && empty($_POST['oldpass'])) {
    header('location: edit-officer-form.php?status=error&message=Enter your Old Pass please&id=' . $pol_id);
    die();
  }
  if (!empty($_POST['pass']) && !empty($_POST['oldpass'])) {
    if (!password_verify($oldpass, $row['officer_pass'])) {
      header('location: edit-officer-form.php?status=error&message=Old Pass does not match&id=' . $pol_id);
      die();
    }
  }

  $getPic = getPic($police_pic, $role, $lname, $bno, 'edit', $oldname);


  $policeQuery  = "UPDATE police SET police_pic = ?,first_name = ?,middle_name = ? ,last_name = ?,rank = ?,badge_no = ?,address = ?,status = ?,contact_no = ?, officer_sex = ? WHERE police_id = '$pol_id'";
  $policeStmt   = $con->prepare($policeQuery);
  $policeStmt->bind_param('ssssssssss', $getPic, $fname, $mname, $lname, $rank, $bno, $address, $status, $contact, $sex);
  if (!$policeStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  }
  $con = connect();
  if (!empty($_POST['pass'])) {
    $policeQuery  = "UPDATE officer SET officer_name = ?,officer_pass = ? WHERE police_id = '$pol_id'";
    $policeStmt   = $con->prepare($policeQuery);
    $policeStmt->bind_param('ss', $username, $pass);
  } else {
    $policeQuery  = "UPDATE officer SET officer_name = ? WHERE police_id = '$pol_id'";
    $policeStmt   = $con->prepare($policeQuery);
    $policeStmt->bind_param('s', $username);
  }

  if (!$policeStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  } else {
    header('location: officer-directory.php?status=success&message=Officer edited Succesfully&id=' . $pol_id);
    die();
  }
}

if (isset($_POST['add_prisoner'])) {

  $con = connect();

  $code           = trim($_POST['code']);
  $p_cell         = trim($_POST['p-cell']);
  $bday           = trim($_POST['bday']);
  $sex            = trim($_POST['sex']);
  $complexion     = trim($_POST['comp']);
  $ecolor         = trim($_POST['ecolor']);
  $ename          = trim($_POST['ename']);
  $econtact       = trim($_POST['econtact']);
  $famsex         = $_POST['famsex'];
  $famname        = $_POST['famname'];
  $famage         = $_POST['famage'];
  $occ            = $_POST['occ'];
  $famrela        = $_POST['famrela'];
  $famctr         = $_POST['fam-ctr'];
  $alias          = trim($_POST['alias']);
  $marital        = trim($_POST['marital']);
  $erela          = trim($_POST['erela']);
  $fname          = trim($_POST['fName']);
  $mname          = trim($_POST['mName']);
  $lname          = trim($_POST['lName']);
  $crime          = trim($_POST['crime']);
  $sentence       = trim($_POST['sentence']);
  $address        = trim($_POST['address']);
  $ddate          = trim($_POST['ddate']);
  $prisoner_pic   = trim(basename($_FILES['prisoner_pic']['name']));
  $status         = trim($_POST['status']);
  $role           = 'prisoner';


  if (checkOfficer($fname, $mname, $lname, 'nibba', 'add', $role)) {
    header('location: add-prisoner-form.php?status=error&message=Prisoner already exist in our directory');
    die();
  }

  $select = "SELECT * FROM prisoner";
  if (!$stmt = $con->query($select)) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  }
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  foreach ($rows as $row) {
    if ($row['code'] == $code) {
      header('location: add-prisoner-form.php?status=error&message=Prisoner code already exist in our directory');
      die();
    }
  }

  $getPic = getPic($prisoner_pic, $role, $lname, $mname, 'add', "na");

  $prisonerQuery  = "INSERT into prisoner (prisoner_pic,first_name,middle_name,last_name,crime,sentence,address,discharge_date,status,code,cell_id,birthdate,marital_status,complexion,eye_color,emergency_name,emergency_contact,emergency_relation,sex, alias) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $prisonerStmt   = $con->prepare($prisonerQuery);
  $prisonerStmt->bind_param('sssssssssissssssssss', $getPic, $fname, $mname, $lname, $crime, $sentence, $address, $ddate, $status, $code, $p_cell, $bday, $marital, $complexion, $ecolor, $ename, $econtact, $erela, $sex, $alias);
  if (!$prisonerStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  } else {
    $lastPrisonerID =  $con->insert_id;
    $lastFamID = array();
    for ($i = 0; $famctr > $i; ++$i) {
      $famQuery  = "INSERT into fam_record (fam_name,fam_age,fam_sex,fam_relation,fam_occ) VALUES(?,?,?,?,?)";
      $famStmt   = $con->prepare($famQuery);
      $famStmt->bind_param('sssss', $famname[$i], $famage[$i], $famsex[$i], $famrela[$i], $occ[$i]);
      if (!$famStmt->execute()) {
        $error = $con->errno . " " . $con->error;
        echo $error;
        die();
      }
      array_push($lastFamID, $con->insert_id);
    }

    for ($i = 0; count($lastFamID) > $i; ++$i) {

      $dirQuery  = "INSERT into fam_directory (fam_id,prisoner_id) VALUES(?,?)";
      $dirStmt   = $con->prepare($dirQuery);
      $dirStmt->bind_param('ii', $lastFamID[$i], $lastPrisonerID);
      if (!$dirStmt->execute()) {
        $error = $con->errno . " " . $con->error;
        echo $error;
        die();
      }
    }

    header('location: prisoner-directory.php?status=success&message=Prisoner added Succesfully');
    die();
  }
}

if (isset($_POST['edit_prisoner'])) {
  $con = connect();
  $remove = json_decode($_POST['remove']);
  if (!empty($_POST['type_id'])) {
    $efamsex         = $_POST['efamsex'];
    $efamname        = $_POST['efamname'];
    $efamrela        = $_POST['efamrela'];
    $eocc            = $_POST['eocc'];
    $efamage         = $_POST['efamage'];
    $update = $_POST['type_id'];
  }
  if (!empty($_POST['famname'])) {
    $famsex         = $_POST['famsex'];
    $famname        = $_POST['famname'];
    $famrela        = $_POST['famrela'];
    $occ            = $_POST['occ'];
    $famage         = $_POST['famage'];
  }

  $famctr         = $_POST['fam-ctr'];
  $prisoner_id = $_POST['id'];
  $code          = trim($_POST['code']);
  $p_cell          = trim($_POST['p-cell']);
  $bday          = trim($_POST['bday']);
  $sex          = trim($_POST['sex']);
  $complexion          = trim($_POST['comp']);
  $ecolor          = trim($_POST['ecolor']);
  $ename          = trim($_POST['ename']);
  $econtact          = trim($_POST['econtact']);
  $marital          = trim($_POST['marital']);
  $erela          = trim($_POST['erela']);
  $fname          = trim($_POST['fName']);
  $mname          = trim($_POST['mName']);
  $lname          = trim($_POST['lName']);
  $crime          = trim($_POST['crime']);
  $sentence       = trim($_POST['sentence']);
  $address        = trim($_POST['address']);
  $ddate          = trim($_POST['ddate']);
  $status         = trim($_POST['status']);

  $alias            = trim($_POST['alias']);
  $role           = 'prisoner';

  $prisoner_pic     = "";
  $oldname = $_POST['oldname'];
  if (empty(trim(basename($_FILES['prisoner_pic']['name'])))) {
    $prisoner_pic     = trim($_POST['current_prisoner_pic']);
  } else {
    $prisoner_pic     = trim(basename($_FILES['prisoner_pic']['name']));
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $fname) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $mname)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $lname)
  ) {
    header('location: edit-prisoner-form.php?status=error&message=Only alphanumeric characters are allowed&id=' . $prisoner_id);
    die();
  }

  if (checkOfficer($fname, $mname, $lname, 'nibba', 'edit', $role)) {
    header('location: edit-prisoner-form.php?status=error&message=Prisoner already exist in our directory&id=' . $prisoner_id);
    die();
  }

  $getPic = getPic($prisoner_pic, $role, $lname, $mname, 'edit', $oldname);



  $select = "SELECT * FROM prisoner";
  if (!$stmt = $con->query($select)) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  }
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  foreach ($rows as $row) {
    if ($row['prisoner_id'] != $prisoner_id) {
      if ($row['code'] == $code) {
        header('location: edit-prisoner-form.php?status=error&message=Prisoner code already exist in our directory&id=' . $prisoner_id);
        die();
      }
    }
  }

  $prisonerQuery  = "UPDATE prisoner SET prisoner_pic = ?,first_name = ?,middle_name = ? ,last_name = ?,crime = ?,sentence = ?,address = ?,status = ?,discharge_date = ?, birthdate= ?, marital_status = ?, sex = ?, complexion = ? , eye_color = ?, emergency_name = ?, emergency_contact = ?, emergency_relation = ?, cell_id = ?, code = ?, alias = ?  WHERE prisoner_id = '$prisoner_id'";
  $prisonerStmt   = $con->prepare($prisonerQuery);
  $prisonerStmt->bind_param('ssssssssssssssssssis', $getPic, $fname, $mname, $lname, $crime, $sentence, $address, $status, $ddate, $bday, $marital, $sex, $complexion, $ecolor, $ename, $econtact, $erela, $p_cell, $code, $alias);
  if (!$prisonerStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  } else {
    $lastFamID = array();
    if (!empty($famname)) {
      foreach ($famname as $key => $row) {
        $famQuery  = "INSERT into fam_record (fam_name,fam_age,fam_sex,fam_relation,fam_occ) VALUES(?,?,?,?,?)";
        $famStmt   = $con->prepare($famQuery);
        $famStmt->bind_param('sssss', $famname[$key], $famage[$key], $famsex[$key], $famrela[$key], $occ[$key]);
        if (!$famStmt->execute()) {
          print_r($con->error_list);
          $error = $con->errno . " " . $con->error;
          echo $error;
          die();
        }
        array_push($lastFamID, $con->insert_id);
      }
      for ($i = 0; count($lastFamID) > $i; ++$i) {

        $dirQuery  = "INSERT into fam_directory (fam_id,prisoner_id) VALUES(?,?)";
        $dirStmt   = $con->prepare($dirQuery);
        $dirStmt->bind_param('ii', $lastFamID[$i], $prisoner_id);
        if (!$dirStmt->execute()) {
          $error = $con->errno . " " . $con->error;
          echo $error;
          die();
        }
      }
    }
    if (!empty($update)) {
      print_r($update);
      foreach ($update as $key => $row) {
        $update = $row;
        $famQuery  = "UPDATE fam_record SET fam_name = ?, fam_age = ?, fam_sex = ?, fam_relation = ?, fam_occ = ? WHERE fam_id = '$update'";
        $famStmt   = $con->prepare($famQuery);
        $famStmt->bind_param('sssss', $efamname[$key], $efamage[$key], $efamsex[$key], $efamrela[$key], $eocc[$key]);
        if (!$famStmt->execute()) {
          print_r($con->error_list);
          $error = $con->errno . " " . $con->error;
          echo $error;
          die();
        }
      }
    }
    if (!empty($remove)) {

      foreach ($remove as $key => $row) {
        $remove = $row;
        $famQuery  = "DELETE fam_directory, fam_record FROM fam_directory LEFT JOIN fam_record ON fam_directory.fam_id = fam_record.fam_id WHERE fam_directory.fam_id = '$remove'";
        $famStmt  = $con->query($famQuery);
        if (!$famStmt) {
          print_r($con->error_list);
          $error = $con->errno . " " . $con->error;
          echo $error;
          die();
        }
      }
    }
    header('location: prisoner-directory.php?status=success&message=Prisoner edited Successfully&id=' . $prisoner_id);
    die();
  }
}

if (isset($_POST['edit_admin'])) {
  $admin_id   = $_POST['id'];
  $admin_name = trim($_POST['admin_name']);
  $fname = trim($_POST['fname']);
  $mname = trim($_POST['mname']);
  $lname = trim($_POST['lname']);
  $old_pass   = trim($_POST['old_pass']);
  $new_pass   = trim($_POST['new_pass']);
  $conf_pass  = trim($_POST['conf_pass']);
  $role       = $_POST['role'];
  $oldname = "ADMIN123";
  $admin_pic = $_POST['nullPic'];

  if (!empty($_FILES['admin_pic']['name'])) {
    $admin_pic = $_FILES['admin_pic']['name'];
  }
  if (!empty($_POST['current_admin_pic'])) {
    $oldname = $_POST['current_admin_pic'];
  }
  if (
    !preg_match("/^[a-zA-Z0-9\-\s\/]*$/", $admin_name) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $old_pass)
    || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $new_pass) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $conf_pass)
  ) {
    header('location: ' . $role . '-setting.php?status=error&message=Only alphanumeric characters are allowed&id=' . $admin_id);
    die();
  }
  echo $admin_pic;
  if ($new_pass != $conf_pass) {
    header('location: edit-admin-form.php?status=error&message=Confirm pass and New pass does not match&id=' . $admin_id);
    die();
  }
  $getPic = getPic($admin_pic, $role, $lname, $admin_name, 'edit', $oldname);
 
  $con = connect();
  if ($role == 'admin') {
    $checkUsername = "SELECT * FROM admin where admin_id = '$admin_id'";
    $adminQuery  = "UPDATE admin SET admin_pic = ?, admin_name = ?,admin_pass = ?, fname = ?, mname = ?, lname = ? WHERE admin_id = '$admin_id'";

    $adminStmt   = $con->prepare($adminQuery);
    $adminStmt->bind_param('ssssss', $getPic, $admin_name, $new_pass, $fname, $mname, $lname);
  } else {
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
    header('location: edit-' . $role . '-form.php?status=error&message=Old password does not match&id=' . $admin_id);
    die();
  } else {
    $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
  }

  if (!$adminStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    header('location: admin-directory.php?status=success&message=' . $role . ' edited Succesfully&id=' . $admin_id);
    die();
  }
}

if (isset($_POST['redirect_admin'])) {
  header('location: add-admin.php');
  die();
}

if (isset($_POST['add_admin'])) {
  $admin_name = trim($_POST['admin_name']);
  $pass       = trim($_POST['pass']);
  $conf_pass  = trim($_POST['conf_pass']);
  $fname = trim($_POST['fname']);
  $mname       = trim($_POST['mname']);
  $lname = trim($_POST['lname']);
  $admin_pic = $_POST['nullPic'];
  $oldname  = "ADMIN123";
  if (!empty($_FILES['admin_pic']['name'])) {
    $admin_pic = $_FILES['admin_pic']['name'];
    $oldname  = "";
  }

  if (
    !preg_match("/^[a-zA-Z0-9\s\/]*$/", $admin_name) || !preg_match("/^[a-zA-Z0-9\s\/]*$/", $pass)
  ) {
    header('location: add-admin.php?status=error&message=Only alphanumeric characters are allowed');
    die();
  }

  if ($pass != $conf_pass) {
    header('location: add-admin.php?status=error&message=Confirm pass and New pass does not match');
    die();
  }
  $getPic = getPic($admin_pic, 'admin', $lname, $admin_name, 'add', $oldname);
  $con = connect();
  $checkUsername = "SELECT * FROM admin where admin_name = '$admin_name'";
  $checkStmt = $con->query($checkUsername);
  if (!$checkStmt) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  }
  $checkRows = $checkStmt->num_rows;
  if ($checkRows == 1) {
    header('location: admin-directory.php?status=error&message=Admin already exist in our directory');
    die();
  }
  $pass = password_hash($pass, PASSWORD_DEFAULT);
  $insertQuery = "INSERT INTO admin (admin_pic, admin_name,admin_pass,fname,mname,lname) VALUES (?,?,?,?,?,?)";
  $insertStmt  = $con->prepare($insertQuery);
  $insertStmt->bind_param('ssssss', $getPic, $admin_name, $pass, $fname, $mname, $lname);
  if (!$insertStmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
  } else {
    header('location: admin-directory.php?status=success&message=Admin added Succesfully');
    die();
  }
}

if (isset($_GET['checkIn'])) {
  $fname = $_GET['fname'];
  $lname = $_GET['lname'];
  $con = connect();
  $selectQuery = "SELECT first_name,last_name from prisoner where first_name='$fname' AND last_name='$lname'";
  if (!$stmt = $con->query($selectQuery)) {
    $error = $con->errno . ' ' . $error;
    echo $error;
  }
  $rows = $stmt->num_rows;
  if ($rows != 0) {
    echo <<<END
    <label id="redirectLabel" for="floatingInput">Prisoner to be visited: <strong>$fname $lname </strong><button type="submit" id="redirectIn" name="redirectIn" class="btn shadow-none m-0 p-0"href="#"><i class="fas text-primary fa-eye"></i></button>&nbsp<i class="text-success fas fa-check"></i></label>
    END;
  } else {
    echo <<<END
    <label id="redirectLabel" for="floatingInput">Prisoner to be visited: <strong>$fname $lname <i class="text-danger fas fa-times"></i></label>
    END;
  }
}
if (isset($_POST['getApp'])) {
  $id = $_POST['id'];

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $con = connect();
    $selectQuery = "SELECT * FROM appointment WHERE appointment_id = '$id'";
    if (!$stmt = $con->query($selectQuery)) {
      $error = $con->errno . " " . $con->error;
      echo $error;
    }
    if ($stmt->num_rows == 0) {
      header('location: pending.php');
      die();
    }
    $rows = $stmt->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
    }
    $data['id'] = $id;
    $data['name'] = $row['vname'];
    $data['email'] = $row['vemail'];
    $data['contact'] = $row['vcontact'];
    $data['address'] = $row['vadd'];
    $data['pfirst'] = $row['pfirst'];
    $data['plast']  = $row['plast'];
    $data['pdate']  = $row['pdate'];
    $data['relation'] = $row['relation'];
    $data['status'] = $row['stats'];
    echo json_encode($data);
  }
}
if (isset($_POST['delete'])) {
  $type = $_POST['type'];
  $id = $_POST['app_id'];
  if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
  }
  $con = connect();
  $deleteQuery = "";
  if ($type == "appointment") {
    $deleteQuery = "DELETE FROM appointment WHERE appointment_id='$id'";
    $type = "pending";
    $url = "location: $type.php?status=success&message=Successfully Deleted";
  }
  if ($type == "officer") {
    $deleteQuery = "DELETE FROM police WHERE police_id='$id'";
    $type = "officer-directory";
    $url = "location: $type.php?status=success&message=Successfully Deleted";
  }
  if ($type == "prisoner") {
    $deleteQuery = "DELETE FROM prisoner WHERE prisoner_id='$id'";
    $type = "prisoner-directory";
    $url = "location: $type.php?status=success&message=Successfully Deleted";
  }
  if ($type == "prison_list") {
    $deleteQuery = "DELETE FROM prison_list WHERE id='$id'";
    $type = "prison-list";
    $url = "location: $type.php?status=success&message=Successfully Deleted";
  }
  if ($type == "record_list") {
    $deleteQuery = "DELETE FROM record_list WHERE record_id='$id'";
    $type = "view-prisoner";
    $url = "location: $type.php?status=success&message=Successfully Deleted&id=$pid";
  }

  if ($type == "action_list") {
    $deleteQuery = "DELETE FROM action_list WHERE id='$id'";
    $type = "action-list";
    $url = "location: $type.php?status=success&message=Successfully Deleted";
  }
  if ($type == "admin") {
    $deleteQuery = "DELETE FROM admin WHERE admin_id='$id'";
    $type = "admin-directory";
    $url = "location: $type.php?status=success&message=Successfully Deleted";
  }

  // echo $deleteQuery;
  // die();
  $stmt = $con->query($deleteQuery);

  if (!$stmt) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  } else {
    header($url);
    die();
  }
}
if (isset($_POST['getOpt'])) {
  $con = connect();
  $select = 'SELECT block_list.id AS id,prison_list.name, block_list.cell_name AS cell_name FROM block_list JOIN prison_list ON block_list.building_id = prison_list.id WHERE prison_list.status_prison = 1 AND block_list.status_cell = 1';
  if (!$stmt = $con->query($select)) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  }
  $num = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  $arr = array();
  foreach ($rows as $row) {
    $data['id'] = $row['id'];
    $data['len'] = $num;
    $data['prison'] = html_entity_decode($row['name'], ENT_QUOTES | ENT_XML1, 'UTF-8');
    $data['cell']   = $row['cell_name'];
    array_push($arr, $data);
  }
  echo json_encode($arr);
}

if (isset($_POST['getTable'])) {
  $con = connect();
  $prisoner_id = $_POST['prisoner_id'];

  $selectQuery  =  " SELECT *, record_list.date_created AS rdate FROM prisoner 
  LEFT JOIN record_list ON prisoner_id = record_list.inmate_id
  LEFT JOIN action_list ON record_list.action_id = action_list.id 
  WHERE record_list.inmate_id ='$prisoner_id'";

  $selectStmt = $con->query($selectQuery);
  if (!$selectStmt) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
  }
  $select_rows = $selectStmt->num_rows;
  $rows = $selectStmt->fetch_all(MYSQLI_ASSOC);
  if ($select_rows > 0) {
    foreach ($rows as $row) {
      $data['date_created'] = $row['rdate'];
      $data['action'] = $row['action_name'];
      $data['remarks'] = $row['remarks'];
      $button = '<div class="d-flex flex-row align-items-center justify-content-center btn-group"><a id="edit" data-whatever=' . $row['record_id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#editRecordModal"><i class="fas fa-edit"></i></a><a id="delete" data-serv=' . $prisoner_id . ' data-whatever=' . $row['record_id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash text-danger"></i></a></div>';
      $arr['data'][] = array($row['date'], $row['action_name'], $row['remarks'], $button);
    }
    echo json_encode($arr);
  } else {
    $data['data'] = array();
    echo json_encode($data);
  }
}
if (isset($_POST['getVal'])) {
  $con = connect();
  $select = 'SELECT * FROM action_list WHERE status_action = "1"';
  if (!$stmt = $con->query($select)) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  }
  $num = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  $arr = array();
  foreach ($rows as $row) {
    $data['action_id'] = $row['id'];
    $data['action'] = $row['action_name'];
    $data['date'] =  date("Y-m-d");
    array_push($arr, $data);
  }
  echo json_encode($arr);
}
if (isset($_POST['record-submit'])) {
  $ref = $_POST['view'];
  $pid   = $_POST['pid'];
  $id   = $_POST['id'];
  $date = $_POST['date'];
  $action = $_POST['cell'];
  $remarks = $_POST['remarks'];
  $type = $_POST['type'];

  $con = connect();
  if ($type == 'add') {
    $insertSQL = "INSERT into record_list (inmate_id,action_id,remarks,date) VALUES(?,?,?,?)";
    $url = 'location: view-prisoner.php?id=' . $pid . '&status=Success&message=Action added successfully';
  } else {
    $insertSQL = "UPDATE record_list SET inmate_id=?,action_id=?,remarks=?,date=? WHERE record_id='$id'";
    $url = 'location: view-prisoner.php?id=' . $pid . '&status=Success&message=Action edited successfully';
  }

  $stmt = $con->prepare($insertSQL);
  $stmt->bind_param('ssss',  $pid, $action, $remarks, $date);
  if (!$stmt->execute()) {
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  }
  if ($view = "view") {
    header($url);
    die();
  }
}
if (isset($_POST['getE'])) {
  $con = connect();
  $prisoner_id = $_POST['prisoner_id'];
  $pid  = $_POST['pid'];

  $selectQuery  =  " SELECT * FROM record_list 
  LEFT JOIN prisoner ON record_id = prisoner.prisoner_id
  LEFT JOIN action_list ON record_list.action_id = action_list.id 
  WHERE record_id = '$prisoner_id'";

  $selectStmt = $con->query($selectQuery);
  if (!$selectStmt) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
  }
  $select_rows = $selectStmt->num_rows;
  $rows = $selectStmt->fetch_all(MYSQLI_ASSOC);

  foreach ($rows as $row) {
  }
  $data['date_created'] =  date("Y-m-d");
  $data['action'] = $row['action_name'];
  $data['remarks'] = $row['remarks'];
  $data['action_id'] = $row['action_id'];
  echo json_encode($data);
}

if (isset($_POST['getPrison'])) {
  $con = connect();
  $select = 'SELECT * FROM prison_list';
  if (!$stmt = $con->query($select)) {
    $error = $con->errno  . ' ' . $con->error;
    echo $error;
    die();
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  if ($count > 0) {
    foreach ($rows as $row) {
      $button = '<div class="d-flex flex-row align-items-center justify-content-center btn-group"><a id="edit" data-whatever=' . $row['id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#editPrisonModal"><i class="fas fa-edit"></i></a><a id="delete" data-whatever=' . $row['id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash text-danger"></i></a></div>';
      if ($row['status_prison'] == 0) {
        $status = '<td><span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span></td>';
      } else {
        $status = '<td><span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span></td>';
      }
      $arr['data'][] = array($row['id'], $row['date_created'], html_entity_decode($row['name'], ENT_QUOTES | ENT_XML1, 'UTF-8'), $status, $button, $row['id'], $row['status_prison']);
    }
    echo json_encode($arr);
  } else {
    $arr['data'] = array();
    echo json_encode($arr);
  }
}
if (isset($_POST['deleteCell'])) {
  $id = $_POST['app_id'];
  $con = connect();
  $deleteQuery = "DELETE FROM block_list WHERE id = '$id'";
  if (!$stmt = $con->query($deleteQuery)) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
    die();
  } else {
    header('location: cell-list.php?status=success&message=Cell deleted Successfully');
    die();
  }
}
if (isset($_POST['prison-submit'])) {
  $name = $_POST['name'];
  $status = $_POST['status'];
  $type = $_POST['type'];
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $con = connect();
  if ($type == 'add') {
    $insert = "INSERT INTO prison_list (name,status_prison) VALUES(?,?)";
    $url = 'location: prison-list.php?status=success&message=Prison added Successfully';
  } else {
    $insert = "UPDATE prison_list SET name = ?,status_prison = ? WHERE id ='$id'";
    $url = 'location: prison-list.php?status=success&message=Prison edited Successfully';
  }
  $stmt = $con->prepare($insert);
  $stmt->bind_param('ss', $name, $status);
  if (!$stmt->execute()) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
    die();
  } else {

    header($url);
  }
}

if (isset($_POST['getP'])) {
  $id = $_POST['prison_id'];
  $con = connect();
  $select = "SELECT * FROM prison_list WHERE id='$id'";
  if (!$stmt = $con->query($select)) {
    $error = $con->errno  . ' ' . $con->error;
    echo $error;
    die();
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  if ($count > 0) {
    foreach ($rows as $row) {
      $arr['data'] = array(html_entity_decode($row['name'], ENT_QUOTES | ENT_XML1, 'UTF-8'), $row['status_prison']);
    }
    echo json_encode($arr);
  } else {
    $arr['data'] = array();
    echo json_encode($arr);
  }
}

if (isset($_POST['getC'])) {
  $id = $_POST['prison_id'];
  $con = connect();
  $select = "SELECT *,block_list.id AS cell_id, block_list.date_created AS cdate FROM block_list LEFT JOIN prison_list ON block_list.building_id = prison_list.id WHERE block_list.id='$id'";
  if (!$stmt = $con->query($select)) {
    $error = $con->errno  . ' ' . $con->error;
    echo $error;
    die();
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  if ($count > 0) {
    foreach ($rows as $row) {
      $arr['data'] = array(html_entity_decode($row['name'], ENT_QUOTES | ENT_XML1, 'UTF-8'), $row['cell_name'], $row['status_cell'], $row['building_id']);
    }
    echo json_encode($arr);
  } else {
    $arr['data'] = array();
    echo json_encode($arr);
  }
}

if (isset($_POST['getCell'])) {
  $con = connect();
  $select = 'SELECT *,block_list.id AS cell_id, block_list.date_created AS cdate FROM block_list LEFT JOIN prison_list ON block_list.building_id = prison_list.id';
  if (!$stmt = $con->query($select)) {
    $error = $con->errno  . ' ' . $con->error;
    echo $error;
    die();
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  if ($count > 0) {
    foreach ($rows as $row) {
      $button = '<div class="d-flex flex-row align-items-center justify-content-center btn-group"><a data-whatever=' . $row['cell_id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#editCellModal"><i class="fas fa-edit"></i></a><a id="delete" data-whatever=' . $row['cell_id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#deleteCellModal"><i class="fas fa-trash text-danger"></i></a></div>';
      if ($row['status_cell'] == 0) {
        $status = '<td><span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span></td>';
      } else {
        $status = '<td><span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span></td>';
      }
      $arr['data'][] = array($row['cell_id'], $row['cdate'], $row['name'], $row['cell_name'], $status, $button);
    }
    echo json_encode($arr);
  } else {
    $arr['data'] = array();
    echo json_encode($arr);
  }
}
if (isset($_POST['getFam'])) {
  $id = $_POST['prisoner_id'];
  $con = connect();
  $selectQuery  =  " SELECT * FROM fam_directory LEFT JOIN fam_record ON fam_directory.fam_id = fam_record.fam_id WHERE fam_directory.prisoner_id ='$id'";
  $selectStmt = $con->query($selectQuery);
  if (!$selectStmt) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
  }
  $select_rows = $selectStmt->num_rows;
  $rows = $selectStmt->fetch_all(MYSQLI_ASSOC);
  if ($select_rows > 0) {
    foreach ($rows as $row) {
      $button = '<div class="d-flex flex-row align-items-center justify-content-center btn-group"><a data-whatever="' . $row['fam_id'] . '" class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#editFamModal"><i class="fas fa-edit"></i></a><a id="delete" data-whatever="' . $row['fam_id'] .  '"class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#deleteFamModal"><i class="fas fa-trash text-danger"></i></a></div>';
      $fam_array['data'][] = array($row['fam_name'], $row['fam_age'], $row['fam_sex'], $row['fam_relation'], $row['fam_occ'], $button);
    }
    echo json_encode($fam_array);
  } else {
    $fam_array['data'] = array();
    echo json_encode($fam_array);
  }
}
if (isset($_POST['getF'])) {
  $id = $_POST['id'];
  $con = connect();
  $select = "SELECT * FROM fam_record WHERE fam_id ='$id'";
  if (!$stmt = $con->query($select)) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  $arr = array();
  if ($count > 0) {
    foreach ($rows as $row) {
      array_push($arr, $id, $row['fam_name'], $row['fam_age'], $row['fam_sex'], $row['fam_relation'], $row['fam_occ']);
    }
    echo json_encode($arr);
  } else {
    $arr = array();
    echo json_encode($arr);
  }
}
if (isset($_POST['fam-submit'])) {
  $famname = $_POST['famname'];
  $famage = $_POST['famage'];
  $famsex = $_POST['famsex'];
  $famrela = $_POST['famrela'];
  $occ = $_POST['occ'];
  $type = $_POST['type'];

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }
  if (isset($_POST['prisoner_id'])) {
    $prisoner_id = $_POST['prisoner_id'];
  }

  $con = connect();
  if ($type == 'add') {
    $insert = "INSERT INTO fam_record (fam_name,fam_age,fam_sex,fam_relation,fam_occ) VALUES(?,?,?,?,?)";
  } else {
    $insert = "UPDATE fam_record SET fam_name = ?,fam_age = ?,fam_sex = ?,fam_relation = ?,fam_occ = ? WHERE fam_id ='$id'";
  }
  $stmt = $con->prepare($insert);
  $stmt->bind_param('sssss', $famname, $famage, $famsex, $famrela, $occ);
  if (!$stmt->execute()) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
    die();
  } else {
    if ($type == 'add') {
      $lastFamID = $con->insert_id;
      $insert = "INSERT INTO fam_directory (fam_id,prisoner_id) VALUES(?,?)";
      $stmt = $con->prepare($insert);
      $stmt->bind_param('ii', $lastFamID, $prisoner_id);
      if (!$stmt->execute()) {
        $error = $con->errno . ' ' . $con->error;
        echo $error;
        die();
      }
    }
    if ($type == "add") {
      header('location: view-prisoner.php?status=success&message=Family member added Successfully&id=' . $prisoner_id);
      die();
    } else {
      header('location: view-prisoner.php?status=success&message=Family member edited Successfully&id=' . $prisoner_id);
      die();
    }
  }
}
if (isset($_POST['deleteFam'])) {
  $id = $_POST['fam_id'];
  $prisoner_id = $_POST['prisoner_id'];
  $con = connect();
  $famQuery  = "DELETE fam_directory, fam_record FROM fam_directory LEFT JOIN fam_record ON fam_directory.fam_id = fam_record.fam_id WHERE fam_directory.fam_id = '$id'";
  $famStmt  = $con->query($famQuery);
  if (!$famStmt) {
    print_r($con->error_list);
    $error = $con->errno . " " . $con->error;
    echo $error;
    die();
  }
  header('location: view-prisoner.php?status=success&message=Family member deleted Successfully&id=' . $prisoner_id);
  die();
}
if (isset($_POST['cell-submit'])) {
  $name = $_POST['name'];
  $status = $_POST['status'];
  $p_cell = $_POST['p-cell'];
  $type = $_POST['type'];

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $con = connect();
  if ($type == 'add') {
    $insert = "INSERT INTO block_list (building_id,cell_name,status_cell) VALUES(?,?,?)";
  } else {
    $insert = "UPDATE block_list SET building_id = ?,cell_name = ?,status_cell = ? WHERE id ='$id'";
  }
  $stmt = $con->prepare($insert);
  $stmt->bind_param('sss', $p_cell, $name, $status);
  if (!$stmt->execute()) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
    die();
  } else {
    if ($type =  "add") {
      header('location: cell-list.php?status=success&message=Cell added Successfully');
      die();
    } else {
      header('location: cell-list.php?status=success&message=Cell edited Successfully');
      die();
    }
  }
}

if (isset($_POST['getAction'])) {
  $con = connect();
  $select = 'SELECT * FROM action_list';
  if (!$stmt = $con->query($select)) {
    $error = $con->errno  . ' ' . $con->error;
    echo $error;
    die();
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  if ($count > 0) {
    foreach ($rows as $row) {
      $button = '<div class="d-flex flex-row align-items-center justify-content-center btn-group"><a id="edit" data-whatever=' . $row['id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#editActionModal"><i class="fas fa-edit"></i></a><a id="delete" data-whatever=' . $row['id'] . ' class="text-primary pe-auto" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash text-danger"></i></a></div>';
      if ($row['status_action'] == 0) {
        $status = '<td><span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span></td>';
      } else {
        $status = '<td><span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span></td>';
      }
      $arr['data'][] = array($row['id'], $row['date_created'], $row['action_name'], $status, $button);
    }
    echo json_encode($arr);
  } else {
    $arr['data'] = array();
    echo json_encode($arr);
  }
}

if (isset($_POST['getAdmin'])) {
  $con = connect();
  $select = 'SELECT * FROM admin';
  if (!$stmt = $con->query($select)) {
    $error = $con->errno  . ' ' . $con->error;
    echo $error;
    die();
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  if ($count > 0) {
    foreach ($rows as $row) {
      $button = '<div class="d-flex flex-row align-items-center justify-content-center btn-group"><a id="editAdmin" data-whatever=' . $row['admin_id'] . ' class="text-primary pe-auto" href="edit-admin-form.php?id=' . $row['admin_id'] . '"><i class="fas fa-edit"></i></a><a id="delete" data-whatever=' . $row['admin_id'] . ' class="text-primary pe-auto" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash text-danger"></i></a></div>';
      $name =  $row['fname'] . " " . $row['lname'];
      $arr['data'][] = array($row['admin_id'], $row['date_created'], $name, $row['admin_name'], $button);
    }
    echo json_encode($arr);
  } else {
    $arr['data'] = array();
    echo json_encode($arr);
  }
}

if (isset($_POST['action-submit'])) {
  $name = $_POST['name'];
  $status = $_POST['status'];
  $type = $_POST['type'];
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $con = connect();
  if ($type == 'add') {
    $insert = "INSERT INTO action_list (action_name,status_action) VALUES(?,?)";
  } else {
    $insert = "UPDATE action_list SET action_name = ?,status_action = ? WHERE id ='$id'";
  }
  $stmt = $con->prepare($insert);
  $stmt->bind_param('ss', $name, $status);
  if (!$stmt->execute()) {
    $error = $con->errno . ' ' . $con->error;
    echo $error;
    die();
  } else {
    if ($type == "add") {
      header('location: action-list.php?status=success&message=Action added Successfully');
      die();
    } else {
      header('location: action-list.php?status=success&message=Action edited Successfully');
      die();
    }
  }
}

if (isset($_POST['getA'])) {
  $id = $_POST['prison_id'];
  $con = connect();
  $select = "SELECT * FROM action_list WHERE id='$id'";
  if (!$stmt = $con->query($select)) {
    $error = $con->errno  . ' ' . $con->error;
    echo $error;
    die();
  }
  $count = $stmt->num_rows;
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  if ($count > 0) {
    foreach ($rows as $row) {
      $arr['data'] = array($row['action_name'], $row['status_action']);
    }
    echo json_encode($arr);
  } else {
    $arr['data'] = array();
    echo json_encode($arr);
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
  if ($oldname == "ADMIN123") {
    $filetype       = 'png';
  }
  $changePicName  = $targetPath . $bno . "-" . $lname . '.' . $filetype;
  $allowedTypes   =   array('jpg', 'jpeg', 'png', 'gif', 'tif');
  $fileName       = $role . '_pic';
  echo $oldname;
  if (in_array($filetype, $allowedTypes)) {
    if ($url == 'add') {
      if ($oldname == "ADMIN123") {
        $destination   = $targetPath . $bno . "." . $filetype;
        $changePicName = $destination;
        $source = $obj;
        copy($source, $destination);
      } else {
        echo $changePicName;
        move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName);
      }
    } else {
      echo $oldname;
        if ($oldname !=  $changePicName) {
          unlink($oldname);
          move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName);
          // move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName); 
        } else {
          move_uploaded_file($_FILES[$fileName]['tmp_name'], $changePicName);
          echo $oldname;
        }
      
    }
  } else {
    if ($role == 'police') {
      header('location: ' . $url . '-officer-form.php?status=error&message=Only JPG, PNG, GIF, AND TIF extensions are allowed');
      die();
    } else if ($role == 'prisoner') {
      header('location: ' . $url . '-prisoner-form.php?status=error&message=Only JPG, PNG, GIF, AND TIF extensions are allowed');
      die();
    } else {
      header('location: add-admin.php?status=error&message=Only JPG, PNG, GIF, AND TIF extensions are allowed');
      die();
    }
  }

  return $changePicName;
}
