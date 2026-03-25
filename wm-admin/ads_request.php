<?php
include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
    header("location:login");
}

$advertise = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `advertise` WHERE `id` = '".@$_REQUEST['edit']."'"));
if(isset($_REQUEST['submit']))
{
	$random = rand(1,999999);
	$target_path = "../upload/ads/".$random;
	$target_path = $target_path . basename($_FILES['banner_ads']['name']);
	$FileName = $random.$_FILES['banner_ads']['name'];
		
	if($_FILES['banner_ads']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads']['tmp_name'], $target_path);
	}
		else
	{
		$FileName = $advertise['banner_ads'];
	}
	mysqli_query($CONN, "INSERT INTO `advertise` (`id`, `ads_name`, `company`, `banner_ads`, `details`, `datetime`, `status`) VALUES ('', '".$_REQUEST['ads_name']."', '".$_REQUEST['company']."', '$FileName', '".$_REQUEST['details']."', now(), 'Y')"); 
	header("location:ads_request"); exit;
}

if(isset($_REQUEST['DelId'])!='')
{
    mysqli_query($CONN, "DELETE FROM `advertise` WHERE `id` = '".$_REQUEST['DelId']."' ");
    header("location:ads_request"); exit;
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
                <!--<a href="sales-stats-products.html" class="btn btn-primary btn-sm ml10" title="New Product">
                    <span class="fa fa-plus pr5"></span><span class="fa fa-shopping-cart pr5"></span></a>
                <a href="sales-stats-clients.html" class="btn btn-primary btn-sm ml10" title="New User">
                    <span class="fa fa-plus pr5"></span><span class="fa fa-user pr5"></span></a>-->
            </div>
        </header>
        <!-- /Topbar -->

        <!-- Content  -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">

            <div class="mw1000 center-block" id="hidden_div" <?php if(@$_REQUEST['edit']=='') { ?> style="display:none;" <?php } ?> >
			<!-- Change Password -->
			<div class="panel mb35">
				<div class="panel-heading">
					<span class="panel-title">Create Ads</span>
				</div>
				
				<?php if(@$_REQUEST['created'] == 'yes') { ?>
					<div class="alert alert-success dark alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<i class="fa fa-info pr10"></i> Congrats! Ads added successfully!
					</div>
				<?php } ?>
				<?php if(@$_REQUEST['updated'] == 'yes') { ?>
					<div class="alert alert-success dark alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<i class="fa fa-info pr10"></i> Congrats! Ads updated successfully!
					</div>
				<?php } ?>
			   
				<div class="panel-body br-t">
					<div class="allcp-form theme-primary">

					<div class="col-md-6">
					<div class="section row mb25">
					<label for="refund-policy" class="field-label col-sm-4 ph10">Ads Name</label>
						<div class="col-sm-8 ph10">
							<input type="text" name="ads_name" class="gui-input" value="<?php echo @$category['ads_name']; ?>">
						</div>
					</div></div>
					
					<div class="col-md-6">
					<div class="section row mb25">
					<label for="refund-policy" class="field-label col-sm-4 ph10">Company</label>
						<div class="col-sm-8 ph10">
							<input type="text" name="company" class="gui-input" value="<?php echo @$category['company']; ?>">
						</div>
					</div></div>
					
					<div class="col-md-6">
					<div class="section row mb25">
					<label for="refund-policy" class="field-label col-sm-4 ph10">Profile Picture</label>
						<div class="col-sm-8 ph10">
							<input type="file" name="banner_ads" class="gui-input">
						</div>
					</div></div>

					<div class="col-md-6">
					<div class="section row">
					<label for="refund-policy" class="field-label col-sm-4 ph10">Status</label>
						<div class="col-sm-8 ph10" style="padding-top:14px;">
							<input type="radio" name="status" value="Y" <?php if(@$category['status'] == 'Y') { ?> checked<?php } ?>> Active&nbsp;&nbsp;<input type="radio" name="status" value="N" <?php if(@$category['status'] == 'N') { ?> checked<?php } ?>> Inactive
						</div>
					</div></div>
					
					<div class="col-md-12">
					<div class="section row mb25">
					<label for="refund-policy" class="field-label col-sm-2 ph10">Details</label>
						<div class="col-sm-10 ph10">
							<textarea name="details" class="gui-input" style="height:100px;"><?php echo @$category['details']; ?></textarea>
						</div>
					</div></div>							
					
					
					</div>
				</div>
			</div>

			<input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if(@$_REQUEST['edit']!='') { ?>UPDATE<?php } else { ?>ADD<?php } ?> Ads">
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
                                <span class="panel-title hidden-xs"> Manage Ads</span>
                            </div>
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr class="bg-light">
                                           <th class="">Date</th>
                                           <th class="">Ads Name</th>
                                           <th class="">Company</th>
                                           <th class="">Photo</th>
                                           <th class="">Status</th>
                                           <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                        $sl = 0;
                                        $result2 = mysqli_query($CONN,"SELECT * FROM `advertise` ORDER BY `id` DESC");
                                        while($getValue = mysqli_fetch_array($result2)) { 
                                        $sl++;
                                    ?>
                                        <tr>
                                            <td><?php echo $getValue['datetime']; ?></td>
                                            <td class="" style="text-align:left;"><?php echo $getValue['ads_name']; ?></td>
											<td class="" style="text-align:left;"><?php echo $getValue['company']; ?></td>
                                            <td class="" style="text-align:left;"><img src="../upload/ads/<?=$getValue['banner_ads']?>" height="100px" alt="" /></td>
                                            <td><?php if($getValue['status'] == 'Y') { ?> <span class="label label-success">Active</span><?php } ?><?php if($getValue['status'] == 'N') { ?> <span class="label label-danger">Inactive</span><?php } ?></td>
                                            <td class="text-right">
                                                <div class="btn-group text-right">
                                                    <button type="button"
                                                            class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="ads_request?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
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
