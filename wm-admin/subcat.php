<?php
include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
    header("location:login");
}
$getGroup = mysqli_fetch_array(mysqli_query($CONN,"SELECT * FROM `subcategory` WHERE `id` = '".@$_REQUEST['edit']."'"));

if(isset($_REQUEST['submit']) && $_REQUEST['category'] != '' && $_REQUEST['name'] != '' && @$_REQUEST['edit'] == '')
{
    $random = rand(1,999999);
    $target_path = "../upload/category/".$random;
    $target_path = $target_path . basename($_FILES['icon']['name']);
    $FileName = $random.$_FILES['icon']['name'];
    	
    if($_FILES['icon']['name'] != '')
    {
    	move_uploaded_file($_FILES['icon']['tmp_name'], $target_path);
    }
    	else
    {
    	$FileName = $getGroup['icons'];
    }
	
	$target_path1 = "../upload/category/".$random;
    $target_path1 = $target_path1 . basename($_FILES['cover_photo']['name']);
    $FileName1 = $random.$_FILES['cover_photo']['name'];
    	
    if($_FILES['cover_photo']['name'] != '')
    {
    	move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_path1);
    }
    	else
    {
    	$FileName1 = $getGroup['cover_photo'];
    }
	
    mysqli_query($CONN,"INSERT INTO `subcategory` (`category_id`, `name`, `icons`, `cover_photo`, `status`) VALUES ('".$_REQUEST['category']."', '".$_REQUEST['name']."', '$FileName', '$FileName1', 'Y')");
    header("location:subcat?created=yes"); exit;
}

if(isset($_REQUEST['submit']) && $_REQUEST['name'] != '' && $_REQUEST['category'] != '' && $_REQUEST['edit'] != '')
{
    $random = rand(1,999999);
    $target_path = "../upload/category/".$random;
    $target_path = $target_path . basename($_FILES['icon']['name']);
    $FileName = $random.$_FILES['icon']['name'];
    	
    if($_FILES['icon']['name'] != '')
    {
    	move_uploaded_file($_FILES['icon']['tmp_name'], $target_path);
    }
    	else
    {
    	$FileName = $getGroup['icons'];
    }
	
	$target_path1 = "../upload/category/".$random;
    $target_path1 = $target_path1 . basename($_FILES['cover_photo']['name']);
    $FileName1 = $random.$_FILES['cover_photo']['name'];
    	
    if($_FILES['cover_photo']['name'] != '')
    {
    	move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_path1);
    }
    	else
    {
    	$FileName1 = $getGroup['cover_photo'];
    }
	
    mysqli_query($CONN,"UPDATE `subcategory` SET `category_id` = '".$_REQUEST['category']."', `name` = '".$_REQUEST['name']."', `icons` = '$FileName', `cover_photo` = '$FileName1' WHERE `id` = '".$_REQUEST['edit']."'");
    header("location:subcat?updated=yes"); exit;
}
if (isset($_REQUEST['DelId'])) {
    $result = mysqli_query($CONN, "SELECT `icon`, `cover_photo` FROM `subcategory` WHERE `id` = '" . $_REQUEST['DelId'] . "'");
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['icon']) && file_exists("../upload/category/" . $row['icon'])) {
        unlink("../upload/category/" . $row['icon']);
    }

    if (!empty($row['cover_photo']) && file_exists("../upload/category/" . $row['cover_photo'])) {
        unlink("../upload/category/" . $row['cover_photo']);
    }

     mysqli_query($CONN,"DELETE FROM `subcategory` WHERE id = '".$_REQUEST['DelId']."' ");
    header("location:subcat"); exit;
}

// if(isset($_REQUEST['DelId'])!='')
// {
//     mysqli_query($CONN,"DELETE FROM `subcategory` WHERE id = '".$_REQUEST['DelId']."' ");
//     header("location:subcat"); exit;
// }
?>
<!DOCTYPE html>
<html>

<head>
<!-- Meta and Title -->
<meta charset="utf-8">
<title><?php echo $adminTitle; ?> - Admin Control Panel</title>
<meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme"/>
<meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
<meta name="author" content="WebMantra Technologies">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts -->
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

<!-- CSS - theme -->
<link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/pagination.css">
<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css" />
<!--  CSS - allcp forms  -->
<link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.min.css">

<!--  Plugins  -->
<link rel="stylesheet" type="text/css" href="assets/js/plugins/c3charts/c3.min.css">

<!--  Favicon  -->
<link rel="shortcut icon" href="<?php echo '../upload/logo/'.$portalSetting['favicon']; ?>">

<!--  IE8 HTML5 support   -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script type="text/javascript">
function showHide(obj) {
    var div = document.getElementById(obj);
    if (div.style.display == 'none') {
        div.style.display = '';
    }
    else {
        div.style.display = 'none';
    }
}
</script>

</head>

<body class="sales-stats-page">

<?php include 'templates/wm-customizer.php'; ?>

<!--  Body Wrap   -->
<div id="main">

    <?php include 'templates/wm-header.php'; ?>

    <?php include 'templates/wm-sidebar.php'; ?>

    <!--  Main Wrapper  -->
    <section id="content_wrapper">
        <?php include 'templates/main-wrapper.php'; ?>

        <!--  Topbar -->
        <header id="topbar" class="ph10">
            
            <div class="topbar-right mt5 mr35 topbar_right_area" style="padding-top:80px;">
                <a href="#" class="btn btn-primary btn-sm ml10" title="New Order" onClick="showHide('hidden_div'); return false;">
                    <span class="fa fa-plus pr5"></span>Add New</a>
                <!--<a href="sales-stats-products.html" class="btn btn-primary btn-sm ml10" title="New Product">
                    <span class="fa fa-plus pr5"></span><span class="fa fa-shopping-cart pr5"></span></a>
                <a href="sales-stats-clients.html" class="btn btn-primary btn-sm ml10" title="New User">
                    <span class="fa fa-plus pr5"></span><span class="fa fa-user pr5"></span></a>-->
            </div>
        </header>
        <!--  /Topbar  -->

        <?php if(@$_REQUEST['created'] == 'yes') { ?>
            <div class="alert alert-success dark alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <i class="fa fa-info pr10"></i> Congrats! Sub Category added successfully!
            </div>
        <?php } ?>
        <?php if(@$_REQUEST['updated'] == 'yes') { ?>
            <div class="alert alert-success dark alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <i class="fa fa-info pr10"></i> Congrats! Sub Category updated successfully!
            </div>
        <?php } ?>

        <!--  Content  -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">

            <div class="mw1000 center-block" id="hidden_div" <?php if(@$_REQUEST['edit']=='') { ?> 
            style="display:none;" <?php } ?>>
                <!--  Change Password  -->
                <div class="panel mb35">
                    <div class="panel-heading">
                        <span class="panel-title">Add Sub Category</span>
                    </div>
                    <div class="panel-body br-t">
                        <div class="allcp-form theme-primary">

                            <div class="section row mb25 col-sm-2 col-md-6">
                                <label for="refund-policy" class="field-label col-sm-3 ph10 text-center">Category</label>
                                <div class="col-sm-9 ph10">
                                    <label class="field select">
                                        <select name="category" class="gui-input">
                                            <option value="">Select Category...</option>
                                            <?php $getCountry = mysqli_query($CONN, "SELECT * FROM `category` ORDER BY `cat_id` ASC");
                                                  while($countryArr = mysqli_fetch_array($getCountry)) {?>
                                                <option <?php if(@$getGroup['category_id'] == $countryArr['cat_id']) { ?> selected <?php } ?> value="<?php echo $countryArr['cat_id']; ?>"><?php echo $countryArr['category']; ?></option>
                                             <?php } ?>
                                        </select>
                                        <i class="arrow double"></i>
                                    </label>
                                </div>
                            </div>

                            <div class="section row mb25 col-md-6">
                                <label for="refund-policy" class="field-label col-sm-3 ph10 text-center">Subcategory</label>
                                <div class="col-sm-9 ph10">
                                    <input type="text" name="name" class="gui-input" value="<?php echo @$getGroup['name']; ?>">
                                </div>
                            </div>

                            <div class="section row col-md-6">
                                <label for="refund-policy" class="field-label col-sm-3 ph10">ICON</label>
                                <div class="col-sm-9 ph10">Icon Width (Width: 256 x Height: 256)
                                    <input type="file" name="icon" class="gui-input">
                                    <?php if(@$getGroup['icons'] != '') { ?><div style="padding:8px 0;">
                                    <img src="../upload/category/<?php echo $getGroup['icons']; ?>" height="160px" alt="" ></div><?php } ?>
                                </div>
                            </div>

                            <div class="section row col-md-6">
                                <label for="refund-policy" class="field-label col-sm-3 ph10">Cover Photo</label>
                                <div class="col-sm-9 ph10">Icon Width (Width: 1920 x Height: 280)
                                    <input type="file" name="cover_photo" class="gui-input">
                                    <?php if(@$getGroup['cover_photo'] != '') { ?><div style="padding:8px 0;">
                                    <img src="../upload/category/<?php echo $getGroup['cover_photo']; ?>" height="100px" alt="" ></div><?php } ?>
                                </div>
                            </div>                         
                            
                        </div>
                    </div>
                </div>

                <input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if(@$_REQUEST['edit']!='') { ?>UPDATE<?php } else { ?>ADD<?php } ?> CATEGORY">
            </div>

        </form>
        <!--  /Content  -->

        <!--  Content -->
        <section id="content" class="table-layout animated fadeIn">

            <!-- Column Center -->
            <div class="chute chute-center" style="padding-top:0px;">

                <!-- Products Status Table -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title"> Manage Sub Categories</span>
                            </div>
                            <div class="panel-body pn">
                                <div class="table-responsive responsive_table_area">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr class="bg-light">
                                            <th class="">Sl.No.</th>
                                            <th class="">Category Name</th>
                                            <th class="">Subcategory</th>
                                            <th class="">Thumb</th>
                                            <th class="">Cover Photo</th>
                                            <th class="text-right">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $sl = "";
                                            $result2 = mysqli_query($CONN,"SELECT * FROM `subcategory` ORDER BY `id` DESC");
                                            while($getValue = mysqli_fetch_array($result2)) { 
                                            $sl++;
                                        ?>
                                            <tr class="order_item">
                                                <td data-title="Sl.No"><?php echo $sl; ?></td>
                                                <td class="" style="text-align:left;" data-title="Category Name">
                                                <?php $categoryData = mysqli_fetch_array(mysqli_query($CONN,"SELECT `category` FROM `category` WHERE `cat_id` = '".$getValue['category_id']."'")); echo $categoryData['category']; ?></td>
                                                <td class="" data-title="Subcategory"><?php echo $getValue['name']; ?></td>
                                                <td class="" data-title="Thumb"><?php if($getValue['icons'] != '') { ?><div style="padding:8px 0;">
                                                    <img src="../upload/category/<?php echo $getValue['icons']; ?>" width="100px" alt="" ></div><?php } ?></td>
                                                    <td class="" data-title="Thumb"><?php if($getValue['cover_photo'] != '') { ?><div style="padding:8px 0;">
                                                    <img src="../upload/category/<?php echo $getValue['cover_photo']; ?>" width="100px" alt="" ></div><?php } ?></td>
                                                <td class="text-right" data-title="Status">
                                                <div class="btn-group text-right">
                                                    <button type="button"
                                                            class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                            data-toggle="dropdown" 
                                                            aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="subcat?edit=<?php echo $getValue['id'];?>">Edit</a></li>
                                                        <li><a href="subcat?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
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
                <div><?//=$pagination?></div>
            </div>
            <!-- /Column Center  -->

        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <aside id="sidebar_right" class="nano affix">

        <!--  Sidebar Right Content  -->
        <div class="sidebar-right-wrapper nano-content">

            <div class="sidebar-block br-n p15">

                <h6 class="title-divider text-muted mb20"> Visitors Stats
                    <span class="pull-right"> 2015
                  <i class="fa fa-caret-down ml5"></i>
                </span>
                </h6>

                <div class="progress mh5">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="34"
                         aria-valuemin="0"
                         aria-valuemax="100" style="width: 34%">
                        <span class="fs11">New visitors</span>
                    </div>
                </div>
                <div class="progress mh5">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="66"
                         aria-valuemin="0"
                         aria-valuemax="100" style="width: 66%">
                        <span class="fs11 text-left">Returnig visitors</span>
                    </div>
                </div>
                <div class="progress mh5">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45"
                         aria-valuemin="0"
                         aria-valuemax="100" style="width: 45%">
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
                            <i class="fa fa-caret-down"></i> 15.7% </h3>
                    </div>
                </div>

                <h6 class="title-divider text-muted mt25 mb10">Returnig visitors</h6>

                <div class="row">
                    <div class="col-xs-5">
                        <h3 class="text-primary mn pl5">660</h3>
                    </div>
                    <div class="col-xs-7 text-right">
                        <h3 class="text-success-dark mn">
                            <i class="fa fa-caret-up"></i> 20.2% </h3>
                    </div>
                </div>

                <h6 class="title-divider text-muted mt25 mb10">Orders</h6>

                <div class="row">
                    <div class="col-xs-5">
                        <h3 class="text-primary mn pl5">153</h3>
                    </div>
                    <div class="col-xs-7 text-right">
                        <h3 class="text-success mn">
                            <i class="fa fa-caret-up"></i> 5.3% </h3>
                    </div>
                </div>

                <h6 class="title-divider text-muted mt40 mb20"> Site Statistics
                    <span class="pull-right text-primary fw600">Today</span>
                </h6>
            </div>
        </div>
    </aside>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!-- Scripts -->

<!--  jQuery  -->
<script src="assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- JvectorMap Plugin -->
<script src="assets/js/plugins/jvectormap/jquery.jvectormap.min.js"></script>
<script src="assets/js/plugins/jvectormap/assets/jquery-jvectormap-world-mill-en.js"></script>

<!-- HighCharts Plugin -->
<script src="assets/js/plugins/highcharts/highcharts.js"></script>
<script src="assets/js/plugins/c3charts/d3.min.js"></script>
<script src="assets/js/plugins/c3charts/c3.min.js"></script>

<!--  Theme Scripts -->
<script src="assets/js/utility/utility.js"></script>
<script src="assets/js/demo/demo.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/demo/widgets_sidebar.js"></script>
<script src="assets/js/pages/dashboard2.js"></script>

<!-- Page JS -->
<script src="assets/js/demo/charts/highcharts.js"></script>
<script src="assets/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/datatable/js/dataTables.bootstrap.min.js"></script>
<!-- /Scripts -->
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>

</html>
