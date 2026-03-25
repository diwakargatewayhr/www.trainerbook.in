<?php include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
	header("location:login");
}

$getData = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `home_page` WHERE `id` = '1'"));
if(isset($_REQUEST['submit']))
{
	$random = rand(1,999999);
	$target_path = "../upload/ads/".$random;
	$target_path = $target_path . basename($_FILES['banner_ads01']['name']);
	$FileName = $random.$_FILES['banner_ads01']['name'];
		
	if($_FILES['banner_ads01']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads01']['tmp_name'], $target_path);
		$homethumb1 = $FileName;
	}
	else
	{
		$homethumb1 = $getData['banner_ads01'];
	}
	
	$target_path2 = "../upload/ads/".$random;
	$target_path2 = $target_path2 . basename($_FILES['banner_ads02']['name']);
	$FileName2 = $random.$_FILES['banner_ads02']['name'];
		
	if($_FILES['banner_ads02']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads02']['tmp_name'], $target_path2);
		$homethumb2 = $FileName2;
	}
	else
	{
		$homethumb2 = $getData['banner_ads02'];
	}
	
	$target_path3 = "../upload/ads/".$random;
	$target_path3 = $target_path3 . basename($_FILES['banner_ads03']['name']);
	$FileName3 = $random.$_FILES['banner_ads03']['name'];
		
	if($_FILES['banner_ads03']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads03']['tmp_name'], $target_path3);
		$homethumb3 = $FileName3;
	}
	else
	{
		$homethumb3 = $getData['banner_ads03'];
	}
	
	$target_path4 = "../upload/ads/".$random;
	$target_path4 = $target_path4 . basename($_FILES['banner_ads04']['name']);
	$FileName4 = $random.$_FILES['banner_ads04']['name'];
		
	if($_FILES['banner_ads04']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads04']['tmp_name'], $target_path4);
		$homethumb4 = $FileName4;
	}
	else
	{
		$homethumb4 = $getData['banner_ads04'];
	}
	
	$target_path5 = "../upload/ads/".$random;
	$target_path5 = $target_path5 . basename($_FILES['banner_ads05']['name']);
	$FileName5 = $random.$_FILES['banner_ads05']['name'];
		
	if($_FILES['banner_ads05']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads05']['tmp_name'], $target_path5);
		$homethumb5 = $FileName5;
	}
	else
	{
		$homethumb5 = $getData['banner_ads05'];
	}
	
	$target_path6 = "../upload/ads/".$random;
	$target_path6 = $target_path6 . basename($_FILES['banner_ads06']['name']);
	$FileName6 = $random.$_FILES['banner_ads06']['name'];
		
	if($_FILES['banner_ads06']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads06']['tmp_name'], $target_path6);
		$homethumb6 = $FileName6;
	}
	else
	{
		$homethumb6 = $getData['banner_ads06'];
	}
	
	$target_path7 = "../upload/ads/".$random;
	$target_path7 = $target_path7 . basename($_FILES['banner_ads07']['name']);
	$FileName7 = $random.$_FILES['banner_ads07']['name'];
		
	if($_FILES['banner_ads07']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads07']['tmp_name'], $target_path7);
		$homethumb7 = $FileName7;
	}
	else
	{
		$homethumb7 = $getData['banner_ads07'];
	}
	
	$target_path8 = "../upload/ads/".$random;
	$target_path8 = $target_path8 . basename($_FILES['banner_ads08']['name']);
	$FileName8 = $random.$_FILES['banner_ads08']['name'];
		
	if($_FILES['banner_ads08']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads08']['tmp_name'], $target_path8);
		$homethumb8 = $FileName8;
	}
	else
	{
		$homethumb8 = $getData['banner_ads08'];
	}
	
	$target_path9 = "../upload/ads/".$random;
	$target_path9 = $target_path9 . basename($_FILES['banner_ads09']['name']);
	$FileName9 = $random.$_FILES['banner_ads09']['name'];
		
	if($_FILES['banner_ads09']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads09']['tmp_name'], $target_path9);
		$homethumb9 = $FileName9;
	}
	else
	{
		$homethumb9 = $getData['banner_ads09'];
	}
	
	$target_path10 = "../upload/ads/".$random;
	$target_path10 = $target_path10 . basename($_FILES['banner_ads10']['name']);
	$FileName10 = $random.$_FILES['banner_ads10']['name'];
		
	if($_FILES['banner_ads10']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads10']['tmp_name'], $target_path10);
		$homethumb10 = $FileName10;
	}
	else
	{
		$homethumb10 = $getData['banner_ads10'];
	}
	
	$target_path11 = "../upload/ads/".$random;
	$target_path11 = $target_path11 . basename($_FILES['banner_ads11']['name']);
	$FileName11 = $random.$_FILES['banner_ads11']['name'];
		
	if($_FILES['banner_ads11']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads11']['tmp_name'], $target_path11);
		$homethumb11 = $FileName11;
	}
	else
	{
		$homethumb11 = $getData['banner_ads11'];
	}
	
	$target_path12 = "../upload/ads/".$random;
	$target_path12 = $target_path12 . basename($_FILES['banner_ads12']['name']);
	$FileName12 = $random.$_FILES['banner_ads12']['name'];
		
	if($_FILES['banner_ads12']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads12']['tmp_name'], $target_path12);
		$homethumb12 = $FileName12;
	}
	else
	{
		$homethumb12 = $getData['banner_ads12'];
	}
	
	$target_path13 = "../upload/ads/".$random;
	$target_path13 = $target_path13 . basename($_FILES['banner_ads13']['name']);
	$FileName13 = $random.$_FILES['banner_ads13']['name'];
		
	if($_FILES['banner_ads13']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads13']['tmp_name'], $target_path13);
		$homethumb13 = $FileName13;
	}
	else
	{
		$homethumb13 = $getData['banner_ads13'];
	}
	
	$target_path14 = "../upload/ads/".$random;
	$target_path14 = $target_path14 . basename($_FILES['banner_ads14']['name']);
	$FileName14 = $random.$_FILES['banner_ads14']['name'];
		
	if($_FILES['banner_ads14']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads14']['tmp_name'], $target_path14);
		$homethumb14 = $FileName14;
	}
	else
	{
		$homethumb14 = $getData['banner_ads14'];
	}
	
	$target_path15 = "../upload/ads/".$random;
	$target_path15 = $target_path15 . basename($_FILES['banner_ads15']['name']);
	$FileName15 = $random.$_FILES['banner_ads15']['name'];
		
	if($_FILES['banner_ads15']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads15']['tmp_name'], $target_path15);
		$homethumb15 = $FileName15;
	}
	else
	{
		$homethumb15 = $getData['banner_ads15'];
	}
	
	$target_path16 = "../upload/ads/".$random;
	$target_path16 = $target_path16 . basename($_FILES['banner_ads16']['name']);
	$FileName16 = $random.$_FILES['banner_ads16']['name'];
		
	if($_FILES['banner_ads16']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads16']['tmp_name'], $target_path16);
		$homethumb16 = $FileName16;
	}
	else
	{
		$homethumb16 = $getData['banner_ads16'];
	}
	
	$target_path17 = "../upload/ads/".$random;
	$target_path17 = $target_path17 . basename($_FILES['banner_ads17']['name']);
	$FileName17 = $random.$_FILES['banner_ads17']['name'];
		
	if($_FILES['banner_ads17']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads17']['tmp_name'], $target_path17);
		$homethumb17 = $FileName17;
	}
	else
	{
		$homethumb17 = $getData['banner_ads17'];
	}
	
	$target_path18 = "../upload/ads/".$random;
	$target_path18 = $target_path18 . basename($_FILES['banner_ads18']['name']);
	$FileName18 = $random.$_FILES['banner_ads18']['name'];
		
	if($_FILES['banner_ads18']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads18']['tmp_name'], $target_path18);
		$homethumb18 = $FileName18;
	}
	else
	{
		$homethumb18 = $getData['banner_ads18'];
	}
	
	$target_path19 = "../upload/ads/".$random;
	$target_path19 = $target_path19 . basename($_FILES['banner_ads19']['name']);
	$FileName19 = $random.$_FILES['banner_ads19']['name'];
		
	if($_FILES['banner_ads19']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads19']['tmp_name'], $target_path19);
		$homethumb19 = $FileName19;
	}
	else
	{
		$homethumb19 = $getData['banner_ads19'];
	}
	
	$target_path20 = "../upload/ads/".$random;
	$target_path20 = $target_path20 . basename($_FILES['banner_ads20']['name']);
	$FileName20 = $random.$_FILES['banner_ads20']['name'];
		
	if($_FILES['banner_ads20']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads20']['tmp_name'], $target_path20);
		$homethumb20 = $FileName20;
	}
	else
	{
		$homethumb20 = $getData['banner_ads20'];
	}
	
	$target_path21 = "../upload/ads/".$random;
	$target_path21 = $target_path21 . basename($_FILES['banner_ads21']['name']);
	$FileName21 = $random.$_FILES['banner_ads21']['name'];
		
	if($_FILES['banner_ads21']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads21']['tmp_name'], $target_path21);
		$homethumb21 = $FileName21;
	}
	else
	{
		$homethumb21 = $getData['banner_ads21'];
	}
	
	$target_path22 = "../upload/ads/".$random;
	$target_path22 = $target_path22 . basename($_FILES['banner_ads22']['name']);
	$FileName22 = $random.$_FILES['banner_ads22']['name'];
		
	if($_FILES['banner_ads22']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads22']['tmp_name'], $target_path22);
		$homethumb22 = $FileName22;
	}
	else
	{
		$homethumb22 = $getData['banner_ads22'];
	}
	
	$target_path23 = "../upload/ads/".$random;
	$target_path23 = $target_path23 . basename($_FILES['banner_ads23']['name']);
	$FileName23 = $random.$_FILES['banner_ads23']['name'];
		
	if($_FILES['banner_ads23']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads23']['tmp_name'], $target_path23);
		$homethumb23 = $FileName23;
	}
	else
	{
		$homethumb23 = $getData['banner_ads23'];
	}
	
	$target_path24 = "../upload/ads/".$random;
	$target_path24 = $target_path24 . basename($_FILES['banner_ads24']['name']);
	$FileName24 = $random.$_FILES['banner_ads24']['name'];
		
	if($_FILES['banner_ads24']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads24']['tmp_name'], $target_path24);
		$homethumb24 = $FileName24;
	}
	else
	{
		$homethumb24 = $getData['banner_ads24'];
	}
	
	$target_path25 = "../upload/ads/".$random;
	$target_path25 = $target_path25 . basename($_FILES['banner_ads25']['name']);
	$FileName25 = $random.$_FILES['banner_ads25']['name'];
		
	if($_FILES['banner_ads25']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads25']['tmp_name'], $target_path25);
		$homethumb25 = $FileName25;
	}
	else
	{
		$homethumb25 = $getData['banner_ads25'];
	}
	
	$target_path26 = "../upload/ads/".$random;
	$target_path26 = $target_path26 . basename($_FILES['banner_ads26']['name']);
	$FileName26 = $random.$_FILES['banner_ads26']['name'];
		
	if($_FILES['banner_ads26']['name'] != '')
	{
		move_uploaded_file($_FILES['banner_ads26']['tmp_name'], $target_path26);
		$homethumb26 = $FileName26;
	}
	else
	{
		$homethumb26 = $getData['banner_ads26'];
	}
	
	mysqli_query($CONN, "UPDATE `home_page` SET `banner_ads01` = '".$homethumb1."', `banner_ads01_url` = '".$_REQUEST['banner_ads01_url']."', `banner_ads02` = '".$homethumb2."', `banner_ads02_url` = '".$_REQUEST['banner_ads02_url']."', `banner_ads03` = '".$homethumb3."', `banner_ads03_url` = '".$_REQUEST['banner_ads03_url']."', `banner_ads04` = '".$homethumb4."', `banner_ads04_url` = '".$_REQUEST['banner_ads04_url']."', `banner_ads05` = '".$homethumb5."', `banner_ads05_url` = '".$_REQUEST['banner_ads05_url']."', `banner_ads06` = '".$homethumb6."', `banner_ads06_url` = '".$_REQUEST['banner_ads06_url']."', `banner_ads07` = '".$homethumb7."', `banner_ads07_url` = '".$_REQUEST['banner_ads07_url']."', `banner_ads08` = '".$homethumb8."', `banner_ads08_url` = '".$_REQUEST['banner_ads08_url']."', `banner_ads09` = '".$homethumb9."', `banner_ads09_url` = '".$_REQUEST['banner_ads09_url']."', `banner_ads10` = '".$homethumb10."', `banner_ads10_url` = '".$_REQUEST['banner_ads10_url']."', `banner_ads11` = '".$homethumb11."', `banner_ads11_url` = '".$_REQUEST['banner_ads11_url']."', `banner_ads12` = '".$homethumb12."', `banner_ads12_url` = '".$_REQUEST['banner_ads12_url']."', `banner_ads13` = '".$homethumb13."', `banner_ads13_url` = '".$_REQUEST['banner_ads13_url']."', `banner_ads14` = '".$homethumb14."', `banner_ads14_url` = '".$_REQUEST['banner_ads14_url']."', `banner_ads15` = '".$homethumb15."', `banner_ads15_url` = '".$_REQUEST['banner_ads15_url']."', `banner_ads16` = '".$homethumb16."', `banner_ads16_url` = '".$_REQUEST['banner_ads16_url']."', `banner_ads17` = '".$homethumb17."', `banner_ads17_url` = '".$_REQUEST['banner_ads17_url']."', `banner_ads18` = '".$homethumb18."', `banner_ads18_url` = '".$_REQUEST['banner_ads18_url']."', `banner_ads19` = '".$homethumb19."', `banner_ads19_url` = '".$_REQUEST['banner_ads19_url']."', `banner_ads20` = '".$homethumb20."', `banner_ads20_url` = '".$_REQUEST['banner_ads20_url']."', `banner_ads21` = '".$homethumb21."', `banner_ads21_url` = '".$_REQUEST['banner_ads21_url']."', `banner_ads22` = '".$homethumb22."', `banner_ads22_url` = '".$_REQUEST['banner_ads22_url']."', `banner_ads23` = '".$homethumb23."', `banner_ads23_url` = '".$_REQUEST['banner_ads23_url']."', `banner_ads24` = '".$homethumb24."', `banner_ads24_url` = '".$_REQUEST['banner_ads24_url']."', `banner_ads25` = '".$homethumb25."', `banner_ads25_url` = '".$_REQUEST['banner_ads25_url']."', `banner_ads26` = '".$homethumb26."', `banner_ads26_url` = '".$_REQUEST['banner_ads26_url']."' WHERE `id` = '1'");
	header("location:home_editor?update=done"); exit;
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

<style>
.allcp-form .prepend-icon > input, .allcp-form .prepend-icon > textarea {
    padding-left: 12px;
}
</style>

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
                            <span class="panel-title">Home Page Editor</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
                            
                                <div class="panel-heading">
                                    <span class="panel-title">Category Block</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 1
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 2
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 3
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 4
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 5
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 6
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 7
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 8
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Block 9
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                
                                <div class="panel-heading">
                                    <span class="panel-title">Banner Ads</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-8" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Banner Size (1262 W x 525 H)
                                                <input type="file" name="banner_ads01" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads01']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads01_url" class="gui-input" placeholder="Banner URL" value="<?=@$getData['banner_ads01_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Banner Size (1262 W x 525 H)
                                                <input type="file" name="banner_ads02" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads02']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads02_url" class="gui-input" placeholder="Banner URL" value="<?=$getData['banner_ads02_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                
                                <div class="panel-heading">
                                    <span class="panel-title">Testimonial</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Testimonial 1
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Testimonial 2
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Testimonial 3
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Hot Combo Deals</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Banner Size (585 W x 585 H)
                                                <input type="file" name="banner_ads03" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads03']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads03_url" class="gui-input" placeholder="Banner URL" value="<?=@$getData['banner_ads03_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Banner Size (585 W x 585 H)
                                                <input type="file" name="banner_ads04" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads04']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads04_url" class="gui-input" placeholder="Banner URL" value="<?=@$getData['banner_ads04_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Banner Size (585 W x 585 H)
                                                <input type="file" name="banner_ads05" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads05']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads05_url" class="gui-input" placeholder="Banner URL" value="<?=@$getData['banner_ads05_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                
                                <div class="panel-heading">
                                    <span class="panel-title">Experience Our Services</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads06" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads06']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads06_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads06_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads07" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads07']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads07_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads07_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads08" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads08']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads08_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads08_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads09" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads09']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads09_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads09_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads10" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads10']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads10_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads10_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads11" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads11']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads11_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads11_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads12" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads12']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads12_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads12_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads13" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads13']?>" height="150px" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads13_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads13_url']; ?>">
                                                </label>
                                            </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads14" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads14']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads14_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads14_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Message Banner</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
                                                <input type="file" name="banner_ads15" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads15']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads15_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads15_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Earn Points Ads</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
                                                <input type="file" name="banner_ads16" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads16']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads16_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads16_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Makeup Banner Ads</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-10 ph12">Image Size (1920 W x 650 H)
                                                <input type="file" name="banner_ads17" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads17']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads17_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads17_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Deals Banner</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 585 H)
                                                <input type="file" name="banner_ads18" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads18']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads18_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads18_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 585 H)
                                                <input type="file" name="banner_ads19" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads19']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads19_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads19_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 585 H)
                                                <input type="file" name="banner_ads20" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads20']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads20_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads20_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Get your wedding glow</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
                                                <input type="file" name="banner_ads21" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads21']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads21_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads21_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Male Grooming</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-6" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (900 W x 800 H)
                                                <input type="file" name="banner_ads22" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads22']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads22_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads22_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (900 W x 800 H)
                                                <input type="file" name="banner_ads23" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads23']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads23_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads23_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (900 W x 800 H)
                                                <input type="file" name="banner_ads24" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads24']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads24_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads24_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (900 W x 800 H)
                                                <input type="file" name="banner_ads25" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads25']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads25_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads25_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Safety Guidelines</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
                                                <input type="file" name="banner_ads26" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads26']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads26_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads26_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
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
