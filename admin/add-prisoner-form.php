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
    <title>Add Prisoner</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link href="css_new/bootstrap.min.css" rel="stylesheet">
    <link href="css_new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css_new/custom.min.css" rel="stylesheet">


    <link href="assets/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
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
                                            <li class="breadcrumb-item active">Add Prisoner</li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <div class="form-group text-center">
                            <h3 class="mb-4" style="text-align: center;">New Prisoner Entry</h3>
                        </div>
                        <?php
                        if (isset($_GET['status'])) {
                            $status  = $_GET['status'];
                            $message = $_GET['message'];

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
                        ?>
                        <form class="form shadow p-5 bg-white rounded" role="alert" method="POST" enctype="multipart/form-data" action="actions.php">
                            <h3 class="pt-3 pb-3">Prisoner Info</h3>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="code">Prisoner Code <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Code" maxlength="6" required>
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
                                    <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name" required>
                                </div>
                                <div class="form-group col">
                                    <label for="mName">Middle Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="mName" name="mName" placeholder="Middle Name" required>
                                </div>
                                <div class="form-group col">
                                    <label for="lName">Last Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Alias <span class="text-danger">(Required)</span></label>
                                <input class="form-control" id="alias" name="alias" placeholder="Alias" required>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="bday">Birthday <span class="text-danger">(Required)</span></label>
                                    <input type="date" class="form-control" id="bday" name=" bday" placeholder="Birthday" required>
                                </div>
                                <div class="form-group col">
                                    <label for="sex">Sex assigned at Birth <span class="text-danger">(Required)</span></label>
                                    <select type="text" class="form-control" id="sex" name="sex" placeholder="sex" required>
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <label for="address">Address <span class="text-danger">(Required)</span></label>
                                    <textarea class="resizable_textarea form-control" id="address" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="marital">Marital Status <span class="text-danger">(Required)</span></label>
                                    <select class="form-control" id="marital" name="marital" placeholder="Crime" required>
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
                                    <input type="text" class="form-control" id="comp" name="comp" placeholder="Complexion" required>
                                </div>
                                <div class="form-group col">
                                    <label for="ecolor">Eye Color <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="ecolor" name="ecolor" placeholder="Eye Color">
                                </div>
                            </div>
                            <h3 class="pt-3 pb-3">Case Details</h3>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="crime">Crime Committed <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="crime" name="crime" placeholder="Crime" required>
                                </div>
                                <div class="form-group col">
                                    <label for="sen">Sentence <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="sen" name="sentence" placeholder="Sentence" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="cont">Discharge Date <span class="text-danger">(Required)</span></label>
                                    <input type="date" class="form-control" id="cont" name="ddate" placeholder="discharge" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="status">Status <span class="text-danger">(Required)</span></label>
                                    <select type="text" class="form-control" id="status" name="status" required>
                                        <option value="Jailed">Jailed</option>
                                        <option value="Released">Released</option>
                                    </select>
                                </div>
                            </div>
                            <h3 class="pt-3 pb-3">Emergency Contact Details</h3>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="ename">Name <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="ename" name="ename" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="econtact">Contact no. <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="econtact" name="econtact" placeholder="Contact no." maxlength="11" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="erela">Relation <span class="text-danger">(Required)</span></label>
                                    <input type="text" class="form-control" id="erela" name="erela" placeholder="Relation" required>
                                </div>
                            </div>
                            <h3 class="pt-3 pb-3">Family Details</h3>
                            <div id="family-body" class="mb-3">

                            </div>
                            <input type="hidden" id="fam-ctr" name="fam-ctr">
                            <div id="fam-handler" class="form-group">
                                <button type='button' class="btn btn-outline-primary btn-lg" id="add-button">Add Family Member</button>
                            </div>
                            <h3 class="pt-3 pb-3">Prisoner Image</h3>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="police_pic">Add a picture</label>
                                    <br>
                                    <input type="file" id="police_pic" name="prisoner_pic">

                                </div>
                                <div class="form-group col-7">
                                    <span><strong>Preview :</strong></span>
                                    <br>
                                    <img id="product_img_container" height="150px" width="150px" src="../logo copy.png" alt="">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-auto">
                                    <input type="submit" class="btn btn-success btn-lg btn-block" id="add" name="add_prisoner" value="Add">
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
        <footer>
            <div class="pull-right">
                <strong>Copyright &copy; 2022 <a href="#">Prison Management</a>.</strong> All rights reserved.
            </div>
            <div class="clearfix"></div>
        </footer>
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

</body>
<script>
    $(function() {
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

    })
</script>
<script src="custom.js"></script>
<script src="js_new/jquery.min.js"></script>
<script src="js_new/bootstrap.bundle.min.js"></script>
<script src="js_new/custom.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</html>