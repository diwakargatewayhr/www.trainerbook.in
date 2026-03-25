<?php
include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
	header("location:login");
}

if(isset($_REQUEST['submit']) && $_REQUEST['email'] != '')
{
    $string = $_REQUEST['email'];
    $string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
    $array = explode(', ', $string); //split string into array seperated by ', '

    foreach($array as $value) //loop over values
    {
        mysqli_query($CONN,"INSERT INTO `outbox` (`id`, `aid`, `email`, `subject`, `message`, `date`, `time`, `datetime`, `status`) VALUES ('', '".$_SESSION['AdminID']."', '".$value."', '".$_REQUEST['subject']."', '".mysqli_real_escape_string($_REQUEST['message'])."', '".date("d M, Y")."', '".date("G:i A")."', now(), 'N')");

        // multiple recipients
    	$to  = $value;

    	// subject
    	$subject = $_REQUEST['subject'];

    	// message
    	$message = $_REQUEST['message'];

    	// To send HTML mail, the Content-type header must be set
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    	// Additional headers
    	$headers .= 'To: <'.$_REQUEST['email'].'>' . "\r\n";
    	$headers .= 'From: Jobsire <support@jobsire.com>' . "\r\n";

    	// Mail it
    	mail($to, $subject, $message, $headers);
    }
	header("location:compose-mail.php?ret=1");
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
<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

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

		<?php if($_REQUEST['ret'] == '1') { ?>
            <div class="alert alert-success dark alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-info pr10"></i> Congrats! Your message has been sent.
            </div>
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
                            <span class="panel-title">Compose Mail</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">

                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10 text-center">Send To</label>
                                <div class="col-sm-10 ph10">
                                    <input type="text" name="email" class="gui-input" value="<?php echo $_REQUEST['email']; ?>" >
                                    <div style="font-size:11px;">Please split multiple emails by ', '</div>
                                </div>
                            </div>
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10 text-center">Subject</label>
                                <div class="col-sm-10 ph10">
                                    <input type="text" name="subject" class="gui-input" value="">
                                </div>
                            </div>
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10 text-center">Message</label>
                                <div class="col-sm-10 ph10">
                                    <label class="field prepend-icon">
                        			    <textarea class="gui-textarea" name="message"></textarea>
                                    </label>
                                </div>
                            </div>
							<!--<div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-2 ph10 text-center">Attachment</label>
                                <div class="col-sm-10 ph10">
                                    <input type="file" name="attachment" class="gui-input" value="">
                                </div>
                            </div>-->
                            </div>
                        </div>
                    </div>

					<input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value=" SEND MAIL ">
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
