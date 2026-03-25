<?php include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
	header("location:login");
}
$getSettings = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `website_settings` WHERE `id` = '1'"));
if(isset($_REQUEST['submit']))
{
	$random = rand(1,999999);
	$target_path = "../upload/logo/".$random;
	$target_path = $target_path . basename($_FILES['logo']['name']);
	$FileName = $random.$_FILES['logo']['name'];
		
	if($_FILES['logo']['name'] != '')
	{
		move_uploaded_file($_FILES['logo']['tmp_name'], $target_path);
		$uploadProfile1 = $FileName;
	}
	else
	{
		$uploadProfile1 = $getSettings['logo'];
	}
	
	
	mysqli_query($CONN, "UPDATE `website_settings` SET `name` = '".$_REQUEST['name']."', `phone` = '".$_REQUEST['phone']."', `alternative` = '".$_REQUEST['alternative']."', `email` = '".$_REQUEST['email']."', `logo` = '$uploadProfile1', `address` = '".$_REQUEST['address']."', `country` = '".$_REQUEST['country']."', `state` = '".$_REQUEST['state']."', `city` = '".$_REQUEST['city']."', `pincode` = '".$_REQUEST['pincode']."', `start_time` = '".$_REQUEST['start_time']."',`end_time` = '".$_REQUEST['end_time']."',`gap_between` = '".$_REQUEST['gap_between']."' WHERE `id` = '1'");
	header("location:settings?update=done");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
<!-- -------------- Meta and Title -------------- -->
<meta charset="utf-8">
<title><?php echo $adminTitle; ?> - Admin Control Panel</title>
<meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme"/>
<meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
<meta name="author" content="WebMantra Technologies">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- -------------- Fonts -------------- -->
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
      type='text/css'>

<!-- -------------- CSS - allcp forms -------------- -->
<link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.css">

<!-- -------------- CSS - theme -------------- -->
<link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">

<!-- -------------- Favicon -------------- -->
<link rel="shortcut icon" href="<?php echo '../upload/logo/'.$portalSetting['favicon']; ?>">

<!-- -------------- IE8 HTML5 support  -------------- -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

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

		<?php if(@$_REQUEST['update'] == 'done') { ?>
            <div class="alert alert-success dark alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-info pr10"></i> Congrats! your updates saved successfully!
            </div>
		<?php } ?>
        
        <!-- -------------- Content -------------- -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">
        
        	<section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <div class="mw1000 center-block">

                    <!-- -------------- General Information -------------- -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title">General Settings</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
                            
                            <div class="row">
                            	   <div class="col-md-6" style="padding:0 10px;">
                                <div class="section row mb10">
                                    <label for="store-name" class="field-label col-sm-4 ph10">Company Name</label>
                                    <div class="col-sm-8 ph10">
                                        <label for="store-name" class="field">
                                        	<input type="text" name="name" class="gui-input" value="<?php echo $getSettings['name']; ?>">
                                        </label>
                                    </div>
                                </div>
                                </div>
                                  <div class="col-md-6" style="padding:0 10px;">
                                <div class="section row mb10">
                                    <label for="store-phone"
                                           class="field-label col-sm-4 ph10">Phone No.</label>
                                    <div class="col-sm-8 ph10">
                                        <label for="store-phone" class="field">
                                        	<input type="text" name="phone" class="gui-input" value="<?php echo $getSettings['phone']; ?>">
                                        </label>
                                    </div>
                                </div>
                                </div>
                                   <div class="col-md-6" style="padding:0 10px;">
                                <div class="section row mb10">
                                    <label for="store-email"
                                           class="field-label col-sm-4 ph10">WhatsApp No.</label>
                                    <div class="col-sm-8 ph10">
                                        <label for="store-email" class="field">
                                        	<input type="text" name="alternative" class="gui-input" value="<?php echo $getSettings['alternative']; ?>">
                                        </label>
                                    </div>
                                </div>
                                </div>
                                 <div class="col-md-6" style="padding:0 10px;">
                                <div class="section row mb10">
                                    <label for="store-email"
                                           class="field-label col-sm-4 ph10">Email Address</label>
                                    <div class="col-sm-8 ph10">
                                        <label for="store-email" class="field">
                                        	<input type="text" name="email" class="gui-input" value="<?php echo $getSettings['email']; ?>">
                                        </label>
                                    </div>
                                </div>
                                </div>
                                
                                </div>
                                
                                <div class="section row mb10">
                                    <label for="store-email" class="field-label col-sm-2 ph10">Logo</label>
                                    <div class="col-sm-10 ph10">Image Size (Recommended Size: 200 x 200)
                                        <input type="file" name="logo" id="fileField">
                                        	<div style="padding:8px 0;"><img src="../upload/logo/<?php echo $getSettings['logo']; ?>" alt="" /></div>
                                    </div>
                                </div>
                                
                                
                               <div class="col-md-6" style="padding:0 10px;">
                                <div class="section row mb10">
                                    <label for="store-email"
                                           class="field-label col-sm-4 ph10">Service Time Start:</label>
                                    <div class="col-sm-8 ph10">
                                        <label for="store-email" class="field">
                                        	<input type="time" name="start_time" class="gui-input" value="<?php echo @$getSettings['start_time']; ?>">
                                        </label>
                                    </div>
                                </div>
                                </div>
                                
                                
                                <div class="col-md-6" style="padding:0 10px;">
                                <div class="section row mb10">
                                    <label for="store-email"
                                           class="field-label col-sm-4 ph10">Service Time End:</label>
                                    <div class="col-sm-8 ph10">
                                        <label for="store-email" class="field">
                                        	<input type="time" name="end_time" class="gui-input" value="<?php echo @$getSettings['end_time']; ?>">
                                        </label>
                                    </div>
                                </div>
                                </div>
                                
                                <div class="col-md-6" style="padding:0 10px;">
                                <div class="section row mb10">
                                    <label for="store-email"
                                           class="field-label col-sm-4 ph10">Gap Between<small> (e.g: +15 minutes)</small></label>
                                    <div class="col-sm-8 ph10">
                                        <label for="store-email" class="field">
                                        	<input type="text" name="gap_between" class="gui-input" value="<?php echo @$getSettings['gap_between']; ?>">
                                        </label>
                                    </div>
                                </div>
                                </div>
                                
                                <hr class="short alt">

                                <div class="section">
                                    <label for="address" class="field prepend-icon">
                                        <input type="text" name="address" class="gui-input" value="<?php echo $getSettings['address']; ?>">
                                        <label for="address" class="field-icon">
                                            <i class="fa fa-building-o"></i>
                                        </label>
                                    </label>
                                </div>
                                <!-- -------------- /section -------------- -->

                                <div class="section row mbn">
                                   
								   <div class="col-md-3 ph10 mb5">
                                        <label for="city" class="field prepend-icon">
                                            <input type="text" name="country" class="gui-input" value="<?php echo $getSettings['country']; ?>">
                                            <label for="city" class="field-icon">
                                                <i class="fa fa-building-o"></i>
                                            </label>
                                        </label>
                                    </div>
								   
									<div class="col-md-3 ph10 mb5">
                                        <label for="city" class="field prepend-icon">
                                            <input type="text" name="state" class="gui-input" value="<?php echo $getSettings['state']; ?>">
                                            <label for="city" class="field-icon">
                                                <i class="fa fa-building-o"></i>
                                            </label>
                                        </label>
                                    </div>

                                    <div class="col-md-3 ph10 mb5">
                                        <label for="city" class="field prepend-icon">
                                            <input type="text" name="city" class="gui-input" value="<?php echo $getSettings['city']; ?>">
                                            <label for="city" class="field-icon">
                                                <i class="fa fa-building-o"></i>
                                            </label>
                                        </label>
                                    </div>
									
									<div class="col-md-3 ph10 mb5">
                                        <label for="zip" class="field prepend-icon">
                                            <input type="text" name="pincode" class="gui-input" value="<?php echo $getSettings['pincode']; ?>">
                                            <label for="zip" class="field-icon">
                                                <i class="fa fa-tasks"></i>
                                            </label>
                                        </label>
                                    </div>

                                </div>
                                <!-- -------------- /Section Row -------------- -->

                            </div>
                        </div>
                    </div>


					<input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="UPDATE SETTINGS">
                </div>

            </div>
            <!-- -------------- /Column Center -------------- -->
			
        </section>
        
        </form>
		<!-- -------------- /Content -------------- -->

    </section>

    

</div>
<!-- -------------- /Body Wrap  -------------- -->
<!-- -------------- Scripts -------------- -->
<!-- -------------- jQuery -------------- -->
<script src="assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="assets/js/plugins/highcharts/highcharts.js"></script>

<!-- -------------- FileUpload JS -------------- -->
<script src="assets/js/plugins/fileupload/fileupload.js"></script>
<script src="assets/js/plugins/holder/holder.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="assets/js/utility/utility.js"></script>
<script src="assets/js/demo/demo.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/demo/widgets_sidebar.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {

	"use strict";

	// Init Theme Core
	Core.init();

	// Init Demo JS
	Demo.init();

	// Select dropdowns
	var selectList = $('.allcp-form select');
	selectList.each(function (i, e) {
		$(e).on('change', function () {
			if ($(e).val() == "0") $(e).addClass("empty");
			else $(e).removeClass("empty")
		});
	});
	selectList.each(function (i, e) {
		$(e).change();
	});

});
</script>
<!-- -------------- /Scripts -------------- -->

</body>
</html>
