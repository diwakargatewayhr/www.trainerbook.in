<?php include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
	header("location:login");
}

if(isset($_REQUEST['submit']) && $_REQUEST['blog_title'] != '' && @$_REQUEST['edit'] == '')
{
	$random = rand(111111,999999);
	$target_path = "../upload/blog/".$random;
	$target_path = $target_path . basename($_FILES['ufile']['name']);
	$FileName = $random.$_FILES['ufile']['name'];

    $link = $_REQUEST['youtube'];
    parse_str(parse_url($link, PHP_URL_QUERY), $query);
    $videoId = isset($query['v']) ? $query['v'] : null;

	if(move_uploaded_file($_FILES['ufile']['tmp_name'], $target_path))
	{
		mysqli_query($CONN, "INSERT INTO `blogs` (`blog_id`, `category`, `blog_title`, `short_brief`, `description`, `youtube`, `outside_url`, `featured_pic`, `date`, `time`, `datetime`, `featured`, `status`) VALUES ('', '".$_REQUEST['category']."', '".$_REQUEST['blog_title']."', '".addslashes($_REQUEST['short_brief'])."', '".addslashes($_REQUEST['description'])."', '".$v."', '".$_REQUEST['outside_url']."', '".$FileName."', '".date("d, M Y")."', '".date("G:i A")."', now(), '".$_REQUEST['featured']."', 'Y')");
		header("location:add-blog?add=done");
		exit;
	}
		else
	{
		mysqli_query($CONN, "INSERT INTO `blogs` (`blog_id`, `category`, `blog_title`, `short_brief`, `description`, `youtube`, `outside_url`, `date`, `time`, `datetime`, `featured`, `status`) VALUES ('', '".$_REQUEST['category']."', '".$_REQUEST['blog_title']."', '".addslashes($_REQUEST['short_brief'])."', '".addslashes($_REQUEST['description'])."', '".$v."', '".$_REQUEST['outside_url']."', '".date("d, M Y")."', '".date("G:i A")."', now(), '".$_REQUEST['featured']."', 'Y')");
		header("location:add-blog?add=done");
		exit;
	}
}

if(isset($_REQUEST['submit']) && $_REQUEST['blog_title'] != '' && $_REQUEST['edit'] != '')
{
	$random = rand(111111,999999);
	$target_path = "../upload/blog/".$random;
	$target_path = $target_path . basename($_FILES['ufile']['name']);
	$FileName = $random.$_FILES['ufile']['name'];

    $link = $_REQUEST['youtube'];
    parse_str(parse_url($link, PHP_URL_QUERY), $query);
    $videoId = isset($query['v']) ? $query['v'] : null;

	if(move_uploaded_file($_FILES['ufile']['tmp_name'], $target_path))
	{
		mysqli_query($CONN, "UPDATE `blogs` SET `category` = '".$_REQUEST['category']."', `blog_title` = '".$_REQUEST['blog_title']."', `short_brief` = '".addslashes($_REQUEST['short_brief'])."', `description` = '".addslashes($_REQUEST['description'])."', `youtube` = '".$v."', `outside_url` = '".$_REQUEST['outside_url']."', `featured_pic` = '".$FileName."' WHERE `blog_id` = '".$_REQUEST['edit']."'");
		header("location:add-blog?update=done&edit=".$_REQUEST['edit']."");
		exit;
	}
		else
	{
		mysqli_query($CONN, "UPDATE `blogs` SET `category` = '".$_REQUEST['category']."', `blog_title` = '".$_REQUEST['blog_title']."', `short_brief` = '".addslashes($_REQUEST['short_brief'])."', `description` = '".addslashes($_REQUEST['description'])."', `youtube` = '".$v."', `outside_url` = '".$_REQUEST['outside_url']."' WHERE `blog_id` = '".$_REQUEST['edit']."'");
		header("location:add-blog?update=done&edit=".$_REQUEST['edit']."");
		exit;
	}
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
<script>
tinymce.init({
  selector: 'textarea',
  plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
  toolbar_mode: 'floating',
  height : "300"
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



		<?php if(@$_REQUEST['add'] == 'done') { ?>

            <div class="alert alert-success dark alert-dismissable">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <i class="fa fa-info pr10"></i> Congrats! Insight Published successfully!</div>

		<?php } ?>



        <?php if(@$_REQUEST['update'] == 'done') { ?>

        <div class="alert alert-success dark alert-dismissable">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <i class="fa fa-info pr10"></i> Congrats! Insight informations updated successfully!</div>

		<?php } ?>

        

        <!-- -------------- Content -------------- -->

        <form action="" method="post" enctype="multipart/form-data" name="form1">

            <?php $getGroup = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `blogs` WHERE blog_id = '".@$_REQUEST['edit']."'")); ?>

        	<section id="content" class="table-layout animated fadeIn">



            <!-- -------------- Column Center -------------- -->

            <div class="chute chute-center">



                <div class="mw1000 center-block">



					<!-- -------------- Change Password -------------- -->

                    <div class="panel mb35">

                        <div class="panel-heading">

                            <span class="panel-title"><?php if(@$_REQUEST['edit']!='') { ?>Update<?php } else { ?>Add<?php } ?> Blog</span>

                        </div>

                        <div class="panel-body br-t">

                            <div class="allcp-form theme-primary">



                            <div class="section row mb25">

                            <label for="refund-policy" class="field-label col-sm-2 ph10">Category</label>

								<div class="col-sm-10 ph10">

                                    <label class="field select" style="width:40%;">

                                        <select id="category" name="category">

                                        	<option value="">Select Category...</option>

                                            <?php $getCategory1 = mysqli_query($CONN, "SELECT * FROM `blog_category` ORDER by category_name ASC");

                	                              while($getNameCat1 = mysqli_fetch_array($getCategory1)) { ?>

                                                <option <?php if(@$getGroup['category'] == @$getNameCat1['cat_id']) { ?> selected <?php } ?> value="<?php echo @$getNameCat1['cat_id']; ?>"><?php echo @$getNameCat1['category_name']; ?></option>

                                            <?php } ?>

                                        </select>

                                        <i class="arrow double"></i>

                                    </label>

                                </div>

                            </div>



                            <div class="section row mb25">

                            <label for="refund-policy" class="field-label col-sm-2 ph10">Blog Title</label>

                                <div class="col-sm-10 ph10">

                                    <input type="text" name="blog_title" class="gui-input" value="<?php echo @$getGroup['blog_title']; ?>">

                                </div>

                            </div>



                            <div class="section row mb25">

                            <label for="refund-policy" class="field-label col-sm-2 ph10">Short Brief</label>

                                <div class="col-sm-10 ph10">

                                    <textarea class="gui-textarea" name="short_brief"><?php echo @$getGroup['short_brief']; ?></textarea>

                                </div>

                            </div>



                            <div class="section row mb25">

                            <label for="refund-policy" class="field-label col-sm-2 ph10">Description</label>

                                <div class="col-sm-10 ph10">

                                    <textarea class="gui-textarea" name="description"><?php echo @$getGroup['description']; ?></textarea>

                                </div>

                            </div>



                            <div class="section row mb25">

                            <label for="refund-policy" class="field-label col-sm-2 ph10">YouTube URL</label>

                                <div class="col-sm-10 ph10">

                                    <input type="text" name="youtube" class="gui-input" placeholder="e.g. https://www.youtube.com/watch?v=UdcqAj45B0s" value="<?php if(@$getGroup['youtube'] !='') { ?>https://www.youtube.com/watch?v=<?php echo @$getGroup['youtube']; } ?>">

                                </div>

                            </div>



                            <div class="section row mb25">

                            <label for="refund-policy" class="field-label col-sm-2 ph10">External URL</label>

                                <div class="col-sm-10 ph10">

                                    <input type="text" name="outside_url" class="gui-input" value="<?php echo @$getGroup['outside_url']; ?>">

                                </div>

                            </div>



                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Featured Picture</label>
                                <div class="col-sm-10 ph10">
                                    <input type="file" name="ufile" id="fileField">
                                    <img src="../upload/blog/<?php echo @$getGroup['featured_pic']; ?>" width="250" alt="" />
                                    <div style="color:red; padding:5px 0 0 0;">(Image Size: 823px x 584px) Max Size: 1MB</div>
                                </div>
                            </div>



                            <div class="section row mb25">

                            <label for="refund-policy" class="field-label col-sm-2 ph10"></label>

                                <div class="col-sm-10 ph10">

                                    <input type="checkbox" name="featured" value="Y" <?php if(@$getGroup['featured'] == 'Y' || @$getGroup['featured'] == '') { ?> checked <?php } ?> /> Mark to make Featured Blog

                                </div>

                            </div>



                            </div>

                        </div>

                    </div>



					<input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if(@$_REQUEST['edit']!='') { ?>UPDATE<?php } else { ?>ADD<?php } ?> BLOG">

                </div>



            </div>

            <!-- -------------- /Column Center -------------- -->



        </section>



        </form>

		<!-- -------------- /Content -------------- -->



    </section>



    <!-- -------------- Sidebar Right -------------- -->

  <aside id="sidebar_right" class="nano affix">



        <!-- -------------- Sidebar Right Content -------------- -->

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

    <!-- -------------- /Sidebar Right -------------- -->



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

