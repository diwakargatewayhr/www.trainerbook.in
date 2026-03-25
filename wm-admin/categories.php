<?php
include("../includes/config.php");
if ($_SESSION['AdminID'] < '1') {
    header("location:login");
}
$category = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `category` WHERE `cat_id` = '" . @$_REQUEST['edit'] . "'"));
if (isset($_REQUEST['submit']) && $_REQUEST['category'] != '' && @$_REQUEST['edit'] == '') {
    $random = rand(1, 999999);
    $target_path = "../upload/category/" . $random;
    $target_path = $target_path . basename($_FILES['icon']['name']);
    $FileName = $random . $_FILES['icon']['name'];

    if ($_FILES['icon']['name'] != '') {
        move_uploaded_file($_FILES['icon']['tmp_name'], $target_path);
    } else {
        $FileName = $category['icons'];
    }

    $target_path1 = "../upload/category/" . $random;
    $target_path1 = $target_path1 . basename($_FILES['cover_photo']['name']);
    $FileName1 = $random . $_FILES['cover_photo']['name'];

    if ($_FILES['cover_photo']['name'] != '') {
        move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_path1);
    } else {
        $FileName1 = $category['cover_photo'];
    }
    $category_slug = createSlug($_REQUEST['category']);

    mysqli_query($CONN, "INSERT INTO `category` (`cat_id`, `category`,'category_slug', `icons`, `cover_photo`, `status`) VALUES ('', '" . $_REQUEST['category'] . "','$category_slug', '$FileName', '$FileName1', '" . $_REQUEST['status'] . "')");
    header("location:categories?created=yes");
    exit;
}

if (isset($_REQUEST['submit']) && $_REQUEST['category'] != '' && $_REQUEST['edit'] != '') {
    $random = rand(1, 999999);
    $target_path = "../upload/category/" . $random;
    $target_path = $target_path . basename($_FILES['icon']['name']);
    $FileName = $random . $_FILES['icon']['name'];

    if ($_FILES['icon']['name'] != '') {
        move_uploaded_file($_FILES['icon']['tmp_name'], $target_path);
    } else {
        $FileName = $category['icons'];
    }

    $target_path1 = "../upload/category/" . $random;
    $target_path1 = $target_path1 . basename($_FILES['cover_photo']['name']);
    $FileName1 = $random . $_FILES['cover_photo']['name'];

    if ($_FILES['cover_photo']['name'] != '') {
        move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_path1);
    } else {
        $FileName1 = $category['cover_photo'];
    }
    $category_slug = createSlug($_REQUEST['category']);

    mysqli_query($CONN, "UPDATE `category` SET `category` = '" . $_REQUEST['category'] . "',`category_slug` = '$category_slug', `icons` = '$FileName', `cover_photo` = '$FileName1', `status` = '" . $_REQUEST['status'] . "' WHERE cat_id = '" . $_REQUEST['edit'] . "'");
    header("location:categories?edit=" . $_REQUEST['edit'] . "&updated=yes");
    exit;
}

if (isset($_REQUEST['DelId'])) {
    $result = mysqli_query($CONN, "SELECT `icons`, `cover_photo` FROM `category` WHERE `cat_id` = '" . $_REQUEST['DelId'] . "'");
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['icons']) && file_exists("../upload/category/" . $row['icons'])) {
        unlink("../upload/category/" . $row['icon']);
    }

    if (!empty($row['cover_photo']) && file_exists("../upload/category/" . $row['cover_photo'])) {
        unlink("../upload/category/" . $row['cover_photo']);
    }

    mysqli_query($CONN, "DELETE FROM `category` WHERE `cat_id` = '" . $_REQUEST['DelId'] . "'");
    header("location:categories");
    exit;
}

function createSlug($string)
{
    $slug = strtolower($string);

    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

    $slug = preg_replace('/[\s-]+/', '-', $slug);

    $slug = trim($slug, '-');

    return $slug;
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
            <header id="topbar" class="ph10" style="padding-top:80px;">
                <div class="topbar-right hidden-xs hidden-sm mt5 mr35">
                    <a href="#" class="btn btn-primary btn-sm" title="New Order" onclick="showHide('hidden_div'); return false;">
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
                            <span class="panel-title">Add Category</span>
                        </div>

                        <?php if (@$_REQUEST['created'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Category added successfully!
                            </div>
                        <?php } ?>
                        <?php if (@$_REQUEST['updated'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Category updated successfully!
                            </div>
                        <?php } ?>

                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">

                                <div class="section row mb25 col-md-6">
                                    <label for="refund-policy" class="field-label col-sm-4 ph10">Category</label>
                                    <div class="col-sm-8 ph10">
                                        <input type="text" name="category" class="gui-input" value="<?php echo @$category['category']; ?>">
                                    </div>
                                </div>

                                <div class="section row col-md-6">
                                    <label for="refund-policy" class="field-label col-sm-2 ph10">Status</label>
                                    <div class="col-sm-10 ph10" style="padding-top:14px;">
                                        <input type="radio" name="status" value="Y" <?php if (@$category['status'] == 'Y') { ?> checked<?php } ?>> Active&nbsp;&nbsp;<input type="radio" name="status" value="N" <?php if (@$category['status'] == 'N') { ?> checked<?php } ?>> Inactive
                                    </div>
                                </div>

                                <div class="section row col-md-12">
                                    <label for="refund-policy" class="field-label col-sm-2 ph10">ICON</label>
                                    <div class="col-sm-10 ph10">Icon Width (Width: 256 x Height: 256)
                                        <input type="file" name="icon" class="gui-input">
                                        <?php if (@$category['icons'] != '') { ?><div style="padding:8px 0;">
                                                <img src="../upload/category/<?php echo $category['icons']; ?>" height="160px" alt="">
                                            </div><?php } ?>
                                    </div>
                                </div>

                                <div class="section row col-md-12">
                                    <label for="refund-policy" class="field-label col-sm-2 ph10">Cover Photo</label>
                                    <div class="col-sm-10 ph10">Icon Width (Width: 1920 x Height: 280)
                                        <input type="file" name="cover_photo" class="gui-input">
                                        <?php if (@$category['cover_photo'] != '') { ?><div style="padding:8px 0;">
                                                <img src="../upload/category/<?= @$category['cover_photo'] ?>" width="480px" alt="">
                                            </div><?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if (@$_REQUEST['edit'] != '') { ?>UPDATE<?php } else { ?>ADD<?php } ?> CATEGORY">
                </div>

            </form>
            <!-- /Content  -->

            <!--  Content  -->
            <section id="content" class="table-layout animated fadeIn">

                <!--  Column Center  -->
                <div class="chute chute-center" style="padding-top:0px;">

                    <!-- Products Status Table -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title hidden-xs">Service Categories</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th width="10%">Sl. No.</th>
                                                    <th width="10%">Icon</th>
                                                    <th width="20%">Categories</th>
                                                    <th width="30%">Cover Photo</th>
                                                    <th width="15%">Status</th>
                                                    <th width="15%" class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sl = 0;
                                                $result2 = mysqli_query($CONN, "SELECT * FROM `category` ORDER BY `cat_id` DESC");
                                                while ($getValue = mysqli_fetch_array($result2)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <td class="" style="text-align:left;"><img src="../upload/category/<?php echo $getValue['icons']; ?>" height="160px" alt="" /></td>
                                                        <td class="" style="text-align:left;"><?php echo $getValue['category']; ?></td>
                                                        <td class="" style="text-align:left;"><img src="../upload/category/<?php echo $getValue['cover_photo']; ?>" height="160px" alt="" /></td>
                                                        <td><?php if ($getValue['status'] == 'Y') { ?> <span class="label label-success">Active</span><?php } ?><?php if ($getValue['status'] == 'N') { ?> <span class="label label-danger">Inactive</span><?php } ?></td>
                                                        <td class="text-right">
                                                            <div class="btn-group text-right">
                                                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                                    <span class="caret ml5"></span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li>
                                                                        <a href="categories?edit=<?php echo $getValue['cat_id']; ?>">Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="categories?DelId=<?php echo $getValue['cat_id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                                    </li>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <!-- /Scripts -->

</body>

</html>