<?php include("../includes/config.php");
include("../includes/functions.php");
if($_SESSION['AdminID'] < '1')
{
	header("location:login");
}

if(isset($_REQUEST['submit']) && $_REQUEST['fullname'] != '' && $_REQUEST['edit'] == '')
{
	$random = rand(111111,999999);
	$target_path = "../upload/profiles/".$random;	
	$target_path = $target_path . basename($_FILES['thumb']['name']);
	$FileName = $random.$_FILES['thumb']['name'];
	
	if(move_uploaded_file($_FILES['thumb']['tmp_name'], $target_path))
	{
		$thumb = $FileName;
	}
	else
	{
		$thumb = '';
	}
	
	mysqli_query($CONN, "INSERT INTO `profiles` (`id`, `fullname`, `profile`, `age`, `phone`, `nationality`, `measurements`, `height`, `dress_size`, `hair_colour`, `eye_colour`, `languages`, `orientation`, `availability`, `location`, `status`) VALUES ('', '".$_REQUEST['fullname']."', '$thumb', '".addslashes($_REQUEST['age'])."', '".addslashes($_REQUEST['phone'])."', '".addslashes($_REQUEST['nationality'])."', '".addslashes($_REQUEST['measurements'])."', '".addslashes($_REQUEST['height'])."', '".addslashes($_REQUEST['dress_size'])."', '".addslashes($_REQUEST['hair_colour'])."', '".addslashes($_REQUEST['eye_colour'])."', '".addslashes($_REQUEST['languages'])."', '".addslashes($_REQUEST['orientation'])."', '".addslashes($_REQUEST['availability'])."', '".addslashes($_REQUEST['location'])."', 'Y')");
    header("location:add-business?update=done"); exit;
}
$getGroup = mysqli_fetch_array(mysqli_query($CONN,"SELECT * FROM `profiles` WHERE `id` = '".$_REQUEST['edit']."'"));

if(isset($_REQUEST['submit']) && $_REQUEST['fullname'] != '' && $_REQUEST['edit'] != '')
{
	$random = rand(111111,999999);
	$target_path = "../upload/profiles/".$random;	
	$target_path = $target_path . basename($_FILES['thumb']['name']);
	$FileName = $random.$_FILES['thumb']['name'];
	
	if(move_uploaded_file($_FILES['thumb']['tmp_name'], $target_path))
	{
		$thumb = $FileName;
	}
	else
	{
		$thumb = $getGroup['profile'];
	}
	
	mysqli_query($CONN,"UPDATE `profiles` SET   `fullname` = '".$_REQUEST['fullname']."', 
												`profile` = '$thumb',
												`age` = '".addslashes($_REQUEST['age'])."',
												`phone` = '".addslashes($_REQUEST['phone'])."',
												`nationality` = '".addslashes($_REQUEST['nationality'])."',
												`measurements` = '".addslashes($_REQUEST['measurements'])."',
												`height` = '".addslashes($_REQUEST['height'])."',
												`dress_size` = '".addslashes($_REQUEST['dress_size'])."',
												`hair_colour` = '".addslashes($_REQUEST['hair_colour'])."',
												`eye_colour` = '".addslashes($_REQUEST['eye_colour'])."',
												`languages` = '".addslashes($_REQUEST['languages'])."',
												`orientation` = '".addslashes($_REQUEST['orientation'])."',
												`availability` = '".addslashes($_REQUEST['availability'])."',
												`location` = '".addslashes($_REQUEST['location'])."' WHERE `id` = '".$_REQUEST['edit']."'");
	header("location:add-business?update=done&edit=".$_REQUEST['edit'].""); exit;
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

<script src="https://cdn.tiny.cloud/1/rjb1e962cmfd1fjuhwwko1efcs3h8khf28a9ku3zhs9t6hkh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<!--  IE8 HTML5 support  -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script>
tinymce.init({
  selector: 'textarea',
  plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
  toolbar_mode: 'floating',
  height : "280"
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

		<?php if($_REQUEST['add'] == 'done') { ?>
            <div class="alert alert-success dark alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-info pr10"></i> Congrats! Model Profile Created successfully!</div>
		<?php } ?>

        <?php if($_REQUEST['update'] == 'done') { ?>
        <div class="alert alert-success dark alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-info pr10"></i> Congrats! Model Profile updated successfully!</div>
		<?php } ?>
        
        <!-- -------------- Content -------------- -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">
        	<section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <div class="mw1000 center-block">

					<!-- -------------- Change Password -------------- -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title"><?php if($_REQUEST['edit']!='') { ?>Update<?php } else { ?>Add<?php } ?> Model Profile</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
														
							<div class="section row mb25">
                                <label for="refund-policy" class="field-label col-sm-2 ph10">Model Name</label>
                                <div class="col-sm-10 ph10">
                                    <input type="text" name="fullname" class="gui-input" value="<?php echo $getGroup['fullname']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Phone No.</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="phone" class="gui-input" value="<?php echo $getGroup['phone']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                                <label for="refund-policy" class="field-label col-sm-2 ph10">Model Age</label>
                                <div class="col-sm-10 ph10">
                                    <input type="text" name="age" class="gui-input" value="<?php echo $getGroup['age']; ?>">
                                </div>
                            </div>
                            
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Nationality</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="nationality" class="gui-input" value="<?php echo $getGroup['nationality']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Measurements</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="measurements" class="gui-input" value="<?php echo $getGroup['measurements']; ?>">
                                </div>
                            </div>                          
                            
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Height</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="height" class="gui-input" value="<?php echo $getGroup['height']; ?>">
                                </div>
                            </div>							
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Dress Size</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="dress_size" class="gui-input" value="<?php echo $getGroup['dress_size']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Hair Colour</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="hair_colour" class="gui-input" value="<?php echo $getGroup['hair_colour']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Eye Colour</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="eye_colour" class="gui-input" value="<?php echo $getGroup['eye_colour']; ?>">
                                </div>
                            </div>	
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Languages</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="languages" class="gui-input" value="<?php echo $getGroup['languages']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Orientation</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="orientation" class="gui-input" value="<?php echo $getGroup['orientation']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Availability</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="availability" class="gui-input" value="<?php echo $getGroup['availability']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Location</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="location" class="gui-input" value="<?php echo $getGroup['location']; ?>">
                                </div>
                            </div>
							
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Profile Picture</label>
                            <div class="col-sm-10 ph10">
                                    <input type="file" name="thumb" class="gui-input">
									<img src="../upload/profiles/<?=$getGroup['profile']?>" height="150" alt="" />
                                </div>
                            </div>
							
                            <input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if($_REQUEST['edit']!='') { ?>UPDATE<?php } else { ?>PUBLISH<?php } ?>">

                            </div>
                        </div>
                    </div>


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

</body>
</html>