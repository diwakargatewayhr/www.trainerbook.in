<?php include("../includes/config.php");
include("../includes/functions.php");
if($_SESSION['AdminID'] < '1')
{
	header("location:login");
}

if(isset($_REQUEST['submit']) && $_REQUEST['heading'] != '' && $_REQUEST['edit'] == '')
{
	$random = rand(111111,999999);
	$target_path = "../upload/blogs/".$random;	
	$target_path = $target_path . basename($_FILES['thumb']['name']);
	$FileName = $random.$_FILES['thumb']['name'];
	
	if(move_uploaded_file($_FILES['thumb']['tmp_name'], $target_path))
	{
		mysqli_query($CONN, "INSERT INTO `blogs` (`id`, `heading`, `subtext`, `content`, `thumb`, `datetime`, `status`) VALUES ('', '".addslashes($_REQUEST['heading'])."', '".addslashes($_REQUEST['subtext'])."', '".addslashes(nl2br($_REQUEST['content']))."', '".$FileName."', now(), 'Y')");
        header("location:create-post?update=done"); exit;
	}
	else
	{
		mysqli_query($CONN, "INSERT INTO `blogs` (`id`, `heading`, `subtext`, `content`, `thumb`, `datetime`, `status`) VALUES ('', '".addslashes($_REQUEST['heading'])."', '".addslashes($_REQUEST['subtext'])."', '".addslashes(nl2br($_REQUEST['content']))."', '', now(), 'Y')");
        header("location:create-post?update=done"); exit;
	}
}

if(isset($_REQUEST['submit']) && $_REQUEST['heading'] != '' && $_REQUEST['edit'] != '')
{
	$random = rand(111111,999999);
	$target_path = "../upload/blogs/".$random;	
	$target_path = $target_path . basename($_FILES['thumb']['name']);
	$FileName = $random.$_FILES['thumb']['name'];
	
	if(move_uploaded_file($_FILES['thumb']['tmp_name'], $target_path))
	{
		mysqli_query($CONN,"UPDATE `blogs` SET `heading` = '".addslashes($_REQUEST['heading'])."', `subtext` = '".addslashes($_REQUEST['subtext'])."', `content` = '".addslashes(nl2br($_REQUEST['content']))."', `thumb` = '".$FileName."' WHERE `id` = '".$_REQUEST['edit']."'");
		header("location:create-post?update=done&edit=".$_REQUEST['edit'].""); exit;
	}
	else
	{
		mysqli_query($CONN,"UPDATE `blogs` SET `heading` = '".addslashes($_REQUEST['heading'])."', `subtext` = '".addslashes($_REQUEST['subtext'])."', `content` = '".addslashes(nl2br($_REQUEST['content']))."' WHERE `id` = '".$_REQUEST['edit']."'");
		header("location:create-post?update=done&edit=".$_REQUEST['edit'].""); exit;
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
  height : "480"
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
                <i class="fa fa-info pr10"></i> Congrats! Blog Created successfully!</div>
		<?php } ?>

        <?php if($_REQUEST['update'] == 'done') { ?>
        <div class="alert alert-success dark alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-info pr10"></i> Congrats! Blog informations updated successfully!</div>
		<?php } ?>
        
        <!-- -------------- Content -------------- -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">
            <?php $getGroup = mysqli_fetch_array(mysqli_query($CONN,"SELECT * FROM `blogs` WHERE `id` = '".$_REQUEST['edit']."'")); ?>
        	<section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <div class="mw1000 center-block">

					<!-- -------------- Change Password -------------- -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title"><?php if($_REQUEST['edit']!='') { ?>Update<?php } else { ?>Add<?php } ?> Blog</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">

                            <div class="section row mb25">
                                <label for="refund-policy" class="field-label col-sm-2 ph10">Post Title</label>
                                <div class="col-sm-10 ph10">
                                    <input type="text" name="heading" class="gui-input" value="<?php echo $getGroup['heading']; ?>">
                                </div>
                            </div>
                            
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Sub Heading</label>
                            <div class="col-sm-10 ph10">
                                    <input type="text" name="subtext" class="gui-input" value="<?php echo $getGroup['subtext']; ?>">
                                </div>
                            </div>
                            
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10">Content</label>
                            <div class="col-sm-10 ph10">
                                    <textarea class="gui-input" name="content"><?php echo $getGroup['content']; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="section row mb25">
								<label for="refund-policy" class="field-label col-sm-2 ph10">Image/Thumb</label>
								<div class="col-sm-10 ph10">
									<input type="file" name="thumb" class="gui-input" accept="image/*" >
									<div class="photo" style="padding:8px 0;"><img src="../upload/blogs/<?php echo $getGroup['thumb']; ?>" width="100px" alt="" /></div>
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



<!--*********************************************** add now textbox*********************************************************-->
<script>
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields"); //Fields wrapper
        var wrapper_loop         = $(".input_fields_loop"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x =5; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            //alert("ok");
            e.preventDefault();
            var numItems = $('.group_section').length;
            var box_add = $('#guest_group_box_add').length+1;
            box_add++;
            numItems++;
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<table class="table"><tr><td>Question</td><td><input class="gui-input" type="text" name="question[]" style="width: 100%;"></td></tr><tr><td>Answer</td><td><textarea class="gui-textarea" name="answer[]"></textarea></td></tr><tr><td></td><td><button type="button" class="btn btn-block remove_field"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Remove</button></td></tr></table>'); //add input box
                tinymce.init({ selector:'textarea' });
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent().parent().parent().parent('table').remove(); x--;
        })
        $(wrapper_loop).on("click",".remove_field_loop", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent().parent().parent().parent('table').remove(); x--;
        })
    });
</script>
</body>

</html>
