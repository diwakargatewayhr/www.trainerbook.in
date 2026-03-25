<?php
include("../includes/config.php");

if ($_SESSION['AdminID'] < 1) {
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- -------------- Meta and Title -------------- -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--  Meta and Title  -->

<title><?php echo $adminTitle; ?> - Admin Control Panel</title>
<meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme"/>
<meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
<meta name="author" content="WebMantra Technologies">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--  Fonts  -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
	  type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
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

    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <script type="text/javascript">
        function showHide(obj) {
            var div = document.getElementById(obj);
            if (div.style.display == 'none') {
                div.style.display = '';
            } else {
                div.style.display = 'none';
            }
        }
    </script>
    
    <style>
        .text-short {
            font-size: 15px;
        }
        .brfore-after-img {
            width: 300px;
            height: 260px;
            border: 1px solid #da1abb;
            border-radius: 6px;
            margin-right: 15px;
            padding: 10px;
        }
        .brfore-after-img:last-child {
            margin: 0;
        }
        
        .after-before-img-box {
                width: 100%;
                height: 100%;
        }
        
        .images-row {
            display: flex;
            justify-content: space-between;
        }
        
          .zoomed-image {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 50%;
            height: 50%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .zoomed-image img {
            max-width: 80%;
            max-height: 80%;
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


            <!-- -------------- Content -------------- -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- -------------- Column Center -------------- -->
                <div class="chute chute-center">

                    <!-- -------------- Products Status Table -------------- -->
                    <div class="row">
  
  <?php   $transaction = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `transaction` WHERE `id` = '".$_REQUEST['edit']."'")); 
  
  $provider = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `id` = '".$transaction['provider']."'"));
  ?>

                        <div class="col-md-12 col-sm-12 col-xs-12 padding999">
                            <div class="panel panel_margin_btm">
                                <div class="panel-body pn" style="margin-top:0px;">
                                    <div class="panel_heading33">
                                        <h3 class="text-short">Order ID : <?= @$transaction['id'] ?></h3>
                                        <p>Payment via <b><?= $transaction['type']; ?></b> <!--Customer IP: 103.215.224.249--></p>
                                    </div>
                                    <div class="panel_bodyinner">
                                        <div class="row">
                                            
                                            
                                            <div class="col-md-4 col-sm-4 col-xs-12 padding999">
                                                <div class="genaral_dtls_area">
                                                    <h4>General</h4>
                                                    <div class="allcp-form theme-primary">
                                                        <div class="form-group">
                                                            <label>Order Created:</label></br>
                                                            <!--<input type="text" placeholder="dd-mm-yy" class="gui-input form-control" value="<?= $getOrders['date'] ?>">-->
                                                            <?=$transaction['booking_date']?>
                                                            
                                                           
                                                           
                                                        </div>
                                                        <div class="form-group">
                                                           
                                                            
                                                            <label>Service Name:</label></br>
                                                            
                                                            <?php
                                                                $services = mysqli_query($CONN, "SELECT SUM(price) AS Price, service FROM `mycart` WHERE `transaction` = '".$transaction['transactionId']."'");
                                                                $booking = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `transaction` WHERE `transactionId` = '".$transaction['transactionId']."'"));
                                                                while ($servicesArr = mysqli_fetch_array($services)) {
                                                                    $products = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `products` WHERE `proid` = '".$servicesArr['service']."'"));
                                                                ?>
                                                                      <b><?= htmlspecialchars(@$products['product_name']) ?></b> - ₹<?= htmlspecialchars(@$servicesArr['Price']) ?><br>
                                                                    <?php
                                                                    if($booking['adv_pay'] != '' && $booking['paid'] == 'N' ){
                                                                        ?>
                                                                      
                                                                        <b>Advence Pay</b> - ₹<?= @$booking['adv_pay']  ?><br>
                                                                        <b>Remaining Pay</b> - ₹<?= @$servicesArr['Price'] -@$booking['adv_pay']  ?><br>
                                                                        <b>Payment via- </b><?= $transaction['remaining_type']; ?>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                <?php } ?>
                                                
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Status:</label>
                                                            <div class="select">
                                                                <select class="gui-input form-control" onChange=" this.options[this.selectedIndex].value && (window.location.href = this.options[this.selectedIndex].value);">
                                                                    <option value=""><?=$transaction['status']?></option>
                                                                    
                                                                </select>

                                                                <i class="arrow double"></i>
                                                            </div>
                                                        </div>
       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 padding999">
                                                <div class="billing_dtls-area">
                                                    <h4>Billing <!--<a href="#" class="edit_address"><i class="fa fa-pencil" aria-hidden="true"></i></a>--></h4>
                                                    <div class="oreder_dtl_areablkinner">
                                                        <div class="oreder_dtl_areablk_content full_width_block">
                                                            <h3 class="text-short">Customer Details</h3>
                                                            <p><?=@$transaction['name']?></p>
                                                            <p></p>
                                                        </div>
                                                        <div class="oreder_dtl_areablk_content full_width_block">
                                                            <h3 class="text-short">Phone No</h3>
                                                            <p><?=@$transaction['phone']?></p>
                                                        </div>
                                                        <div class="oreder_dtl_areablk_content full_width_block">
                                                            <h3 class="text-short">Address</h3>
                                                            <p><?=@$transaction['address']?></p>
                                                        </div>
                                                        
                                                        <div class="oreder_dtl_areablk_content full_width_block">
                                                            <h3 class="text-short">Slot Time</h3>
                                                            <p> <?=$transaction['booking_date']?> /  <?=$transaction['booking_time']?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 padding999">
                                                <div class="shipping_dtls_area">
                                                    <h4>Assigned Partner <!--<a href="#" class="edit_address"><i class="fa fa-pencil" aria-hidden="true"></i></a>--></h4>
                                                    <div class="oreder_dtl_areablk_content full_width_block">
                                                       
                                                        <p> <?=@$provider['fullname']?></p>
                                                        <h3 class="text-short">Phone</h3>
                                                        <p><?=@$provider['phone']?></p>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>



                                <?php
                                
                                if($_REQUEST['edit'] != '' ){
                                $transaction = mysqli_query($CONN, "SELECT * FROM `transaction` WHERE `id` = '".$_REQUEST['edit']."'");
                                if(mysqli_num_rows($transaction) > 0) {
                                    while($transactionArr = mysqli_fetch_array($transaction)) {
                                        $before_work_images = $transactionArr['before_work_pic']; 
                                        $before_work_images_arr = explode(',', $before_work_images);
                                        
                                        $after_work_pic = $transactionArr['after_work_pic']; 
                                        $after_work_pic_arr = explode(',', $after_work_pic);
                                ?>
                                        <div class="panel panel_margin_btm">
                                            <div class="panel-before-after-box">
                                                <h4>Before work</h4>
                                                <div class="images-row">
                                                <?php 
                                                foreach($before_work_images_arr as $before_image) {  
                                                ?>
                                                    <div class="brfore-after-img">
                                                        <img src="../upload/works/<?= $before_image ?>" class="after-before-img-box" onclick="zoomImage(this)">

                                                    </div>
                                                <?php 
                                                } 
                                               
                                                ?>
                                                 </div>
                                            </div>
                                            <div class="panel-before-after-box">
                                    <h4>After work</h4>
                                    <div class="images-row">
                                         <?php 
                                                foreach($after_work_pic_arr as $after_image) {  
                                                ?>
                                    <div class="brfore-after-img">
                                        <img src="../upload/works/<?= $after_image ?>" class="after-before-img-box" >
                                    </div>
                                    <?php 
                                                } 
                                               
                                                ?>
                                    </div>
                                </div>
                                        </div>
                                <?php 
                                    } } 
                                } 
                                ?>
                            </div>
                          
<!--<div class="zoomed-image" id="zoomed-image-container" onclick="closeZoomedInImage()">-->
<!--    <img id="zoomed-image">-->
<!--</div>-->
                        </div>

                        <div class="col-md-4 col-sm-5 col-xs-12 padding999">
                            <div class="panel panel_margin_btm" style="display:none;">
                                <div class="panel-heading">
                                    <span class="panel-title">Order Action</span>
                                </div>
                                <div class="panel-body pn hd_blk">
                                    <div class="oreder_dtl_areablkinner allcp-form theme-primary">
                                        <div class="oreder_dtl_areablk_content full_width_block order_action_block">
                                            <div class="select">
                                                <select name="" class="gui-input form-control">
                                                    <option value="">Choose an action...</option>
                                                    <option value="send_order_details">Email invoice / order details to customer</option>
                                                    <option value="send_order_details_admin">Resend new order notification</option>
                                                    <option value="regenerate_download_permissions">Regenerate download permissions</option>
                                                </select>
                                                <i class="arrow double"></i>
                                            </div>
                                            <button><i class="fa fa-chevron-right" aria-hidden="true">gfgfdg</i></button>
                                        </div>

                                    </div>
                                    <div class="wide">
                                        <a class="submitdelete deletion" href="#">Move to Trash</a>
                                        <button type="submit" class="button save_order button-primary" name="" value="">Update</button>
                                    </div>
                                </div>

                            </div>

                            <div class="panel panel_margin_btm" style="display:none;">
                                <div class="panel-heading">
                                    <span class="panel-title">Send order email</span>
                                </div>
                                <div class="panel-body pn hd_blk">
                                    <div class="oreder_dtl_areablkinner allcp-form theme-primary">
                                        <div class="oreder_dtl_areablk_content full_width_block order_action_block">
                                            <div class="select">
                                                <select name="" class="gui-input form-control">
                                                    <option value="">Choose an action...</option>
                                                    <option value="send_order_details">Email invoice / order details to customer</option>
                                                    <option value="send_order_details_admin">Resend new order notification</option>
                                                    <option value="regenerate_download_permissions">Regenerate download permissions</option>
                                                </select>
                                                <i class="arrow double"></i>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="wide">
                                        <button type="submit" class="button save_order button-primary" name="" value="">Save order & send email</button>
                                    </div>
                                </div>

                            </div>



                            <!--<div class="panel panel_margin_btm">-->
                            <!--    <div class="panel-heading">-->
                            <!--        <span class="panel-title">Create PDF</span>-->
                            <!--    </div>-->
                            <!--    <div class="panel-body pn hd_blk">-->
                            <!--        <div class="create_pdf_block">-->
                            <!--            <?php if (@$getOrders['status'] != 'N') { ?>-->
                            <!--                <a href="invoice/invoice.php?order=<?= $orderDetails['transaction'] ?>" class="btn create_pdf_block_button" target="_blank">PDF Invoice</a><?php } ?>-->
                                     
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->


                            <!--<div class="panel panel_margin_btm">
                            <div class="panel-heading">
                                <span class="panel-title">Edit Orders</span>
                            </div>
                            <div class="panel-body pn">
							</div>	
					 
						</div>	-->


                        </div>



                    </div>
                    <!--<div><?= $pagination ?></div>-->
                </div>
                <!-- -------------- /Column Center -------------- -->

            </section>
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
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: 34%">
                            <span class="fs11">New visitors</span>
                        </div>
                    </div>
                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%">
                            <span class="fs11 text-left">Returnig visitors</span>
                        </div>
                    </div>
                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
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
                                <i class="fa fa-caret-down"></i> 15.7%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt25 mb10">Returnig visitors</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">660</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-success-dark mn">
                                <i class="fa fa-caret-up"></i> 20.2%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt25 mb10">Orders</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">153</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-success mn">
                                <i class="fa fa-caret-up"></i> 5.3%
                            </h3>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>
<!-- Page JS -->
<script src="assets/js/demo/charts/highcharts.js"></script>

<!-- -------------- Page JS -------------- -->
<script src="assets/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/datatable/js/dataTables.bootstrap.min.js"></script>

<!--<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>-->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();


        });
    </script>
    <!-- -------------- /Scripts -------------- -->
<script>
    function zoomImage(image) {
        // Display the zoomed-in image
        document.getElementById('zoomed-image').src = image.src;
        document.getElementById('zoomed-image-container').style.display = 'flex';
    }

    function closeZoomedInImage() {
        // Close the zoomed-in image when clicked
        document.getElementById('zoomed-image-container').style.display = 'none';
    }
</script>
</body>

</html>