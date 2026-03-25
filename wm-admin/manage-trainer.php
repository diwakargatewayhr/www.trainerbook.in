<?php include("../includes/config.php");
if ($_SESSION['AdminID'] < '1') {
    header("location:login");
}

if (isset($_REQUEST['submit']) && $_REQUEST['edit'] == '') {
    $image_random = rand(1, 999999);
    $image_target_path = null;
    $ImageFileName = null;

    if (!empty($_FILES['trainer_image']['name'])) {
        $image_target_path = "../upload/profile/" . $image_random . basename($_FILES['trainer_image']['name']);
        $ImageFileName = $image_random . $_FILES['trainer_image']['name'];
        move_uploaded_file($_FILES['trainer_image']['tmp_name'], $image_target_path);
    }

    $ImageFileNameSQL = $ImageFileName ? "'" . mysqli_real_escape_string($CONN, $ImageFileName) . "'" : 'NULL';

    mysqli_query($CONN, "INSERT INTO `user_register` (
        `fullname`, 
        `category`, 
        `location`, 
        `email`, 
        `phone`, 
        `pricing`, 
        `training_mode`, 
        `experience`, 
        `train_batches`, 
        `education`, 
        `training_type`, 
        `user_image`, 
        `city`, 
        `status`, 
        `datetime`
    ) VALUES (
        '" . $_REQUEST['trainer_name'] . "', 
        '" . $_REQUEST['category'] . "', 
        '" . $_REQUEST['location'] . "', 
        '" . $_REQUEST['email'] . "', 
        '" . $_REQUEST['phone'] . "', 
        '" . $_REQUEST['pricing'] . "', 
        '" . $_REQUEST['mode'] . "', 
        '" . $_REQUEST['experience'] . "', 
        '" . $_REQUEST['train_batches'] . "', 
        '" . $_REQUEST['education'] . "', 
        '" . $_REQUEST['training_type'] . "', 
        $ImageFileNameSQL,
        '" . $_REQUEST['course_cities'] . "',
        'Y',  
        now()
    )");
    header("location:manage-trainer?created=yes");
    exit;
}


$trainers = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `id` = '" . @$_REQUEST['edit'] . "'"));

if (isset($_REQUEST['submit']) && $_REQUEST['trainer_name'] != '' && $_REQUEST['edit'] != '') {
    $pid = $_REQUEST['edit'];

    $existingDataQuery = "SELECT `user_image` FROM `user_register` WHERE `id` = '$pid'";
    $existingDataResult = mysqli_query($CONN, $existingDataQuery);
    $existingData = mysqli_fetch_assoc($existingDataResult);

    $imageFileName = $existingData['user_image'];


    if ($_FILES['trainer_image']['error'] === UPLOAD_ERR_OK) {
        $image_random = rand(1, 999999);
        $image_target_path = "../upload/profile/" . $image_random . basename($_FILES['trainer_image']['name']);
        $imageFileName = $image_random . $_FILES['trainer_image']['name'];
        move_uploaded_file($_FILES['trainer_image']['tmp_name'], $image_target_path);
    }
    $imageFileNameSQL = $imageFileName ? "'" . mysqli_real_escape_string($CONN, $imageFileName) . "'" : 'NULL';

    mysqli_query($CONN, "UPDATE user_register SET 
        `fullname` = '" . $_REQUEST['trainer_name'] . "', 
        `category` = '" . $_REQUEST['category'] . "', 
        `location` = '" . $_REQUEST['location'] . "', 
        `email` = '" . $_REQUEST['email'] . "', 
        `phone` = '" . $_REQUEST['phone'] . "', 
        `pricing` = '" . $_REQUEST['pricing'] . "', 
        `training_mode` = '" . $_REQUEST['mode'] . "', 
        `experience` = '" . $_REQUEST['experience'] . "', 
        `train_batches` = '" . $_REQUEST['train_batches'] . "', 
        `education` = '" . $_REQUEST['education'] . "', 
        `training_type` = '" . $_REQUEST['training_type'] . "', 
        `city` = '" . $_REQUEST['course_cities'] . "', 
        `user_image` = $imageFileNameSQL, 
        `status` = 'Y',  
        `datetime` = NOW()
    WHERE `id` = '" . $_REQUEST['edit'] . "'");

    header("location:manage-trainer?created=yes");
    exit;
}


// if(isset($_REQUEST['DelId'])!='')
// {
// 	mysqli_query($CONN, "DELETE FROM `products` WHERE `proid` = '".$_REQUEST['DelId']."' ");
// 	header("location:manage-trainer"); exit;
// }

if (isset($_REQUEST['DelId'])) {
    $result = mysqli_query($CONN, "SELECT `user_image` FROM `user_register` WHERE `id` = '" . $_REQUEST['DelId'] . "'");
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['user_image']) && file_exists("../upload/profile/" . $row['user_image'])) {
        unlink("../upload/profile/" . $row['icon']);
    }

    mysqli_query($CONN, "DELETE FROM `user_register` WHERE `id` = '" . $_REQUEST['DelId'] . "' ");
    header("location:manage-trainer");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>Manage Trainers - <?php echo $adminTitle; ?> - Admin Control Panel</title>
    <meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme" />
    <meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="WebMantra Technologies">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/pagination.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.min.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css" />
    <!-- -------------- Plugins -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/c3charts/c3.min.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo '../upload/logo/' . $portalSetting['favicon']; ?>">

    <!-- -------------- IE8 HTML5 support  -------------- -->
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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>

    <style type="text/css">
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <script src="https://cdn.tiny.cloud/1/rjb1e962cmfd1fjuhwwko1efcs3h8khf28a9ku3zhs9t6hkh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            height: "300"
        });
    </script>

</head>

<body class="sales-stats-page">

    <?php include 'templates/wm-customizer.php'; ?>

    <!-- -------------- Body Wrap  -------------- -->
    <div id="main">

        <?php include 'templates/wm-header.php'; ?>

        <?php include 'templates/wm-sidebar.php'; ?>

        <!-- -------------- Main Wrapper -------------- -->
        <section id="content_wrapper">
            <?php include 'templates/main-wrapper.php'; ?>

            <!-- -------------- Topbar -------------- -->
            <header id="topbar" class="ph10" style="padding-top:80px;">
                <?php if (@$_SESSION['AdminID'] == '1') { ?><div class="topbar-right mt5 mr35 topbar_right_area">
                        <a href="#" class="btn btn-primary btn-sm ml10" title="New Order" onClick="showHide('hidden_div'); return false;">
                            <span class="fa fa-plus pr5"></span>Add Trainer</a>
                        <!--<a href="sales-stats-products.html" class="btn btn-primary btn-sm ml10" title="New Product">
                    <span class="fa fa-plus pr5"></span><span class="fa fa-shopping-cart pr5"></span></a>
                <a href="sales-stats-clients.html" class="btn btn-primary btn-sm ml10" title="New User">
                    <span class="fa fa-plus pr5"></span><span class="fa fa-user pr5"></span></a>-->
                    </div><?php } ?>
            </header>
            <!-- -------------- /Topbar -------------- -->

            <?php if (@$_REQUEST['created'] == 'yes') { ?>
                <div class="alert alert-success dark alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <i class="fa fa-info pr10"></i> Congrats! Trainer added successfully!
                </div>
            <?php } ?>

            <!-- -------------- Content -------------- -->
            <form action="" method="post" enctype="multipart/form-data" name="form1">
                <div class="mw1000 center-block" id="hidden_div" <?php if (@$_REQUEST['edit'] == '') { ?> style="display:none;" <?php } ?>>
                    <!-- -------------- Change Password -------------- -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title">Add Trainer</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Trainer Name</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="trainer_name" class="gui-input" value="<?php echo @$trainers['fullname'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Category</label>
                                        <div class="col-sm-8 ph10">
                                            <label class="field select">
                                                <select name="category" class="gui-input" id="category-dropdown" required>
                                                    <option value="">Select Category...</option>
                                                    <?php $getCountry = mysqli_query($CONN, "SELECT * FROM `category` ORDER BY `cat_id` ASC");
                                                    while ($countryArr = mysqli_fetch_array($getCountry)) { ?>
                                                        <option <?php if (@$trainers['category'] == $countryArr['cat_id']) { ?> selected <?php } ?> value="<?php echo @$countryArr['cat_id']; ?>"><?php echo @$countryArr['category']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i class="arrow double"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Sub Category</label>
                                        <div class="col-sm-8 ph10">
                                            <label class="field select">
                                                <select name="sub_category" id="sub-category-dropdown" class="gui-input">
                                                    <option value="">Select Sub Category...</option>
                                                    <?php $getCountry1 = mysqli_query($CONN, "SELECT * FROM `subcategory` WHERE `category_id` = '" . @$trainers['category'] . "'");
                                                    while ($countryArr1 = mysqli_fetch_array($getCountry1)) { ?>
                                                        <option <?php if (@$trainers['sub_category'] == $countryArr1['id']) { ?> selected <?php } ?> value="<?php echo @$countryArr1['id']; ?>"><?php echo @$countryArr1['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i class="arrow double"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Cities</label>
                                        <div class="col-sm-8 ph10">
                                            <label class="field select">
                                                <select name="course_cities" class="gui-input" required>
                                                    <option value="">Select Category...</option>
                                                    <?php $getCities = mysqli_query($CONN, "SELECT * FROM `city` Where `status` = 'Y' ");
                                                    while ($cities = mysqli_fetch_array($getCities)) { ?>
                                                        <option <?php if (@$trainers['city'] == $cities['id']) { ?> selected <?php } ?> value="<?php echo @$cities['id']; ?>"><?php echo @$cities['city']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i class="arrow double"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="location" class="field-label col-sm-4 ph10">Service Location</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="location" class="gui-input" value="<?php echo @$trainers['location'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="email" class="field-label col-sm-4 ph10">Email ID</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="email" name="email" class="gui-input" value="<?php echo @$trainers['email'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="phone" class="field-label col-sm-4 ph10">Phone No</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="tel" name="phone" class="gui-input" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" value="<?php echo @$trainers['phone'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="pricing" class="field-label col-sm-4 ph10">Pricing</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="number" name="pricing" class="gui-input" value="<?php echo @$trainers['pricing'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="mode" class="field-label col-sm-4 ph10">Training Mode</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="mode" class="gui-input" value="<?php echo @$trainers['training_mode'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="experience" class="field-label col-sm-4 ph10">Year of Experience</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="number" name="experience" class="gui-input" value="<?php echo @$trainers['experience'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="train-batches" class="field-label col-sm-4 ph10">No of Batches</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="number" name="train_batches" class="gui-input" value="<?php echo @$trainers['train_batches'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="education" class="field-label col-sm-4 ph10">Education</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="education" class="gui-input" value="<?php echo @$trainers['education'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="training-type" class="field-label col-sm-4 ph10">Type of Training</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="training_type" class="gui-input" value="<?php echo @$trainers['training_type'] ?>"></input>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">CV (Pdf only)</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="trainer_cv" class="gui-input" <?php if (@$_REQUEST['edit'] == '') { ?> required <?php } ?>>
                                            <img src="../upload/profile/<?php echo @$trainers['trainer_cv']; ?>" width="80" alt="" />
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Trainer Image</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="trainer_image" class="gui-input" <?php if (@$_REQUEST['edit'] == '') { ?> required <?php } ?>>
                                            <img src="../upload/profile/<?php echo @$trainers['user_image']; ?>" width="80" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="padding-right:23px;"><input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if (@$_REQUEST['edit'] != '') { ?>UPDATE<?php } else { ?>ADD<?php } ?> Trainer"></div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- -------------- /Content -------------- -->

            <!-- -------------- Content -------------- -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- -------------- Column Center -------------- -->
                <div class="chute chute-center" style="padding-top:0px;">

                    <!-- -------------- Products Status Table -------------- -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title ">Manage Trainers</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="table-responsive responsive_table_area">
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="">Sl. No.</th>
                                                    <th class="">Trainer Image</th>
                                                    <th class="">Trainer Name</th>
                                                    <th class="">Type</th>
                                                    <th class="">Price</th>
                                                    <th class="">Status</th>
                                                    <!--<th class="">Registered On</th>-->
                                                    <?php if ($_SESSION['AdminID'] == '1') { ?><th class="text-right">Options</th><?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sl = 0;
                                                if (@$_REQUEST['search'] == '') {
                                                    $result = mysqli_query($CONN, "SELECT * FROM `user_register`");
                                                }
                                                if (@$_REQUEST['search'] != '') {
                                                    $result = mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `fullname` LIKE '%" . $_REQUEST['search'] . "%'");
                                                }

                                                while ($getValue = mysqli_fetch_array($result)) {
                                                    $sl++;
                                                ?>
                                                    <tr class="order_item">
                                                        <td><?php echo $sl; ?></td>
                                                        <td data-title="Name"><?php echo $getValue['fullname']; ?></td>
                                                        <td data-title="Name"><img src="../upload/profile/<?php echo @$getValue['user_image']; ?>" alt="" width="80"></td>
                                                        <td class="" style="text-align:left;" data-title="Type">Physical</td>
                                                        <td class="" data-title="Price">₹<?php echo $getValue['pricing']; ?></td>
                                                        <td class="" data-title="Status"><?php if ($getValue['status'] == 'Y') { ?><span class="label label-success">Active</span><?php } ?><?php if ($getValue['status'] == 'N') { ?><span class="label label-danger">Inactive</span></span><?php } ?></td>

                                                        <?php if ($_SESSION['AdminID'] == '1') { ?><td class="text-right" data-title="Options">
                                                                <div class="btn-group text-right">
                                                                    <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                                        <span class="caret ml5"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><a href="manage-trainer?edit=<?php echo $getValue['id']; ?>">Edit</a></li>
                                                                        <li><a href="manage-documents?trainer=<?php echo $getValue['id']; ?>">Add Documents</a></li>
                                                                        <li><a href="manage-videos?trainer=<?php echo $getValue['id']; ?>">Add Videos</a></li>
                                                                        <li><a href="manage-trainer?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td><?php } ?>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div><? //=$pagination
                            ?></div>
                </div>
                <!-- -------------- /Column Center -------------- -->

            </section>
            <!-- -------------- /Content -------------- -->

        </section>


    </div>
    <!-- -------------- /Body Wrap  -------------- -->

    <!-- -------------- Scripts -------------- -->

    <!-- -------------- jQuery -------------- -->
    <script src="assets/js/jquery/jquery-1.11.3.min.js"></script>
    <script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- -------------- JvectorMap Plugin -------------- -->
    <script src="assets/js/plugins/jvectormap/jquery.jvectormap.min.js"></script>
    <script src="assets/js/plugins/jvectormap/assets/jquery-jvectormap-world-mill-en.js"></script>

    <!-- -------------- HighCharts Plugin -------------- -->
    <script src="assets/js/plugins/highcharts/highcharts.js"></script>
    <script src="assets/js/plugins/c3charts/d3.min.js"></script>
    <script src="assets/js/plugins/c3charts/c3.min.js"></script>

    <!-- -------------- Theme Scripts -------------- -->
    <script src="assets/js/utility/utility.js"></script>
    <script src="assets/js/demo/demo.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/demo/widgets_sidebar.js"></script>
    <script src="assets/js/pages/dashboard2.js"></script>

    <!-- -------------- Page JS -------------- -->
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
                "pageLength": 50,
                buttons: [
                    'csv', 'excel', 'print'
                ]
            });
        });
    </script>

    <!-- -------------- /Scripts -------------- -->
    <script>
        $(document).ready(function() {
            $('#category-dropdown').on('change', function() {
                var category_id = this.value;
                $.ajax({
                    url: "fetch-subcategory.php",
                    type: "POST",
                    data: {
                        category_id: category_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#sub-category-dropdown").html(result);
                    }
                });
            });

            $('#sub-category-dropdown').on('change', function() {
                var subcat = this.value;
                $.ajax({
                    url: "fetch-subsubcategory.php",
                    type: "POST",
                    data: {
                        subcat: subcat
                    },
                    cache: false,
                    success: function(result) {
                        $("#sub-sub-category-dropdown").html(result);
                    }
                });
            });
        });
    </script>
    <script>
        function addInput() {
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'whats_included[]';
            newInput.className = 'gui-input';

            document.getElementById('inputContainer').appendChild(newInput);

            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Remove';
            removeButton.onclick = function() {
                document.getElementById('inputContainer').removeChild(newInput);
                document.getElementById('inputContainer').removeChild(removeButton);
            };

            document.getElementById('inputContainer').appendChild(removeButton);
        }
    </script>

</body>

</html>