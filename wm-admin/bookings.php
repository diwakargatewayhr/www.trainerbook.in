<?php include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
    header("location:login");
}
$transaction = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `transaction` WHERE `id` = '".@$_REQUEST['edit']."'"));

if(isset($_REQUEST['submit']) && $_REQUEST['provider'] != '' && $_REQUEST['edit'] != '')
{
	mysqli_query($CONN, "UPDATE `transaction` SET `provider` = '".$_REQUEST['provider']."' WHERE `id` = '".$_REQUEST['service']."'");
	$userRegister = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `id` = '".$_REQUEST['provider']."'"));

   
    $sender="ukgeni"; //ex:INVITE
    $mobile_number = $transaction['phone'];
    
    
   $message = "Hey! " . $userRegister['fullname'] . ' - ' . @$userRegister['phone'] . " has been assigned to your Car Washing booking. Scheduled Time: " . $transaction['booking_date'] . " " . $transaction['booking_time'] . " Please share code: " . $transaction['happy_code'] . " once you're happy with the service. - Godhulai Company";

    
    $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://wetroo.com/api/v1/?apirequest=send_whatsapp',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "instance_id": "659FD46464769",
            "receiver": ["'.$mobile_number.'"],
            "messages": "'.$message.'",
            "attachment": "",
            "schedule_time": ""
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'apikey: ac1ad983e08ad3304a97e147f522747e'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
	
	mysqli_query($CONN, "UPDATE `earnigs` SET `professional` = '".$_REQUEST['provider']."' WHERE `orderid` = '".$_REQUEST['service']."'");
	header("location:bookings"); exit;
}

if(isset($_REQUEST['DelId'])!='')
{
    mysqli_query($CONN, "DELETE FROM `transaction` WHERE `id` = '".$_REQUEST['DelId']."' ");
    header("location:bookings"); exit;
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

		<?php if(@$_REQUEST['edit'] != '') { ?>
		<!-- Content  -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">

            <div class="mw1000 center-block" id="hidden_div" <?php if($_REQUEST['edit']=='') { ?> style="display:none;" <?php } ?> >
                    <!-- Change Password -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title">Update Bookings</span>
                        </div>
						<?php if(@$_REQUEST['updated'] == 'yes') { ?>
							<div class="alert alert-success dark alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
								<i class="fa fa-info pr10"></i> Congrats! Bookings updated successfully!
							</div>
						<?php } ?>
                       
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">

                            <div class="section row mb25 col-md-12">
								<label for="refund-policy" class="field-label col-sm-2 ph10">Service Provider</label>

								<div class="col-sm-10 ph10">
                                    <label class="field select">
                                        <select id="provider" name="provider">
                                        	<option value="0">Select Provider...</option>
                                            <?php $getCategory1 = mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `type` = 'P' ORDER BY `id` ASC");
                	                              while($getNameCat1 = mysqli_fetch_array($getCategory1)) { ?>
                                                <option <?php if($transaction['provider'] == $getNameCat1['id']) { ?> selected <?php } ?> value="<?php echo $getNameCat1['id']; ?>"><?php echo $getNameCat1['fullname']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <i class="arrow double"></i>
                                    </label>
                                </div>
								<input type="hidden" name="service" value="<?=$_REQUEST['edit']?>" />
                            </div>
							
                            </div>
                        </div>
                    </div>

                    <input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if($_REQUEST['edit']!='') { ?>UPDATE<?php } else { ?>ADD<?php } ?> Booking">
                </div>

        </form>
        <!-- /Content  -->
		<?php } ?>
		
		
        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center">

                <!-- Products Status Table -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> All Bookings</span>
                            </div>
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr class="bg-light">
										   <th class="">Booking Date</th>
                                           <th class="">Booking</th>
                                           <th class="">Full Name</th>
                                           <th class="">Phone</th>
                                           <th class="">Services</th>
                                           <th class="">Booking Date/Time</th>
										   <!--<th class="">Service Fee</th>-->
										   <th class="">Provider</th>
										   <th class="">Mode</th>
										   <th class="">Payment</th>
                                           <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                        $sl = 0;
                                        $result2 = mysqli_query($CONN,"SELECT * FROM `transaction` ORDER BY `id` DESC");
                                        while($getValue = mysqli_fetch_array($result2)) { $provider = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `id` = '".$getValue['provider']."'"));
                                        $sl++; 
                                    ?>
                                        <tr>
                                            <td class="" style="text-align:left;"><?php $newtimestamp = strtotime('+330 minutes', strtotime($getValue['datetime'])); echo date('Y-m-d H:i:s', $newtimestamp); ?></td>
                                            <td><?php echo $getValue['transactionId']; ?></td>
                                            <td class="" style="text-align:left;"><?php echo $getValue['name']; ?><?php if($getValue['order_cancel'] == 'Y') { ?><span style="color:red;"></br>Cancellation Requested</span><?php } ?></td>
											<td class="" style="text-align:left;"><?php echo $getValue['phone']; ?></td>
                                            <td class="" style="text-align:left;">
                                                <?php
                                                $services = mysqli_query($CONN, "SELECT * FROM `mycart` WHERE `transaction` = '".$getValue['transactionId']."'");
                                                while ($servicesArr = mysqli_fetch_array($services)) {
                                                    $products = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `products` WHERE `proid` = '".$servicesArr['service']."'"));
                                                ?>
                                                    <b><?= htmlspecialchars(@$products['product_name']) ?></b> - ₹<?= htmlspecialchars(@$servicesArr['price']) ?><br>
                                                <?php } ?>
                                            </td>

                                            <td><?=$getValue['booking_date']?> / <?=$getValue['booking_time']?></td>
                                            <!--<td class="" style="text-align:left;">₹<?php echo @$getValue['price']+49; ?></td>-->
											<td class="" style="text-align:left;"><?php if(@$getValue['provider'] == '0') { ?>Partner not assigned.<?php } else { echo '<b>'.@$provider['fullname'].'</b>'.' - '.@$provider['phone']; } ?></td>
											<td class="" style="text-align:left;"><?php if($getValue['type'] == 'Offline') { echo '<span style="color:red;">Cash</span>'; } ?><?php if($getValue['type'] == 'Online') { echo '<span style="color:orange;">PhonePe</span>'; } ?></td>
											<td class="" style="text-align:left;"><?php if($getValue['paid'] == 'N') { echo '<span style="color:red;">Unpaid</span>'; } ?><?php if($getValue['paid'] == 'Y') { echo '<span style="color:green;">Paid</span>'; } ?></td>
											<td class="text-right">
                                                <div class="btn-group text-right">
                                                    <button type="button"
                                                            class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="bookings?edit=<?php echo $getValue['id'];?>"><i class="fa fa-plus-square" aria-hidden="true"></i> Provider</a></li>
                                                        <li><a href="view-order?edit=<?php echo $getValue['id'];?>"><i class="fa fa-plus-square" aria-hidden="true"></i> View Services</a></li>
                                                        <li><a href="bookings?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        "lengthMenu": [ 10, 25, 50, 75, 100 ],
        "pageLength": 25,
        buttons: [
            'csv', 'excel', 'print'
        ]
    } );
} );
</script>

</body>
</html>
