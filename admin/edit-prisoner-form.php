<?php
include "../dbcon.php";
session_start();
if (!isset($_SESSION['name'])) {
    header('location: ../temp.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Management</title>

    <link href="css_new/bootstrap.min.css" rel="stylesheet">
    <link href="css_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css_new/custom.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include 'sidebar.php'; ?>

            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row col-12" style="display: inline-block;">
                    <div id="content" class="p-4 ">
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-right">
                                            <li class="breadcrumb-item"><a href="prisoner-directory.php.">Prisoner Directory</a></li>
                                            <li class="breadcrumb-item"><a href="released-prisoner.php.">Released Prisoner</a></li>
                                            <li class="breadcrumb-item active">Edit Prisoner</li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <div class="form-group text-center">
                            <h3 class="mb-4" style="text-align: center;">Edit Prisoner</h3>

                        </div>
                        <?php
                        if (isset($_GET['status'])) {
                            $status  = $_GET['status'];
                            $message = $_GET['message'];
                            echo "<script>alert('$message')</script>";
                            if ($status == 'success') {
                                echo <<<end
                        <div style="display:block;" class=" alert alert-success alert-handler mb-3" role="alert">
                        $message
                        </div>
                       end;
                            } else {
                                echo <<<end
                        <div style="display:block;" class=" alert alert-danger alert-handler mb-3" role="alert">
                        $message
                        </div>
                       end;
                            }
                        }
                        if (isset($_GET['id'])) {
                            $prisoner_id = $_GET['id'];

                            $selectQuery  =  "  SELECT * FROM prisoner 
                LEFT JOIN block_list ON prisoner.cell_id = block_list.id 
                LEFT JOIN prison_list ON block_list.building_id = prison_list.id 
                LEFT JOIN record_list ON prisoner.prisoner_id = record_list.inmate_id
                LEFT JOIN action_list ON record_list.action_id = action_list.id
                LEFT JOIN fam_directory ON prisoner.prisoner_id = fam_directory.prisoner_id
                LEFT JOIN fam_record ON fam_directory.fam_id = fam_record.fam_id
                WHERE prisoner.prisoner_id ='$prisoner_id'";
                            $selectStmt = $con->query($selectQuery);
                            if (!$selectStmt) {
                                $error = $con->errno . ' ' . $con->error;
                                echo $error;
                            }
                            $select_rows = $selectStmt->num_rows;

                            $cpname = "";
                            for ($i = 0; $select_rows > $i; ++$i) {
                                $select_row        =  $selectStmt->fetch_array(MYSQLI_ASSOC);
                                $code             = htmlentities($select_row['code']);
                                $pname              = htmlentities(html_entity_decode($select_row['name'], ENT_QUOTES | ENT_XML1, 'UTF-8'));
                                $cid             = htmlentities($select_row['cell_id']);
                                $cname              = htmlentities($select_row['cell_name']);
                                $fname             = htmlentities($select_row['first_name']);
                                $mname             = htmlentities($select_row['middle_name']);
                                $lname             = htmlentities($select_row['last_name']);
                                $ename             = htmlentities($select_row['emergency_name']);
                                $econtact             = htmlentities($select_row['emergency_contact']);
                                $erela            = htmlentities($select_row['emergency_relation']);
                                $sex             = htmlentities($select_row['sex']);
                                $ecolor             = htmlentities($select_row['eye_color']);
                                $comp            = htmlentities($select_row['complexion']);
                                $marital           = htmlentities($select_row['marital_status']);
                                $crime             = htmlentities($select_row['crime']);
                                $sentence          = htmlentities($select_row['sentence']);
                                $address           = htmlentities($select_row['address']);
                                $started           = htmlentities($select_row['date_jailed']);
                                $status            = htmlentities($select_row['status']);
                                $prisoner_pic      = htmlentities($select_row['prisoner_pic']);
                                $bdate             = htmlentities($select_row['birthdate']);
                                $ddate             = htmlentities($select_row['discharge_date']);
                                $remarks            = htmlentities($select_row['remarks']);
                                $fam_name             = htmlentities($select_row['fam_name']);
                                $fam_sex            = htmlentities($select_row['fam_sex']);
                                $fam_rela            = htmlentities($select_row['fam_relation']);
                                $fam_occ             = htmlentities($select_row['fam_occ']);
                                $alias             = htmlentities($select_row['alias']);
                                $fam_array[] = array(htmlentities($select_row['fam_id']), htmlentities($select_row['fam_name']), htmlentities($select_row['fam_age']), htmlentities($select_row['fam_sex']), htmlentities($select_row['fam_relation']), htmlentities($select_row['fam_occ']));
                                $cpname = $pname . ' - ' . $cname;
                                $fam_id[] = array(htmlentities($select_row['fam_id']));
                            }
                            $fam_count = count($fam_array);
                            $_SESSION['fam_array'] = $fam_id;
                            foreach ($fam_array[0] as $key => $rows)
                                if ($rows == "") {
                                    $fam_array = array();
                                }
                        } else {
                            header('location: prisoner-directory.php?status=Error&message=Page is not found');
                            die();
                        }
                        ?>

                        <form class="form shadow p-5 bg-white rounded" role="alert" method="POST" enctype="multipart/form-data" action="actions.php">
                            <h3 class="pt-3 pb-3">Prisoner Info</h3>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="code">Prisoner Code <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="code" value="<?php echo $code ?>" name="code" placeholder="Code" maxlength="6" required>
                                </div>
                                <div class="form-group col">
                                    <label for="p-cell">Prison - Cell Block <span class="text-danger">(Required)</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="p-cell" name="p-cell" required>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="fName">First Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="fName" value="<?php echo $fname ?>" name="fName" placeholder="First Name" required>
                                </div>
                                <div class="form-group col">
                                    <label for="mName">Middle Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="mName" value="<?php echo $mname ?>" name="mName" placeholder="Middle Name" required>
                                </div>
                                <div class="form-group col">
                                    <label for="lName">Last Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="lName" value="<?php echo $lname ?>" name="lName" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Alias <span class="text-danger">(Required)</span></label>
                                <input class="form-control" id="alias" name="alias" value="<?php echo $alias ?>" placeholder="Alias" required>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="bday">Birthday <span class="text-danger">(Required)</span></label>
                                    <input type="date" class="form-control" id="bday" value="<?php echo $bdate ?>" name="bday" placeholder="Birthday" required>
                                </div>
                                <div class="form-group col">
                                    <label for="sex">Sex assigned at Birth <span class="text-danger">(Required)</span></label>
                                    <select type="text" class="form-control" id="sex" name="sex" placeholder="Middle Name" required>
                                        <option value="<?php echo $sex ?>" selected hidden><?php echo $sex ?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <label for="address">Address <span class="text-danger">(Required)</span></label>
                                    <textarea class="resizable_textarea form-control" id="address" rows="5"><?php echo $address ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="marital">Marital Status <span class="text-danger">(Required)</span></label>
                                    <select class="form-control" id="marital" name="marital" placeholder="Crime" required>
                                        <option value="<?php echo $marital ?>" selected hidden><?php echo $marital ?></option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Widower">Widower</option>
                                    </select>
                                </div>
                                <div class="form-group col">

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="comp">Complexion <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="comp" value="<?php echo $comp ?>" name="comp" placeholder="Complexion" required>
                                </div>
                                <div class="form-group col">
                                    <label for="ecolor">Eye Color <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" value="<?php echo $ecolor ?>" id="ecolor" name="ecolor" placeholder="Eye Color">
                                </div>
                            </div>
                            <h3 class="pt-3 pb-3">Case Details</h3>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="crime">Crime Committed <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="crime" value="<?php echo $crime ?>" name="crime" placeholder="Crime" required>
                                </div>
                                <div class="form-group col">
                                    <label for="sen">Sentence <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="sen" value="<?php echo $sentence ?>" name="sentence" placeholder="Sentence" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="cont">Discharge Date <span class="text-danger">(Required)</span></label>
                                    <input type="date" class="form-control" id="cont" value="<?php echo $ddate ?>" name="ddate" placeholder="discharge" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="status">Status <span class="text-danger">(Required)</span></label>
                                    <select type="text" class="form-control" id="status" name="status" required>
                                        <option value="<?php echo $status ?>" hidden selected><?php echo $status ?></option>
                                        <option value="Jailed">Jailed</option>
                                        <option value="Released">Released</option>
                                    </select>
                                </div>
                            </div>
                            <h3 class="pt-3 pb-3">Emergency Contact Details</h3>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="ename">Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" value="<?php echo $ename ?>" id="ename" name="ename" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="econtact">Contact no. <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="econtact" value="<?php echo $econtact ?>" name="econtact" placeholder="Contact no." maxlength="11" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="erela">Relation <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="erela" value="<?php echo $erela ?>" name="erela" placeholder="Relation" required>
                                </div>
                            </div>
                            <h3 class="pt-3 pb-3">Family Details</h3>
                            <div id="edit-family-body" class="mb-3">

                            </div>
                            <input type="hidden" id="e-fam-ctr" name="fam-ctr">
                            <div id="fam-handler" class="form-group">
                                <button type='button' class="btn btn-outline-primary btn-lg add-button">Add Family Member</button>
                            </div>
                            <h3 class="pt-3 pb-3">Prisoner Image</h3>
                            <div class="row">
                                <label for="police_pic">Add a picture <span style="color:red;">(Leave blank if there are no changes)</span></label>
                                <div class="form-group col">
                                    <input type="file" id="police_pic" name="prisoner_pic">
                                </div>
                                <div class="form-group col-7">
                                    <span><strong>Preview :</strong></span>
                                    <br>
                                    <img id="product_img_container" height="150px" width="150px" src="<?php echo $prisoner_pic ?>" alt="">
                                    <input type="hidden" value="<?php echo $prisoner_pic ?>" name="current_prisoner_pic">
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $prisoner_pic ?>" name="oldname">
                            <input type="hidden" value="<?php echo $prisoner_id ?>" name="id">
                            <input type="hidden" name="remove">
                            <div class="form-row mt-3">
                                <div class="col-auto">
                                    <input type="submit" class="btn btn-success btn-lg btn-block" id="add" name="edit_prisoner" value="Edit">
                                </div>
                                <div class="col-auto">
                                    <button type='button' class="btn btn-danger btn-lg btn-block" id="cancel" data-whatever="prisoner-directory">Cancel</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <?php include "profile.php";  ?>
        </div>
    </div>

    <script>
        var product_img = document.getElementById('police_pic');
        product_img.onchange = function(event) {
            const [file] = product_img.files
            if (file) {
                document.getElementById('product_img_container').src = URL.createObjectURL(file);
            }
        }
    </script>
    <script src="custom.js"></script>
    <script src="js_new/jquery.min.js"></script>
    <script src="js_new/bootstrap.bundle.min.js"></script>
    <script src="js_new/custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
</body>
<script>
    var rec = '<?php echo $prisoner_id ?>'
    var cid = '<?php echo $cid ?>'
    var cp = "<?php echo $cpname ?>"

    $('#p-cell').append($("<option> </option>").val(cid).html(cp).hide())
    $.ajax({
        type: 'POST',
        url: 'actions.php',
        data: {
            getOpt: 'get'
        },
        cache: false,
        success: function(data1) {
            var obj = JSON.parse(data1)
            var ctr = obj.length
            for (let i = 0; i < ctr; i++) {
                var cname = obj[i]['cell']
                var pname = obj[i]['prison']
                var id = obj[i]['id']
                var htl = pname + " - " + cname
                $('#p-cell').append($("<option> </option>").val(id).html(htl))
                $('#p-cell').selectpicker('refresh');
            }

        },
        error: function(xhr, status, error) {
            console.error(xhr)
            console.error(error)
        }

    })

    var fam_ctr = '<?php echo json_encode($fam_array) ?>'
    var fam_ctr = JSON.parse(fam_ctr);
    var remove = [];
    for (var i = 0; fam_ctr.length > i; ++i) {
        var ctr = i
        var inner = '<div class="mem-' + i + '"><h5 class="my-3">Edit Family Member</h5><div class=" border border-secondary p-5"><div class="row"><div class="form-group col"><label for="ename">Name <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famname" name="efamname[]" placeholder="Name" value="' + fam_ctr[i][1] + '" required></div></div><div class="row"><div class="form-group col"><label for="ename">Age <span class="text-danger">(Required)</span></label><input type="number" class="form-control" id="famage" name="efamage[]" placeholder="Age" value="' + fam_ctr[i][2] + '" required></div></div><div class="row"><div class="form-group col"><label for="sex">Sex assigned at Birth<span class="text-danger">(Required)</span></label><select type="text" class="form-control" id="famsex" name="efamsex[]" placeholder="Sex" required><option value="' + fam_ctr[i][3] + '" selected hidden>' + fam_ctr[i][3] + '</option><option value="Male">Male</option><option value="Female">Female</option></select></div></div><div class="row"><div class="form-group col"><label for="erela">Relation <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famrela" name="efamrela[]" placeholder="Relation" value="' + fam_ctr[i][4] + '" required></div></div><div class="row"><div class="form-group col"><label for="erela">Occupation / Source of Income <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="occ" name="eocc[]" placeholder="Occupation / Source of Income" value="' + fam_ctr[i][5] + '" required></div><div class="form-group d-flex justify-content-end"><input type="hidden" name="type_id[]" value="' + fam_ctr[i][0] + '"><button type="button" class="btn btn-outline-danger remove-button" data-id="' + i + '" data-whatever="' + fam_ctr[i][0] + '">Remove</button></div></div></div></div>'
        $('#edit-family-body').append(inner).hide().show('slow')
    }
    var fam_ctr1 = 0
    $('#e-fam-ctr').val(fam_ctr1);
    $(".add-button").click(function() {
        fam_ctr1++
        var inner = '<div class="mem-' + i + '"><h5 class="my-3">Add Family Member</h5><div class=" border border-secondary p-5"><div class="row"><div class="form-group col"><label for="ename">Name <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famname" name="famname[]" placeholder="Name" value="" required></div></div><div class="row"><div class="form-group col"><label for="ename">Age <span class="text-danger">(Required)</span></label><input type="number" class="form-control" id="famage" name="famage[]" placeholder="Age" value="" required></div></div><div class="row"><div class="form-group col"><label for="sex">Sex assigned at Birth<span class="text-danger">(Required)</span></label><select type="text" class="form-control" id="famsex" name="famsex[]" placeholder="Sex" required><option value="Male" selected>Male</option><option value="Female">Female</option></select></div></div><div class="row"><div class="form-group col"><label for="erela">Relation <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="famrela" name="famrela[]" placeholder="Relation" value="" required></div></div><div class="row"><div class="form-group col"><label for="erela">Occupation / Source of Income <span class="text-danger">(Required)</span></label><input type="text" class="form-control" id="occ" name="occ[]" placeholder="Occupation / Source of Income" value="" required></div><div class="form-group d-flex justify-content-end"><button type="button" class="btn btn-outline-danger remove-button" id="r-button" data-id="' + i++ + '" data-whatever="no">Remove</button></div></div></div></div>'

        $('#edit-family-body').append(inner).hide().show('slow');
        $('#e-fam-ctr').val(fam_ctr1);
    })
    $('body').on('click', '.remove-button', function() {
        var data = $(this).data('whatever')
        if (data == 'no') {
            var id = $(this).data('id')
            var elem = '.mem-' + id
            $(elem).hide('slow', function() {
                $(elem).remove()
            });
            ctr--
            fam_ctr1--
            $('#e-fam-ctr').val(fam_ctr1);
        } else {
            var id = $(this).data('id')
            var elem = '.mem-' + id
            remove.push(data)
            var stringi = JSON.stringify(remove);
            $("input[name='remove']").val(stringi)
            $(elem).hide('slow', function() {
                $(elem).remove()
            });
        }

    })
</script>

</html>