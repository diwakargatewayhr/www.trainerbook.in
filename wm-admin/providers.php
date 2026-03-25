<?php include("../includes/config.php");
if ($_SESSION['AdminID'] < '1') {
    header("location:login");
}
$category = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `id` = '" . @$_REQUEST['edit'] . "'"));

if (isset($_REQUEST['submit']) && $_REQUEST['fullname'] != '' && $_REQUEST['edit'] == '') {
    $random = rand(1, 999999);
    $target_path = "../upload/profile/" . $random;
    $target_path = $target_path . basename($_FILES['profile_pic']['name']);
    $FileName = $random . $_FILES['profile_pic']['name'];

    if ($_FILES['profile_pic']['name'] != '') {
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_path);
    } else {
        $FileName = $category['profile_pic'];
    }

    $target_path1 = "../upload/profile/" . $random;
    $target_path1 = $target_path1 . basename($_FILES['pan_pic']['name']);
    $FileName1 = $random . $_FILES['pan_pic']['name'];

    if ($_FILES['pan_pic']['name'] != '') {
        move_uploaded_file($_FILES['pan_pic']['tmp_name'], $target_path1);
    } else {
        $FileName1 = $category['pan_pic'];
    }

    $target_path2 = "../upload/profile/" . $random;
    $target_path2 = $target_path2 . basename($_FILES['aadhar_pic']['name']);
    $FileName2 = $random . $_FILES['aadhar_pic']['name'];

    if ($_FILES['aadhar_pic']['name'] != '') {
        move_uploaded_file($_FILES['aadhar_pic']['tmp_name'], $target_path2);
    } else {
        $FileName2 = $category['aadhar_pic'];
    }

    mysqli_query($CONN, "INSERT INTO `user_register` (`id`, `fullname`, `phone`, `email`,`type`, `aadhaar`, `pan_card`, `dateofbirth`, `gender`, `profile_pic`, `bank_name`, `account_holder`, `ifsc_code`, `bank_branch`, `account_number`, `date`, `pan_pic`, `aadhar_pic`, `status`, `datetime`) VALUES ('', '" . $_REQUEST['fullname'] . "', '" . $_REQUEST['phone'] . "', '" . $_REQUEST['email'] . "','P', '" . $_REQUEST['aadhaar'] . "', '" . $_REQUEST['pan_card'] . "', '" . $_REQUEST['dateofbirth'] . "', '" . $_REQUEST['gender'] . "', '$FileName',  '" . $_REQUEST['bank_name'] . "', '" . $_REQUEST['account_holder'] . "', '" . $_REQUEST['ifsc_code'] . "', '" . $_REQUEST['bank_branch'] . "', '" . $_REQUEST['account_number'] . "', '" . date('d M, Y') . "','$FileName1', '$FileName2', 'Y',  now())");
    header("location:providers?created=yes");
    exit;
}

if (isset($_REQUEST['submit']) && $_REQUEST['fullname'] != '' && $_REQUEST['edit'] != '') {
    $random = rand(1, 999999);
    $target_path = "../upload/profile/" . $random;
    $target_path = $target_path . basename($_FILES['profile_pic']['name']);
    $FileName = $random . $_FILES['profile_pic']['name'];

    if ($_FILES['profile_pic']['name'] != '') {
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_path);
    } else {
        $FileName = $category['profile_pic'];
    }

    $target_path = "../upload/profile/" . $random;
    $target_path1 = $target_path1 . basename($_FILES['pan_pic']['name']);
    $FileName1 = $random . $_FILES['pan_pic']['name'];

    if ($_FILES['pan_pic']['name'] != '') {
        move_uploaded_file($_FILES['pan_pic']['tmp_name'], $target_path1);
    } else {
        $FileName1 = $category['pan_pic'];
    }


    $target_path2 = "../upload/profile/" . $random;
    $target_path2 = $target_path2 . basename($_FILES['pan_pic']['name']);
    $FileName2 = $random . $_FILES['pan_pic']['name'];

    if ($_FILES['pan_pic']['name'] != '') {
        move_uploaded_file($_FILES['pan_pic']['tmp_name'], $target_path2);
    } else {
        $FileName2 = $category['pan_pic'];
    }



    if ($_FILES['profile_pic'] != '') {
        mysqli_query($CONN, "UPDATE `user_register` SET `fullname` = '" . $_REQUEST['fullname'] . "', `phone` = '" . $_REQUEST['phone'] . "', `email` = '" . $_REQUEST['email'] . "',`type` = 'P' ,`profile_pic` = '$FileName', `pan_pic` = '$FileName1', `aadhar_pic` = '$FileName2', `aadhaar` = '" . $_REQUEST['aadhaar'] . "', `pan_card` = '" . $_REQUEST['pan_card'] . "', `dateofbirth` = '" . $_REQUEST['dateofbirth'] . "', `gender` = '" . $_REQUEST['gender'] . "', `bank_name` = '" . $_REQUEST['bank_name'] . "', `account_holder` = '" . $_REQUEST['account_holder'] . "', `ifsc_code` = '" . $_REQUEST['ifsc_code'] . "', `bank_branch` = '" . $_REQUEST['bank_branch'] . "', `account_number` = '" . $_REQUEST['account_number'] . "' WHERE `id` = '" . $_REQUEST['edit'] . "'");
        header("location:providers?edit=" . $_REQUEST['edit'] . "&updated=yes");
        exit;
    }
    if ($_FILES['profile_pic'] == '') {
        mysqli_query($CONN, "UPDATE `user_register` SET `fullname` = '" . $_REQUEST['fullname'] . "', `phone` = '" . $_REQUEST['phone'] . "', `email` = '" . $_REQUEST['email'] . "',`type` = 'P' , `aadhaar` = '" . $_REQUEST['aadhaar'] . "', `pan_card` = '" . $_REQUEST['pan_card'] . "', `pan_pic` = '$FileName1', `aadhar_pic` = '$FileName2', `dateofbirth` = '" . $_REQUEST['dateofbirth'] . "', `gender` = '" . $_REQUEST['gender'] . "', `bank_name` = '" . $_REQUEST['bank_name'] . "', `account_holder` = '" . $_REQUEST['account_holder'] . "', `ifsc_code` = '" . $_REQUEST['ifsc_code'] . "', `bank_branch` = '" . $_REQUEST['bank_branch'] . "', `account_number` = '" . $_REQUEST['account_number'] . "' WHERE `id` = '" . $_REQUEST['edit'] . "'");
        header("location:providers?edit=" . $_REQUEST['edit'] . "&updated=yes");
        exit;
    }
}

if (@$_REQUEST['pid'] != '' && @$_REQUEST['status'] != '') {
    mysqli_query($CONN, "UPDATE `user_register` SET `status` = '" . $_REQUEST['status'] . "' WHERE `id` = '" . $_REQUEST['pid'] . "' ");
    header("location:providers");
    exit;
}

if (@$_REQUEST['pid'] != '' && @$_REQUEST['type'] != '') {
    mysqli_query($CONN, "UPDATE `user_register` SET `type` = '" . $_REQUEST['type'] . "' WHERE `id` = '" . $_REQUEST['pid'] . "' ");
    header("location:providers");
    exit;
}

if (isset($_REQUEST['DelId']) != '') {
    mysqli_query($CONN, "DELETE FROM `user_register` WHERE `id` = '" . $_REQUEST['DelId'] . "' ");
    header("location:providers");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--  Meta and Title  -->

    <title><?php echo $adminTitle; ?> - Admin Control Panel</title>
    <meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme" />
    <meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="WebMantra Technologies">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  CSS - theme -->
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/pagination.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css">

    <!--  CSS - allcp forms  -->
    <link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.min.css">

    <!--  Plugins -->
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/c3charts/c3.min.css">

    <!--  Favicon  -->
    <link rel="shortcut icon" href="<?php echo '../upload/logo/' . $portalSetting['favicon']; ?>">

    <!--  IE8 HTML5 support  -->
    <!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <script type="text/javascript">
        function showHide(obj) {
            var div = document.getElementById(obj);
            if (div.style.display == 'none') {
                div.style.display = '';
            } else {
                div.style.display = 'none';
            }
        }
    </script>

</head>

<body class="sales-stats-page">

    <?php include 'templates/wm-customizer.php'; ?>

    <!-- Body Wrap  -->
    <div id="main">

        <?php include 'templates/wm-header.php'; ?>

        <?php include 'templates/wm-sidebar.php'; ?>

        <!--  Main Wrapper -->
        <section id="content_wrapper">
            <?php include 'templates/main-wrapper.php'; ?>

            <!-- Topbar -->
            <header id="topbar" class="ph10">
                <div class="topbar-right hidden-xs hidden-sm mt5 mr35">
                    <a href="#" class="btn btn-primary btn-sm ml10" title="New Order" onclick="showHide('hidden_div'); return false;">
                        <span class="fa fa-plus pr5"></span>Add New</a>
                </div>
            </header>
            <!-- /Topbar -->

            <!-- Content  -->
            <form action="" method="post" enctype="multipart/form-data" name="form1">

                <div class="mw1000 center-block" id="hidden_div" <?php if (@$_REQUEST['edit'] == '') { ?> style="display:none;" <?php } ?>>
                    <!-- Change Password -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title">Add Partners</span>
                        </div>

                        <?php if (@$_REQUEST['created'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Partners added successfully!
                            </div>
                        <?php } ?>
                        <?php if (@$_REQUEST['updated'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Partners updated successfully!
                            </div>
                        <?php } ?>

                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Partners Name</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="fullname" class="gui-input" value="<?php echo @$category['fullname']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Email</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="email" class="gui-input" value="<?php echo @$category['email']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Phone No.</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="phone" class="gui-input" value="<?php echo @$category['phone']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Date Of Birth</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="date" name="dateofbirth" class="gui-input" value="<?php echo @$category['dateofbirth']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Password</label>
                                <div class="col-sm-8 ph10">
                                    <input type="password" name="password" class="gui-input">
                                </div>
                            </div></div>-->

                                <div class="col-md-6">
                                    <div class="section row">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Gender</label>
                                        <div class="col-sm-8 ph10" style="padding-top:14px;">
                                            <input type="radio" name="gender" value="Male" <?php if (@$category['gender'] == 'Male') { ?> checked<?php } ?>> Male&nbsp;&nbsp;<input type="radio" name="gender" value="Female" <?php if (@$category['gender'] == 'Female') { ?> checked<?php } ?>> Female
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Status</label>
                                        <div class="col-sm-8 ph10" style="padding-top:14px;">
                                            <input type="radio" name="status" value="Y" <?php if (@$category['status'] == 'Y') { ?> checked<?php } ?>> Active&nbsp;&nbsp;<input type="radio" name="status" value="N" <?php if (@$category['status'] == 'N') { ?> checked<?php } ?>> Inactive
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">PAN Card</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="pan_card" class="gui-input" value="<?php echo @$category['pan_card']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Pan Card Image</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="pan_pic" class="gui-input">
                                            <?php if (@$category['pan_pic'] != '') { ?><img src="../upload/profile/<?php echo @$category['pan_pic']; ?>" height="100px" alt="" /><?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Aadhaar Card No.</label>
                                        <div class="col-sm-8 ph8">
                                            <input type="text" name="aadhaar" class="gui-input" value="<?php echo @$category['aadhaar']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Aadhaar Card Image (Both side)</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="aadhar_pic" class="gui-input">
                                            <?php if (@$category['aadhar_pic'] != '') { ?><img src="../upload/profile/<?php echo @$category['aadhar_pic']; ?>" height="100px" alt="" /><?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Address</label>
                                        <div class="col-sm-8 ph8">
                                            <input type="text" name="address" class="gui-input" value="<?php echo @$category['address']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Bank Name</label>
                                        <div class="col-sm-8 ph8">
                                            <input type="text" name="bank_name" class="gui-input" value="<?php echo @$category['bank_name']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">A/C Holder Name</label>
                                        <div class="col-sm-8 ph8">
                                            <input type="text" name="account_holder" class="gui-input" value="<?php echo @$category['account_holder']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Account No.</label>
                                        <div class="col-sm-8 ph8">
                                            <input type="text" name="account_number" class="gui-input" value="<?php echo @$category['account_number']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">IFSC Code</label>
                                        <div class="col-sm-8 ph8">
                                            <input type="text" name="ifsc_code" class="gui-input" value="<?php echo @$category['ifsc_code']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Bank Branch</label>
                                        <div class="col-sm-8 ph8">
                                            <input type="text" name="bank_branch" class="gui-input" value="<?php echo @$category['bank_branch']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Profile Picture</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="profile_pic" class="gui-input">
                                            <?php if (@$category['profile_pic'] != '') { ?><img src="../upload/profile/<?php echo @$category['profile_pic']; ?>" height="100px" alt="" /><?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if (@$_REQUEST['edit'] != '') { ?>UPDATE<?php } else { ?>ADD<?php } ?>">
                </div>

            </form>
            <!-- /Content  -->

            <!--  Content  -->
            <section id="content" class="table-layout animated fadeIn">

                <!--  Column Center  -->
                <div class="chute chute-center">

                    <!-- Products Status Table -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title hidden-xs">All Partners</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="">Sl. No.</th>
                                                    <th class="">Full Name</th>
                                                    <th class="">Phone No.</th>
                                                    <th class="">Email</th>
                                                    <th class="">Gender</th>
                                                    <th class="">Aadhaar</th>
                                                    <th class="">PAN No.</th>
                                                    <th class="">Registered</th>
                                                    <th class="">Status</th>
                                                    <th class="">Type</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sl = 0;
                                                $result2 = mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `type` = 'P' ORDER BY `id` DESC");
                                                while ($getValue = mysqli_fetch_array($result2)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <td style="text-align:left;"><?php echo $getValue['fullname']; ?></td>
                                                        <td><?php echo $getValue['phone']; ?></td>
                                                        <td><?php echo $getValue['email']; ?></td>
                                                        <td><?php echo $getValue['gender']; ?></td>
                                                        <td><?php echo $getValue['aadhaar']; ?></td>
                                                        <td><?php echo $getValue['pan_card']; ?></td>
                                                        <td><?php echo $getValue['datetime']; ?></td>
                                                        <td style="text-align:left;"><?php if ($getValue['status'] == 'Y') { ?><a href="providers?status=N&pid=<?= $getValue['id'] ?>"><span class="label label-success">Active</span></a><?php } ?><?php if ($getValue['status'] == 'N') { ?><a href="providers?status=Y&pid=<?= $getValue['id'] ?>"><span class="label label-danger">Inactive</span></a><?php } ?></td>
                                                        <td style="text-align:left;"><?php if ($getValue['type'] == 'U') { ?><a href="providers?type=P&pid=<?= $getValue['id'] ?>"><span class="label label-primary">Customer</span></a><?php } ?><?php if ($getValue['type'] == 'P') { ?><a href="providers?status=U&pid=<?= $getValue['id'] ?>"><span class="label label-warning">Professional</span></a><?php } ?></td>
                                                        <td class="text-right">
                                                            <div class="btn-group text-right">
                                                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                                    <span class="caret ml5"></span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <!--<li><a href="providers?edit=<?php echo $getValue['id']; ?>">Edit</a></li>-->
                                                                    <li><a href="earning_log?pid=<?php echo $getValue['id']; ?>">Earning Log</a></li>
                                                                    <li><a href="providers?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div><?= $pagination ?></div>-->
                </div>
                <!-- /Column Center -->

            </section>
            <!-- /Content -->

        </section>

        <!-- Sidebar Right -->
        <aside id="sidebar_right" class="nano affix">

            <!-- Sidebar Right Content -->
            <div class="sidebar-right-wrapper nano-content">

                <div class="sidebar-block br-n p15">

                    <h6 class="title-divider text-muted mb20"> Visitors Stats
                        <span class="pull-right"> 2015
                            <i class="fa fa-caret-down ml5"></i>
                        </span>
                    </h6>

                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: 34%">
                            <span class="fs11">New visitors</span>
                        </div>
                    </div>
                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%">
                            <span class="fs11 text-left">Returnig visitors</span>
                        </div>
                    </div>
                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                            <span class="fs11 text-left">Orders</span>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt30 mb10">New visitors</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">350</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-warning mn">
                                <i class="fa fa-caret-down"></i> 15.7%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt25 mb10">Returnig visitors</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">660</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-success-dark mn">
                                <i class="fa fa-caret-up"></i> 20.2%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt25 mb10">Orders</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">153</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-success mn">
                                <i class="fa fa-caret-up"></i> 5.3%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt40 mb20"> Site Statistics
                        <span class="pull-right text-primary fw600">Today</span>
                    </h6>
                </div>
            </div>
        </aside>
        <!--  /Sidebar Right -->

    </div>
    <!--  /Body Wrap  -->

    <!-- Scripts  -->

    <!--  jQuery  -->
    <script src="assets/js/jquery/jquery-1.11.3.min.js"></script>
    <script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- datatable -->
    <script src="assets/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/js/dataTables.bootstrap.min.js"></script>

    <!-- JvectorMap Plugin -->
    <script src="assets/js/plugins/jvectormap/jquery.jvectormap.min.js"></script>
    <script src="assets/js/plugins/jvectormap/assets/jquery-jvectormap-world-mill-en.js"></script>

    <!-- HighCharts Plugin -->
    <script src="assets/js/plugins/highcharts/highcharts.js"></script>
    <script src="assets/js/plugins/c3charts/d3.min.js"></script>
    <script src="assets/js/plugins/c3charts/c3.min.js"></script>

    <!-- Theme Scripts -->
    <script src="assets/js/utility/utility.js"></script>
    <script src="assets/js/demo/demo.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/demo/widgets_sidebar.js"></script>
    <script src="assets/js/pages/dashboard2.js"></script>

    <!-- Page JS -->
    <script src="assets/js/demo/charts/highcharts.js"></script>
    <script src="assets/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/js/dataTables.bootstrap.min.js"></script>

    <!--<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>-->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                "lengthMenu": [10, 25, 50, 75, 100],
                "pageLength": 25,
                buttons: [
                    'csv', 'excel', 'print'
                ]
            });
        });
    </script>

</body>

</html>