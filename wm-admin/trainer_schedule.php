<?php include("../includes/config.php");
if ($_SESSION['AdminID'] < '1') {
    header("location:login");
}
$trainer_schedule = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `trainer_schedule` WHERE `id` = '" . @$_REQUEST['edit'] . "'"));

if (isset($_POST['submit']) && $_REQUEST['edit'] == '') {
    $course = isset($_POST['course']) ? mysqli_real_escape_string($CONN, $_POST['course']) : '';
    $duration = isset($_POST['duration']) ? mysqli_real_escape_string($CONN, $_POST['duration']) : '';
    $fees = isset($_POST['fees']) ? mysqli_real_escape_string($CONN, $_POST['fees']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($CONN, $_POST['date']) : '';
    $trainer_id = isset($_POST['trainer_name']) ? intval($_POST['trainer_name']) : 0;


    $query = "INSERT INTO `trainer_schedule` (`trainer_name`, `course`, `duration`, `fees`, `date`) 
              VALUES ('$trainer_id', '$course', '$duration', '$fees', '$date')";
    mysqli_query($CONN, $query);
    header("location: trainer_schedule?created=yes");
    exit;
}
if (isset($_REQUEST['submit']) && $_REQUEST['edit'] != '') {
    $pid = $_REQUEST['edit'];

    $course = isset($_POST['course']) ? mysqli_real_escape_string($CONN, $_POST['course']) : '';
    $duration = isset($_POST['duration']) ? mysqli_real_escape_string($CONN, $_POST['duration']) : '';
    $fees = isset($_POST['fees']) ? mysqli_real_escape_string($CONN, $_POST['fees']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($CONN, $_POST['date']) : '';
    $trainer_id = isset($_POST['trainer_name']) ? intval($_POST['trainer_name']) : 0;

    // Update the record in the database
    $updateQuery = "UPDATE `trainer_schedule` SET `trainer_name` = '$trainer_id', `course` = '$course', `duration` = '$duration', `fees` = '$fees', `date` = '$date' WHERE `id` = '$pid'";
    mysqli_query($CONN, $updateQuery);

    header("location: trainer_schedule?updated=yes");
    exit;
}




if (isset($_REQUEST['DelId']) != '') {
    mysqli_query($CONN, "DELETE FROM `trainer_schedule` WHERE `id` = '" . $_REQUEST['DelId'] . "' ");
    header("location:trainer_schedule");
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
            <header id="topbar" class="ph10" style="padding-top:80px;">
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
                            <span class="panel-title">Add Trainer Schedule</span>
                        </div>

                        <?php if (@$_REQUEST['created'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Schedule added successfully!
                            </div>
                        <?php } ?>
                        <?php if (@$_REQUEST['updated'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Schedule updated successfully!
                            </div>
                        <?php } ?>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <div class="section row mb25">
                                            <label for="title" class="field-label col-sm-4 ph10">Trainer Title</label>
                                            <div class="col-sm-8 ph10">
                                                <select class="form-control" name="trainer_name">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $result = mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `status` = 'Y'");
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $selected = (@$trainer_schedule['trainer_name'] == $row['id']) ? 'selected' : '';
                                                    ?>
                                                        <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['fullname']; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="section row mb25">
                                            <label for="title" class="field-label col-sm-4 ph10">Course</label>
                                            <div class="col-sm-8 ph10">
                                                <input type="text" name="course" class="gui-input" value="<?php echo @$trainer_schedule['course']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="section row mb25">
                                            <label for="title" class="field-label col-sm-4 ph10">Duration</label>
                                            <div class="col-sm-8 ph10">
                                                <input type="text" name="duration" class="gui-input" value="<?php echo @$trainer_schedule['duration']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="section row mb25">
                                            <label for="title" class="field-label col-sm-4 ph10">Fees</label>
                                            <div class="col-sm-8 ph10">
                                                <input type="text" name="fees" class="gui-input" value="<?php echo @$trainer_schedule['fees']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="section row mb25">
                                            <label for="title" class="field-label col-sm-4 ph10">Date</label>
                                            <div class="col-sm-8 ph10">
                                                <input type="date" name="date" class="gui-input" value="<?php echo @$trainer_schedule['date']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                <div class="chute chute-center" style="padding-top:0px;">
                    <!-- Products Status Table -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title hidden-xs">All Schedule</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="">Sl. No.</th>
                                                    <th class="">Trainer name</th>
                                                    <th class="">Course</th>
                                                    <th class="">Duration</th>
                                                    <th class="">Fees</th>
                                                    <th class="">Date</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sl = 0;
                                                $result2 = mysqli_query($CONN, "SELECT * FROM `trainer_schedule` ORDER BY `id` DESC");
                                                while ($getValue = mysqli_fetch_array($result2)) {
                                                    $sl++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <td><?php echo @$getValue['trainer_name']; ?></td>
                                                        <td><?php echo @$getValue['course']; ?></td>
                                                        <td><?php echo @$getValue['duration']; ?></td>
                                                        <td><?php echo @$getValue['fees']; ?></td>
                                                        <td><?php echo @$getValue['date']; ?></td>
                                                        <td class="text-right">
                                                            <div class="btn-group text-right">
                                                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                                    <span class="caret ml5"></span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><a href="trainer_schedule?edit=<?php echo $getValue['id']; ?>">Edit</a></li>
                                                                    <li><a href="trainer_schedule?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
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