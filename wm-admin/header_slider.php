<?php include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
    header("location:login");
}
$category = mysqli_fetch_array(mysqli_query($CONN,"SELECT * FROM `header_slider` WHERE `id` = '".@$_REQUEST['edit']."'"));

if(isset($_REQUEST['submit']) && $_REQUEST['edit'] == '')
{
	$random = rand(1,999999);
	$target_path = "../upload/sliders/".$random;
	$target_path = $target_path . basename($_FILES['banner_ads']['name']);
	$FileName = $random.$_FILES['banner_ads']['name'];
		
	if($_FILES['banner_ads']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads']['tmp_name'], $target_path);
	}
		else
	{
		$FileName = $category['banner_ads'];
	}
	mysqli_query($CONN, "INSERT INTO `header_slider` (`banner_ads`, `banner_url`, `status`) VALUES ('$FileName', '".$_REQUEST['banner_url']."', 'Y')"); 
	header("location:header_slider?created=yes"); exit;
}

if(isset($_REQUEST['submit']) && $_REQUEST['edit'] != '')
{
	$random = rand(1,999999);
	$target_path = "../upload/sliders/".$random;
	$target_path = $target_path . basename($_FILES['banner_ads']['name']);
	$FileName = $random.$_FILES['banner_ads']['name'];
		
	if($_FILES['banner_ads']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads']['tmp_name'], $target_path);
	}
		else
	{
		$FileName = $category['banner_ads'];
	}
	mysqli_query($CONN, "UPDATE `header_slider` SET `banner_ads` = '$FileName', `banner_url` = '".$_REQUEST['banner_url']."', `status` = 'Y' WHERE `id` = '".$_REQUEST['edit']."'"); 
	header("location:header_slider?updated=yes"); exit;
}

if(isset($_REQUEST['DelId'])!='')
{
    $advertise = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `header_slider` WHERE `id` = '".$_REQUEST['DelId']."'"));
    unlink("../upload/sliders/".$advertise['banner_ads']);
    mysqli_query($CONN, "DELETE FROM `header_slider` WHERE `id` = '".$_REQUEST['DelId']."' ");
    header("location:header_slider"); exit;
}
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--  Meta and Title  -->

<title><?php echo $adminTitle; ?> - Admin Control Panel</title>
<meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme"/>
<meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
<meta name="author" content="WebMantra Technologies">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--  Fonts  -->
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
	  type='text/css'>

<!--  CSS - theme -->
<link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/pagination.css">
<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css">

<!--  CSS - allcp forms  -->
<link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.min.css">

<!--  Plugins -->
<link rel="stylesheet" type="text/css" href="assets/js/plugins/c3charts/c3.min.css">

<!--  Favicon  -->
<link rel="shortcut icon" href="<?php echo '../upload/logo/'.$portalSetting['favicon']; ?>">

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
   }
   else {
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
                <a href="#" class="btn btn-primary btn-sm ml10" title="New Order" 
                onclick="showHide('hidden_div'); return false;">
                    <span class="fa fa-plus pr5"></span>Add New</a>
            </div>
        </header>
        <!-- /Topbar -->

        <!-- Content  -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">

            <div class="mw1000 center-block" id="hidden_div" <?php if(@$_REQUEST['edit']=='') { ?> style="display:none;" <?php } ?> >
			<!-- Change Password -->
			<div class="panel mb35">
				<div class="panel-heading">
					<span class="panel-title">Create Header Slider</span>
				</div>
				
				<?php if(@$_REQUEST['created'] == 'yes') { ?>
					<div class="alert alert-success dark alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<i class="fa fa-info pr10"></i> Congrats! Header Slider added successfully!
					</div>
				<?php } ?>
				<?php if(@$_REQUEST['updated'] == 'yes') { ?>
					<div class="alert alert-success dark alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<i class="fa fa-info pr10"></i> Congrats! Header Slider updated successfully!
					</div>
				<?php } ?>
			   
				<div class="panel-body br-t">
					<div class="allcp-form theme-primary">

					<div class="col-md-6">
					<div class="section row mb25">
					<label for="refund-policy" class="field-label col-sm-4 ph10">Banner Ads</label>
						<div class="col-sm-8 ph10">
							<input type="file" name="banner_ads" class="gui-input">
							<img src="../upload/sliders/<?=@$category['banner_ads']?>" height="100px" alt="" />
						</div>
					</div></div>
					
					<div class="col-md-6">
					<div class="section row mb25">
					<label for="refund-policy" class="field-label col-sm-4 ph10">Banner URL</label>
						<div class="col-sm-8 ph10">
							<input type="text" name="banner_url" class="gui-input" value="<?php echo @$category['banner_url']; ?>">
						</div>
					</div></div>

					<div class="col-md-6">
					<div class="section row">
					<label for="refund-policy" class="field-label col-sm-4 ph10">Status</label>
						<div class="col-sm-8 ph10" style="padding-top:14px;">
							<input type="radio" name="status" value="Y" <?php if(@$category['status'] == 'Y') { ?> checked<?php } ?>> Active&nbsp;&nbsp;<input type="radio" name="status" value="N" <?php if(@$category['status'] == 'N') { ?> checked<?php } ?>> Inactive
						</div>
					</div></div>
					
					</div>
				</div>
			</div>

			<input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if(@$_REQUEST['edit']!='') { ?>UPDATE<?php } else { ?>ADD<?php } ?> Slider">
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
                                <span class="panel-title hidden-xs">Header Slider</span>
                            </div>
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr class="bg-light">
                                           <th class="">Slider Banner</th>
                                           <th class="">Slider URL</th>
                                           <th class="">Status</th>
                                           <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                        $sl = 0;
                                        $result2 = mysqli_query($CONN,"SELECT * FROM `header_slider` ORDER BY `id` DESC");
                                        while($getValue = mysqli_fetch_array($result2)) { 
                                        $sl++;
                                    ?>
                                        <tr>
                                            <td class="" style="text-align:left;"><img src="../upload/sliders/<?=$getValue['banner_ads']?>" height="100px" alt="" /></td>
                                            <td class="" style="text-align:left;"><?=$getValue['banner_url']?></td>
                                            <td><?php if($getValue['status'] == 'Y') { ?> <span class="label label-success">Active</span><?php } ?><?php if($getValue['status'] == 'N') { ?> <span class="label label-danger">Inactive</span><?php } ?></td>
                                            <td class="text-right">
                                                <div class="btn-group text-right">
                                                    <button type="button"
                                                            class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="header_slider?edit=<?=$getValue['id']?>">Edit</a></li>
                                                        <li><a href="header_slider?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
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
                <!--<div><?=$pagination?></div>-->
            </div>
            <!-- /Column Center -->

        </section>
        <!-- /Content -->

    </section>


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
} );
</script>

<!-- /Scripts -->

</body>
</html>
