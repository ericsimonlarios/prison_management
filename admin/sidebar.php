
    <!-- <div id="appointmentWrapper" class="wrapper d-flex align-items-stretch"> -->
    <?php

    $f1 = "00:00:00";
    $from = date('Y-m-d') . " " . $f1;
    $t1 = "23:59:59";
    $to = date('Y-m-d') . " " . $t1;

    $con = connect();
    $selectQuery  =  " SELECT * FROM appointment WHERE stats ='Pending'";
    $selectStmt = $con->query($selectQuery);
    if (!$selectStmt) {
        $error = $con->errno . ' ' . $con->error;
        echo $error;
    }
    $select_rows = $selectStmt->num_rows;

    $todayQuery  =  " SELECT * FROM appointment WHERE appointment_added BETWEEN '$from' AND '$to' AND stats ='Pending'";
    $todayStmt = $con->query($todayQuery);
    if (!$todayStmt) {
        $error = $con->errno . ' ' . $con->error;
        echo $error;
    }
    $today_rows = $todayStmt->num_rows;

     
    $aid  = $_SESSION['id'];
    $rank = $_SESSION['rank'];
    if($rank == "admin"){
      $selectAdmin = "SELECT * FROM admin WHERE admin_id = '$aid'";
  }else{
      $selectAdmin = "SELECT * FROM officer LEFT JOIN police ON officer.police_id = police.police_id WHERE officer.officer_id = '$aid'";
  }
  if(!$profStmt = $con-> query($selectAdmin)){
      $error = $con->errno . " " . $con->error;
      echo $error;
      die();
  }
  $profRows = $profStmt -> fetch_all(MYSQLI_ASSOC);
  foreach($profRows as $profRow){
      if($rank == 'admin'){
          $pic   = $profRow['admin_pic'];
      }else{
          $pic   = $profRow['police_pic'];
      }
  }

    ?>
    <div class="col-md-3 left_col">
              <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                  <a href="dashboard.php" class="site_title"><i class="fa fa-university"></i> <span>REFORM</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                  <div class="menu_section">
                    <h3>Dashboard</h3>
                    <ul class="nav side-menu">
                      <li>
                        <a href="dashboard.php"><i class="fa fa-home "></i> Home</a>  
                      </li>
                      <li><a><i class="fa fa-book"></i> Appointment  <span class="fa fa-chevron-down"></span><span class="float-right badge badge-danger"><?php echo $select_rows ?></span></a>
                        <ul class="nav child_menu">
                          <li><a href="pending.php">Pending<span class="float-right badge badge-danger"><?php echo $select_rows ?></span> </a> </li>
                          <li><a href="approved.php">Approved</a></li>
                          <li><a href="declined.php">Decline</a></li>
                        </ul>
                      </li>
                      <li><a><i class="fa fa-user"></i> Officers <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="officer-directory.php">Officer Directory</a> </li>
                          <li><a href="removed-officer.php">Removed Officer</a></li>
                        </ul>
                      </li>
                      <li><a><i class="fa fa-barcode"></i> Prisoners <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="prisoner-directory.php">Prisoner Directory</a> </li>
                          <li><a href="released-prisoner.php">Released Prisoners</a></li>
                        </ul>
                      </li>
                    <?php 
                        if($_SESSION['rank'] == 'admin'){
                            echo <<< END
                              <li><a><i class="fa fa-database"></i> Master List <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="prison-list.php">Prison List</a> </li>
                                  <li><a href="cell-list.php">Cell List</a></li>
                                  <li><a href="action-list.php">Action List</a></li>
                                </ul>
                              </li>
                            END;
                        }
                    ?>
                    <?php
                    if ($_SESSION['rank'] == 'admin') {
                        echo <<< END
                              <li>
                                <a href="admin-directory.php"><i class="fa fa-user "></i> Admin</a>  
                              </li>
                            END;
                        }
                    ?>
                    </ul>
                  </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                  <a>
                    <span class="glyphicon" aria-hidden="true"></span>
                  </a>
                  <a >
                    <span class="glyphicon " aria-hidden="true"></span>
                  </a>
                  <a >
                    <span class="glyphicon " aria-hidden="true"></span>
                  </a>
                  <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                  </a>
                </div>
                <!-- /menu footer buttons -->
              </div>
            </div>

            <div class="top_nav">
              <div class="nav_menu">
                  <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                  </div>
                  <nav class="nav navbar-nav">
                  <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                      <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $pic ?>" alt=""><?php echo $_SESSION['fname']; ?>
                      </a>
                      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal"> Profile</a>
                        <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                      </div>
                    </li>

                  </ul>
                </nav>
              </div>
            </div>
           </div> 
    <!-- </div> -->
