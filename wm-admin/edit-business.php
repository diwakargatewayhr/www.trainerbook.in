<?php
include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
    header("location:login");
}
$business_data = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `business_data` WHERE `id` = '".$_REQUEST['data']."'")); 
if(isset($_REQUEST['update_business']))
{
	$random = rand(1,999999);
	$target_path = "../upload/logo/".$random;
	$target_path = $target_path . basename($_FILES['business_logo']['name']);
	$FileName = $random.$_FILES['business_logo']['name'];
		
	if($_FILES['business_logo']['name'] != '')
	{
		move_uploaded_file($_FILES['business_logo']['tmp_name'], $target_path);
		$business_logo = $FileName;
	}
	else
	{
		$business_logo = $business_data['business_logo'];
	}
	
	$target_path1 = "../upload/cover_photo/".$random;
	$target_path1 = $target_path1 . basename($_FILES['business_cover']['name']);
	$FileName1 = $random.$_FILES['business_cover']['name'];
		
	if($_FILES['business_cover']['name'] != '')
	{
		move_uploaded_file($_FILES['business_cover']['tmp_name'], $target_path1);
		$business_cover = $FileName1;
	}
	else
	{
		$business_cover = $business_data['business_cover'];
	}
	
	mysqli_query($CONN, "UPDATE `business_data` SET `business_logo` = '$business_logo', `business_cover` = '$business_cover', `userid` = '".$_SESSION['id']."', `business_name` = '".$_REQUEST['business_name']."', `tagline` = '".$_REQUEST['tagline']."', `established` = '".$_REQUEST['established']."', `awards` = '".$_REQUEST['awards']."', `certificates` = '".$_REQUEST['certificates']."', `achievements` = '".$_REQUEST['achievements']."', `offers` = '".$_REQUEST['offers']."', `business_website` = '".$_REQUEST['business_website']."' WHERE `id` = '".$_REQUEST['data']."'");
	header('location:edit-business?data='.$_REQUEST['data'].'&ret=business');
}

if(isset($_REQUEST['update_contact']))
{
	mysqli_query($CONN, "UPDATE `business_data` SET `address` = '".$_REQUEST['address']."', `state` = '".$_REQUEST['state']."', `city` = '".$_REQUEST['city']."', `phone` = '".$_REQUEST['phone']."', `alternative_number` = '".$_REQUEST['alternative_number']."', `whatsapp` = '".$_REQUEST['whatsapp']."' WHERE `id` = '".$_REQUEST['data']."'");
	header('location:edit-business?data='.$_REQUEST['data'].'&ret=contact');
}

if(isset($_REQUEST['update_social']))
{
	mysqli_query($CONN, "UPDATE `business_data` SET `facebook_url` = '".$_REQUEST['facebook_url']."', `instagram_url` = '".$_REQUEST['instagram_url']."', `twitter_url` = '".$_REQUEST['twitter_url']."', `youtube_url` = '".$_REQUEST['youtube_url']."', `linkedin_url` = '".$_REQUEST['linkedin_url']."', `other_url` = '".$_REQUEST['other_url']."' WHERE `id` = '".$_REQUEST['data']."'");
	header('location:edit-business?data='.$_REQUEST['data'].'&ret=social');
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xl-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xl-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xl-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xl-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xl-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xl-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xl-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xl-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xl-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xl-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xl-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12, .col-xl-12 {
    position: relative;
    min-height: 1px;
    padding-left: 11px /*/ 2*/;
    padding-right: 11px /*/ 2*/;
}

.hide222 {
  display: none;
}
</style>
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

        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center">
			
			
			<div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> Edit Business</span>
                            </div>
                            <div class="panel-body pn">
                                <div class="edit_user_profile_tab_area">
                                <div class="edit_user_profile_tab_menu_area">   
								<ul class="tabs">
									<li class="tab-link current" data-tab="tab-1">Business Information</li>
									<li class="tab-link" data-tab="tab-2">Contact Information</li>
									<li class="tab-link" data-tab="tab-3">Social Media</li>
									<li class="tab-link" data-tab="tab-4">Business Keyword & More</li>
									<li class="tab-link" data-tab="tab-5">Timings</li>
									<li class="tab-link" data-tab="tab-6">Upload Video/Logo/Picture</li>
								</ul>	
								</div>	
								<div class="edit_user_profile_tab_dtls_area">   	
								
								<div id="tab-1" class="tab-content current">
								
								<form name="formstep1" action="" method="post" enctype="multipart/form-data">
								<div class="free_listing_form_areainner">
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Category</label>
									<div class="col-md-8">
										<label class="field select">
                                        <select id="category" name="category" class="form-control" required style="width:300px">
                                        	<option value="">Select Category</option>
                                            <?php $getCategory1 = mysqli_query($CONN, "SELECT * FROM `category` ORDER BY `category` ASC");
                	                              while($getNameCat1 = mysqli_fetch_array($getCategory1)) { ?>
                                                <option <?php if($category['category'] == $business_data['cat_id']) { ?> selected <?php } ?> value="<?php echo $getNameCat1['cat_id']; ?>"><?php echo $getNameCat1['category']; ?></option>
                                            <?php } ?>
										</select>
										<i class="arrow double"></i>
                                </label>
									</div>
								</div>
																
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">City</label>
									<div class="col-md-8">
										<label class="field select">
                                        <select id="category" name="category" class="form-control" required style="width:300px">
                                        	<option value="">Choose City</option>
                                            <?php $getCategory1 = mysqli_query($CONN, "SELECT * FROM `locations` ORDER BY `location` ASC");
                	                              while($getNameCat1 = mysqli_fetch_array($getCategory1)) { ?>
                                                <option <?php if($getNameCat1['location'] == $business_data['city']) { ?> selected <?php } ?> value="<?php echo $getNameCat1['id']; ?>"><?php echo $getNameCat1['location']; ?></option>
                                            <?php } ?>
										</select>
										<i class="arrow double"></i>
                                </label>
									</div>
								</div>
								
								 <div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Business Name</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="business_name" value="<?=$business_data['business_name']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Business Tagline</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="tagline" value="<?=$business_data['tagline']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Year of Establishment</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="established" value="<?=$business_data['established']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Awards</label>
									<div class="col-md-8">
										<textarea class="form-control" name="awards" style="height:100px;"><?=$business_data['awards']?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Certificates</label>
									<div class="col-md-8">
										<textarea class="form-control" name="certificates" style="height:100px;"><?=$business_data['certificates']?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Achievements</label>
									<div class="col-md-8">
										<textarea class="form-control" name="achievements" style="height:100px;"><?=$business_data['achievements']?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Offers</label>
									<div class="col-md-8">										
										<textarea class="form-control" name="offers" style="height:100px;"><?=$business_data['offers']?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Business Website</label>
									<div class="col-md-8">
										<input type="url" id="" class="form-control" name="business_website" value="<?=$business_data['business_website']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="row">
								<div class="col-md-12" style="text-align: center;">
                                    <button type="submit" name="update_business" class="btn btn-primary" style="float:right">
                                        Save &amp; Continue
                                    </button>
                                </div>
								</div>
								
								</div>
								</form>
								</div>
								
								<div id="tab-2" class="tab-content">
								<form>
								<div class="free_listing_form_areainner">
								
								 <div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Address</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="address" value="<?=$business_data['address']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">State</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="state" value="<?=$business_data['state']?>" required="" autofocus="">
									</div>
								</div>
																
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">City</label>
									<div class="col-md-8">
										<label class="field select">
                                        <select id="category" name="category" class="form-control" required style="width:300px">
                                        	<option value="">Choose City</option>
                                            <?php $getCategory1 = mysqli_query($CONN, "SELECT * FROM `locations` ORDER BY `location` ASC");
                	                              while($getNameCat1 = mysqli_fetch_array($getCategory1)) { ?>
                                                <option <?php if($getNameCat1['location'] == $business_data['city']) { ?> selected <?php } ?> value="<?php echo $getNameCat1['id']; ?>"><?php echo $getNameCat1['location']; ?></option>
                                            <?php } ?>
										</select>
										<i class="arrow double"></i>
                                </label>
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Phone No.</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="phone" value="<?=$business_data['phone']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">Mobile No.</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="alternative_number" value="<?=$business_data['alternative_number']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="email_address" class="col-md-4 col-form-label text-md-left">WhatsApp Number</label>
									<div class="col-md-8">
										<input type="text" id="" class="form-control" name="whatsapp" value="<?=$business_data['whatsapp']?>" required="" autofocus="">
									</div>
								</div>
								
								<div class="row">
								<div class="col-md-12" style="text-align: center;">
                                    <button type="submit" name="update_contact" class="btn btn-primary" style="float:right">
                                        Save &amp; Continue
                                    </button>
                                    
                                </div>
								</div>
								
								</div>
								</form>
								</div>
								<div id="tab-3" class="tab-content">
									<form>
									<div class="free_listing_form_areainner">
									<div class="payment_method_content">
									<p>Update your social media links so our customers may reach your social handles</p>
									<p><strong>Please Note :</strong> Edits may go for moderation and it can take up to 24-48 hours to be published.</p>
									</div>
									<div class="payment_method_list_area social_link_list_area">
								<div class="payment_method_list_areainner social_link_list_areainner">
								
								<div class="payment_method_list_blk social_link_list_blk">
								<div class="payment_method_list_blkinner social_link_list_blkinner">
									<div class="payment_title_area social_link_input_area">
										<div class="icon facebook"><i class="fa fa-facebook-square"></i></div>
										<div class="social_link_input_box">
										<input type="text" class="form-control" name="facebook_url" value="<?=$business_data['facebook_url']?>" placeholder="Facebook">
										</div>
									</div>
									
								</div>
								</div>
								<div class="payment_method_list_blk social_link_list_blk">
								<div class="payment_method_list_blkinner social_link_list_blkinner">
									<div class="payment_title_area social_link_input_area">
										<div class="icon instagram"><i class="fa fa-instagram"></i></div>
										<div class="social_link_input_box">
										<input type="text" class="form-control" name="instagram_url" value="<?=$business_data['instagram_url']?>" placeholder="Instagram">
										</div>
									</div>
									
								</div>
								</div>
								
								<div class="payment_method_list_blk social_link_list_blk">
								<div class="payment_method_list_blkinner social_link_list_blkinner">
									<div class="payment_title_area social_link_input_area">
										<div class="icon twiter"><i class="fa fa-twitter"></i></div>
										<div class="social_link_input_box">
										<input type="text" class="form-control" name="twitter_url" value="<?=$business_data['twitter_url']?>" placeholder="Twitter">
										</div>
									</div>
									
								</div>
								</div>
								
								<div class="payment_method_list_blk social_link_list_blk">
								<div class="payment_method_list_blkinner social_link_list_blkinner">
									<div class="payment_title_area social_link_input_area">
										<div class="icon youtube"><i class="fa fa-youtube-play"></i></div>
										<div class="social_link_input_box">
										<input type="text" class="form-control" name="youtube_url" value="<?=$business_data['youtube_url']?>" placeholder="YouTube">
										</div>
									</div>									
								</div>
								</div>
								
								<div class="payment_method_list_blk social_link_list_blk">
								<div class="payment_method_list_blkinner social_link_list_blkinner">
									<div class="payment_title_area social_link_input_area">
										<div class="icon linkedin"><i class="fa fa-linkedin"></i></div>
										<div class="social_link_input_box">
										<input type="text" class="form-control" name="linkedin_url" value="<?=$business_data['linkedin_url']?>" placeholder="Linkedin">
										</div>
									</div>									
								</div>
								</div>
								
								<div class="payment_method_list_blk social_link_list_blk">
								<div class="payment_method_list_blkinner social_link_list_blkinner">
									<div class="payment_title_area social_link_input_area">
										<div class="icon other"><i class="fa fa-link"></i></div>
										<div class="social_link_input_box">
										<input type="text" class="form-control" name="other_url" value="<?=$business_data['other_url']?>" placeholder="Others">
										</div>
									</div>									
								</div>
								</div>
								</div>
								</div>
									
								<div class="row">
								<div class="col-md-12" style="text-align: center;">
                                    <button type="submit" name="update_social" class="btn btn-primary">
                                        Save &amp; Continue
                                    </button>
                                    
                                </div>
								</div>	
									</div>
									</form>
								</div>
								<div id="tab-4" class="tab-content">
									<form>
									<div class="free_listing_form_areainner">
									<div class="payment_method_content">
									<p>Categories describe what your business is and the product and service your business offers. Please add atleast one category for customers to find your business.</p>
									<p><strong>Please Note :</strong> Edits may go for moderation and it can take up to 24-48 hours to be published.</p>									
									</div>
									<div class="cate_more_list_area ">
								<div class="add_cate_more_area">
								<div class="add_cate_more_areainner">
									<input type="text" class="form-control add_cate_more_input" placeholder="Add categories">
									<button type="button" class="add_cate_more_btn">
										Add
									</button><button>
								</button></div>	
								</div>
								<div class="cate_more_list_areainner">
								<ul>
								
								<li>								
								<div class="tag_blk">
								<div class="tag_blkinner">
								<div class="tag_name">Internate Wepage Development</div>
								<div class="tage_close"><span class="icon">x</span></div>
								</div>
								</div>
								</li>
								
								<li>								
								<div class="tag_blk">
								<div class="tag_blkinner">
								<div class="tag_name">Internate Wepage Development</div>
								<div class="tage_close"><span class="icon">x</span></div>
								</div>
								</div>
								</li>
								
								<li>								
								<div class="tag_blk">
								<div class="tag_blkinner">
								<div class="tag_name">Internate Wepage Development</div>
								<div class="tage_close"><span class="icon">x</span></div>
								</div>
								</div>
								</li>
								
								<li>								
								<div class="tag_blk">
								<div class="tag_blkinner">
								<div class="tag_name">Internate Wepage Development</div>
								<div class="tage_close"><span class="icon">x</span></div>
								</div>
								</div>
								</li>
								
								<li>								
								<div class="tag_blk">
								<div class="tag_blkinner">
								<div class="tag_name">Internate Wepage Development</div>
								<div class="tage_close"><span class="icon">x</span></div>
								</div>
								</div>
								</li>
								
								</ul>
								
								</div>
								</div>
								
								<div class="row">
								<div class="col-md-12" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary">
                                        Save &amp; Continue
                                    </button>
                                    <a href="#" class="btn btn-link" style="float:right">
                                       Next
                                    </a>
                                </div>
								</div>
									
								</div>
								</form>									
								</div>
								<div id="tab-5" class="tab-content">
									<form>
									<div class="free_listing_form_areainner">
									<div class="payment_method_content">
									<p>Update your operating hours so the customrs know when to reach you.You may select multiple timings in a day depending on the nature of your business.</p>
									<p><strong>Please Note :</strong> Edits may go for moderation and it can take up to 24-48 hours to be published.</p>									
									</div>
									<div class="timings_select_area">
								<div class="timings_select_areainner">
									<div class="timings_select_area_blk">
									<div class="theme_radio_checkbox">
									 <div class="radio">
										<label style="font-size: 1em">
											<input type="radio" name="o5" value="igotnone" onclick="show1();">
											<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
											Open 24 hours
										</label>
										
									</div>
									</div>
									</div>
									<div class="timings_select_area_blk">
									<div class="theme_radio_checkbox">
									 <div class="radio">
										<label style="font-size: 1em">
											<input type="radio" name="o5" value="igottwo" onclick="show2();">
											<span class="cr"><i class="cr-icon fa fa-circle"></i></span>
											Time Wise
										</label>
										
									</div>
									</div>								
									</div>
								</div>
								
								<div class="timing_list_area hide222" id="div1">
								<div class="timing_list_areainner">
								
								<div class="timing_list_area_blk">
								<div class="timing_list_area_blkinner">
									<div class="title">
									<h4>Mon</h4>
									</div>
									<div class="select_tme_area">
									<span>From</span> 
									<input type="time" class="time_input">
									<span>To</span> 
									<input type="time" class="time_input">
									</div>
								</div>
								</div>
								
								<div class="timing_list_area_blk">
								<div class="timing_list_area_blkinner">
									<div class="title">
									<h4>Tue</h4>
									</div>
									<div class="select_tme_area">
									<span>From</span> 
									<input type="time" class="time_input">
									<span>To</span> 
									<input type="time" class="time_input">
									</div>
								</div>
								</div>
								
								<div class="timing_list_area_blk">
								<div class="timing_list_area_blkinner">
									<div class="title">
									<h4>Wed</h4>
									</div>
									<div class="select_tme_area">
									<span>From</span> 
									<input type="time" class="time_input">
									<span>To</span> 
									<input type="time" class="time_input">
									</div>
								</div>
								</div>
								
								<div class="timing_list_area_blk">
								<div class="timing_list_area_blkinner">
									<div class="title">
									<h4>Thu</h4>
									</div>
									<div class="select_tme_area">
									<span>From</span> 
									<input type="time" class="time_input">
									<span>To</span> 
									<input type="time" class="time_input">
									</div>
								</div>
								</div>
								
								<div class="timing_list_area_blk">
								<div class="timing_list_area_blkinner">
									<div class="title">
									<h4>Fri</h4>
									</div>
									<div class="select_tme_area">
									<span>From</span> 
									<input type="time" class="time_input">
									<span>To</span> 
									<input type="time" class="time_input">
									</div>
								</div>
								</div>
								
								<div class="timing_list_area_blk">
								<div class="timing_list_area_blkinner">
									<div class="title">
									<h4>Sat</h4>
									</div>
									<div class="select_tme_area">
									<span>From</span> 
									<input type="time" class="time_input">
									<span>To</span> 
									<input type="time" class="time_input">
									</div>
								</div>
								</div>
								
								<div class="timing_list_area_blk">
								<div class="timing_list_area_blkinner">
									<div class="title">
									<h4>Sun</h4>
									</div>
									<div class="select_tme_area">
									<span>From</span> 
									<input type="time" class="time_input">
									<span>To</span> 
									<input type="time" class="time_input">
									</div>
								</div>
								</div>
								
								
								
								</div>
								</div>
								
								</div>
								
								<div class="row">
								<div class="col-md-12" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary">
                                        Save &amp; Continue
                                    </button>
                                    <a href="#" class="btn btn-link" style="float:right">
                                       Next
                                    </a>
                                </div>
								</div>
								
									
									</div>
									</form>
								</div>
								<div id="tab-6" class="tab-content">
									<form>
									<div class="free_listing_form_areainner">
									<div class="payment_method_content">
									<p>Update your operating hours so the customrs know when to reach you.You may select multiple timings in a day depending on the nature of your business.</p>
									<p><strong>Please Note :</strong> Edits may go for moderation and it can take up to 24-48 hours to be published.</p>									
									</div>
									<div class="photo_upload_area">
								
								<div class="photo_upload_areainner">
								<div class="row">
								
								
								<div class="col-lg-3 col-md-3 col-sm-4 col-6">
								<div class="photo_upload_fld">
								<div class="box">			
								<div class="js--image-preview"></div>
								<div class="upload-options">
								  <label>
									<input type="file" name="gallery27" class="image-upload" accept="image/*">
									<i class="fas fa-upload"></i> Upload
								  </label>
								</div>
								</div>
								<button type="submit" class="save_continue_btn">
                                        Save &amp; Continue
                                </button>
								</div>
								</div>
								
								
								<div class="col-lg-3 col-md-3 col-sm-4 col-6">
								<div class="photo_upload_thumb_blk">
								<div class="photo_upload_thumb_blkinner">
								<div class="photo_upload_thumb_blk_img">
								<img src="assets/img/noimage.png" class="img-fluid" alt="">
								</div>
								<a href="#" class="delete_btn">x</a>
								</div>
								</div>
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-4 col-6">
								<div class="photo_upload_thumb_blk">
								<div class="photo_upload_thumb_blkinner">
								<div class="photo_upload_thumb_blk_img">
								<img src="assets/img/noimage.png" class="img-fluid" alt="">
								</div>
								<a href="#" class="delete_btn">x</a>
								</div>
								</div>
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-4 col-6">
								<div class="photo_upload_thumb_blk">
								<div class="photo_upload_thumb_blkinner">
								<div class="photo_upload_thumb_blk_img">
								<img src="assets/img/noimage.png" class="img-fluid" alt="">
								</div>
								<a href="#" class="delete_btn">x</a>
								</div>
								</div>
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-4 col-6">
								<div class="photo_upload_thumb_blk">
								<div class="photo_upload_thumb_blkinner">
								<div class="photo_upload_thumb_blk_img">
								<img src="assets/img/noimage.png" class="img-fluid" alt="">
								</div>
								<a href="#" class="delete_btn">x</a>
								</div>
								</div>
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-4 col-6">
								<div class="photo_upload_thumb_blk">
								<div class="photo_upload_thumb_blkinner">
								<div class="photo_upload_thumb_blk_img">
								<img src="assets/img/noimage.png" class="img-fluid" alt="">
								</div>
								<a href="#" class="delete_btn">x</a>
								</div>
								</div>
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-4 col-6">
								<div class="photo_upload_thumb_blk">
								<div class="photo_upload_thumb_blkinner">
								<div class="photo_upload_thumb_blk_img">
								<img src="assets/img/noimage.png" class="img-fluid" alt="">
								</div>
								<a href="#" class="delete_btn">x</a>
								</div>
								</div>
								</div>
								
								
								</div>
								</div>
								</div>
									
									<!--<div class="col-md-12" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary">
                                        Save &amp; Continue
                                    </button>
                                    <a href="#" class="btn btn-link" style="float:right">
                                       Next
                                    </a>
									</div>-->
									
									</div>
									</form>
								</div>
								
								</div>
									
									
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			
			
			

                
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
} );
</script>

<!-- /Scripts -->
<script>
$(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
</script>
<script>
function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}

</script> 
<script>

function initImageUpload(box) {
  let uploadField = box.querySelector('.image-upload');

  uploadField.addEventListener('change', getFile);

  function getFile(e){
    let file = e.currentTarget.files[0];
    checkType(file);
  }
  
  function previewImage(file){
    let thumb = box.querySelector('.js--image-preview'),
        reader = new FileReader();

    reader.onload = function() {
      thumb.style.backgroundImage = 'url(' + reader.result + ')';
    }
    reader.readAsDataURL(file);
    thumb.className += ' js--no-default';
  }

  function checkType(file){
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw 'Datei ist kein Bild';
    } else if (!file){
      throw 'Kein Bild gewählt';
    } else {
      previewImage(file);
    }
  }
  
}

// initialize box-scope
var boxes = document.querySelectorAll('.box');

for (let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  initDropEffect(box);
  initImageUpload(box);
}



/// drop-effect
function initDropEffect(box){
  let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
  
  // get clickable area for drop effect
  area = box.querySelector('.js--image-preview');
  area.addEventListener('click', fireRipple);
  
  function fireRipple(e){
    area = e.currentTarget
    // create drop
    if(!drop){
      drop = document.createElement('span');
      drop.className = 'drop';
      this.appendChild(drop);
    }
    // reset animate class
    drop.className = 'drop';
    
    // calculate dimensions of area (longest side)
    areaWidth = getComputedStyle(this, null).getPropertyValue("width");
    areaHeight = getComputedStyle(this, null).getPropertyValue("height");
    maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

    // set drop dimensions to fill area
    drop.style.width = maxDistance + 'px';
    drop.style.height = maxDistance + 'px';
    
    // calculate dimensions of drop
    dropWidth = getComputedStyle(this, null).getPropertyValue("width");
    dropHeight = getComputedStyle(this, null).getPropertyValue("height");
    
    // calculate relative coordinates of click
    // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
    x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
    y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;
    
    // position drop and animate
    drop.style.top = y + 'px';
    drop.style.left = x + 'px';
    drop.className += ' animate';
    e.stopPropagation();
    
  }
}
</script>
</body>
</html>
