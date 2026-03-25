<?php include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
	header("location:login");
}

$getData = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `category_page` WHERE `id` = '1'"));
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
	
	mysqli_query($CONN, "UPDATE `category_page` SET `banner_ads01` = '".$homethumb1."', `banner_ads01_url` = '".$_REQUEST['banner_ads01_url']."', `banner_ads02` = '".$homethumb2."', `banner_ads02_url` = '".$_REQUEST['banner_ads02_url']."', `banner_ads03` = '".$homethumb3."', `banner_ads03_url` = '".$_REQUEST['banner_ads03_url']."', `banner_ads04` = '".$homethumb4."', `banner_ads04_url` = '".$_REQUEST['banner_ads04_url']."', `banner_ads05` = '".$homethumb5."', `banner_ads05_url` = '".$_REQUEST['banner_ads05_url']."', `banner_ads06` = '".$homethumb6."', `banner_ads06_url` = '".$_REQUEST['banner_ads06_url']."', `banner_ads07` = '".$homethumb7."', `banner_ads07_url` = '".$_REQUEST['banner_ads07_url']."', `banner_ads08` = '".$homethumb8."', `banner_ads08_url` = '".$_REQUEST['banner_ads08_url']."', `banner_ads09` = '".$homethumb9."', `banner_ads09_url` = '".$_REQUEST['banner_ads09_url']."', `banner_ads10` = '".$homethumb10."', `banner_ads10_url` = '".$_REQUEST['banner_ads10_url']."' WHERE `id` = '1'");
	header("location:category_editor?update=done"); exit;
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
                            <span class="panel-title">Category Page Editor</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
                            
                                <div class="panel-heading">
                                    <span class="panel-title">Services Block</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 1
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 2
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 3
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 4
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 5
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 6
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 7
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 8
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid; height:50px;">
                                        Service Category 9
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Luxury Facial Ads</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
                                                <input type="file" name="banner_ads01" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads01']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads01_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads01_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
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
                                                <input type="file" name="banner_ads02" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads02']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads02_url" class="gui-input" placeholder="Banner URL" value="<?=@$getData['banner_ads02_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
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
                                </div>
                                
                                
                                
                                <!--<p></p>
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
                                                    <input type="text" name="banner_ads01_url" class="gui-input" placeholder="Banner URL" value="<?=$getData['banner_ads01_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Banner Size (1262 W x 525 H)
                                                <input type="file" name="banner_ads02" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads02']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads02_url" class="gui-input" placeholder="Banner URL" value="<?=$getData['banner_ads02_url']?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                
                                
                                
                                <!--<p></p>
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
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads06']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads06_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads06_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads07" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads07']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads07_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads07_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads08" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads08']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads08_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads08_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads09" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads09']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads09_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads09_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads10" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads10']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads10_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads10_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads11" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads11']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads11_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads11_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads12" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads12']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads12_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads12_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads13" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads13']?>" height="150px" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads13_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads13_url']; ?>">
                                                </label>
                                            </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 525 H)
                                                <input type="file" name="banner_ads14" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads14']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads14_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads14_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                
                                
                                
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Thai Message Banner</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
                                                <input type="file" name="banner_ads05" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=@$getData['banner_ads05']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads05_url" class="gui-input" placeholder="Banner URL" value="<?php echo @$getData['banner_ads05_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Why Choose Us</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-10 ph12">Image Size (1920 W x 650 H)
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
                                </div>
                                
                                
                                <!--<p></p>
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
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads18']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads18_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads18_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 585 H)
                                                <input type="file" name="banner_ads19" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads19']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads19_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads19_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (585 W x 585 H)
                                                <input type="file" name="banner_ads20" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads20']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads20_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads20_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                
                                
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Deal of the Day</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
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
                                </div>
                                
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Hair Treatment</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
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
                                </div>
                                
                                <p></p>
                                <hr class="short alt">
                                <div class="panel-heading">
                                    <span class="panel-title">Different Waxing Alternatives</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
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
                                </div>
                                
                                <!--<p></p>
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
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads22']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads22_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads22_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (900 W x 800 H)
                                                <input type="file" name="banner_ads23" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads23']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads23_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads23_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (900 W x 800 H)
                                                <input type="file" name="banner_ads24" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads24']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads24_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads24_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (900 W x 800 H)
                                                <input type="file" name="banner_ads25" id="fileField">
                                                <div style="padding:8px 0;"><img src="../upload/ads/<?=$getData['banner_ads25']?>" height="150px" alt="" /></div>
                                            </div>
                                            <div class="col-md-12 ph10 mb5">
                                                <label for="city" class="field prepend-icon">
                                                    <input type="text" name="banner_ads25_url" class="gui-input" placeholder="Banner URL" value="<?php echo $getData['banner_ads25_url']; ?>">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                
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
                                    <span class="panel-title">Rubber Mask</span>
                                </div>
                                <p></p>
                                <div class="row">
                                	<div class="col-md-12" style="border:#000 1px solid;">
                                        <div class="section row mb10">
                                            <div class="col-sm-12 ph10">Image Size (1920 W x 650 H)
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
