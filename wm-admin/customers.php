<?php include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
    header("location:login");
}

if(isset($_REQUEST['submit']) && $_REQUEST['edit'] != '' && $_REQUEST['password'] == '')
{
    mysqli_query($CONN, "UPDATE `user_register` SET `fullname` = '".$_REQUEST['fullname']."', `phone` = '".$_REQUEST['phone']."', `email` = '".$_REQUEST['email']."', `apartment` = '".$_REQUEST['apartment']."', `address` = '".$_REQUEST['address']."', `landmark` = '".$_REQUEST['landmark']."', `pincode` = '".$_REQUEST['pincode']."', `wallet_balance` = '".$_REQUEST['wallet_balance']."', `status` = '".$_REQUEST['status']."' WHERE `id` = '".$_REQUEST['edit']."'");
    header("location:customers?data=updated"); exit;
}

if(isset($_REQUEST['submit']) && $_REQUEST['edit'] != '' && $_REQUEST['password'] != '')
{
    mysqli_query($CONN, "UPDATE `user_register` SET `fullname` = '".$_REQUEST['fullname']."', `phone` = '".$_REQUEST['phone']."', `email` = '".$_REQUEST['email']."', `password` = '".md5($_REQUEST['password'])."', `apartment` = '".$_REQUEST['apartment']."', `address` = '".$_REQUEST['address']."', `landmark` = '".$_REQUEST['landmark']."', `pincode` = '".$_REQUEST['pincode']."', `wallet_balance` = '".$_REQUEST['wallet_balance']."', `status` = '".$_REQUEST['status']."' WHERE `id` = '".$_REQUEST['edit']."'");
    header("location:customers?data=updated"); exit;
}

if(isset($_REQUEST['DelId'])!='')
{
    mysqli_query($CONN, "DELETE FROM `user_register` WHERE `id` = '".$_REQUEST['DelId']."' ");
    header("location:customers"); exit;
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

    <!-- -------------- Topbar -------------- -->
        <!--<header id="topbar" class="ph10">
            <div class="topbar-right hidden-xs hidden-sm mt5 mr35">
                <a href="#" class="btn btn-primary btn-sm ml10" title="New Order" onClick="showHide('hidden_div'); return false;">
                    <span class="fa fa-plus pr5"></span><span class="fa fa-file-o pr5"></span>Add Reseller/Mistri</a>
            </div>
        </header>-->
        <!-- -------------- /Topbar -------------- -->

        <?php if(@$_REQUEST['data'] == 'updated') { ?>
            <div class="alert alert-success dark alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <i class="fa fa-info pr10"></i> Congrats! Customers account updated successfully!
            </div>
		<?php } ?>

        <!-- -------------- Content -------------- -->
        <form action="" method="post" enctype="multipart/form-data" name="form1">

            <div class="mw1000 center-block" id="hidden_div" <?php if(@$_REQUEST['edit']=='') { ?> style="display:none;" <?php } ?>>
            <?php $getGroup = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `user_register` WHERE id = '".@$_REQUEST['edit']."'")); ?>
                    <!-- -------------- Change Password -------------- -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title">Update Customers</span>
                        </div>
                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
							
                            <div class="col-md-6">
                                <div class="section row mb25">
                                <label for="refund-policy" class="field-label col-sm-4 ph10">Full Name</label>
                                    <div class="col-sm-8 ph10">
                                        <input type="text" name="fullname" class="gui-input" value="<?php echo @$getGroup['fullname']; ?>">
                                    </div>
                            </div></div>
                            
                            <div class="col-md-6">
                                <div class="section row mb25">
                                <label for="refund-policy" class="field-label col-sm-4 ph10">Phone No.</label>
                                    <div class="col-sm-8 ph10">
                                        <input type="text" name="phone" class="gui-input" value="<?php echo @$getGroup['phone']; ?>" maxlength="10" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                    </div>
                            </div></div>
                            
                            <div class="col-md-6">
                                <div class="section row mb25">
                                <label for="refund-policy" class="field-label col-sm-4 ph10">Email</label>
                                    <div class="col-sm-8 ph10">
                                        <input type="text" name="email" class="gui-input" value="<?php echo @$getGroup['email']; ?>">
                                    </div>
                            </div></div>
							
                            <div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Apartment</label>
                                <div class="col-sm-8 ph10">
                                    <input type="text" name="apartment" class="gui-input" value="<?php echo @$getGroup['apartment']; ?>">
                                </div>
                            </div></div>
							
                            <div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Address</label>
                                <div class="col-sm-8 ph10">
                                    <input type="text" name="address" class="gui-input" value="<?php echo @$getGroup['address']; ?>">
                                </div>
                            </div></div>
							
                            <div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Landmark</label>
                                <div class="col-sm-8 ph10">
                                    <input type="text" name="landmark" class="gui-input" value="<?php echo @$getGroup['landmark']; ?>">
                                </div>
                            </div></div>
							
                            <div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Pincode</label>
                                <div class="col-sm-8 ph10">
                                    <input type="text" name="pincode" class="gui-input" value="<?php echo @$getGroup['pincode']; ?>">
                                </div>
                            </div></div>

							<div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Password</label>
                                <div class="col-sm-8 ph10">
                                    <input type="text" name="password" class="gui-input" value="">
                                </div>
                            </div></div>
                            
                            <div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Wallet Balance</label>
                                <div class="col-sm-8 ph10">
                                    <input type="text" name="wallet_balance" class="gui-input" value="<?=@$getGroup['wallet_balance']?>" style="border:#FF0000 1px solid;">
                                </div>
                            </div></div>
                            
                            <div class="col-md-6">
                            <div class="section row mb25">
                            <label for="refund-policy" class="field-label col-sm-4 ph10">Status</label>
                                <div class="col-sm-8 ph10" style="padding-top:14px;">
                                    <input type="radio" name="status" <?php if(@$getGroup['status'] == 'Y') { ?> checked <?php } ?> value="Y">&nbsp;&nbsp;&nbsp;Active&nbsp;&nbsp;&nbsp;<input type="radio" name="status" <?php if(@$getGroup['status'] == 'N') { ?> checked <?php } ?> value="N">&nbsp;&nbsp;&nbsp;Inactive
                                </div>
                            </div></div>
                            
                            </div>
                            <input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if(@$_REQUEST['edit']!='') { ?>UPDATE<?php } else { ?>ADD<?php } ?> Customer">
                        </div>                      
                    </div>                    
                </div>

        </form>
        <!-- -------------- /Content -------------- -->

        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center">

                <!-- Products Status Table -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> All Customers</span>
                            </div>
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr class="bg-light">
                                           <th class="">Sl. No.</th>
                                           <th class="">Full Name</th>
                                           <th class="">Phone No.</th>
                                           <th class="">Email</th>
                                           <th class="">Registered</th>
                                           <th class="">Wallet Balance</th>
										   <th class="">Status</th>
										   <th class="">Type</th>
                                           <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                        $sl = 0;
                                        $result2 = mysqli_query($CONN,"SELECT * FROM `user_register` WHERE `type` = 'U' ORDER BY `id` DESC");
                                        while($getValue = mysqli_fetch_array($result2)) { 
                                        $sl++;
                                    ?>
                                        <tr>
                                            <td><?php echo $sl; ?></td>
                                            <td class="" style="text-align:left;"><?php echo $getValue['fullname']; ?></td>
											<td class="" style="text-align:left;"><?php echo $getValue['phone']; ?></td>
                                            <td class="" style="text-align:left;"><?php echo $getValue['email']; ?></td>
                                            <td class="" style="text-align:left;"><?php echo $getValue['datetime']; ?></td>
                                            <td class="" style="text-align:left;">₹<?=$getValue['wallet_balance']?></td>
                                            <td style="text-align:left;"><?php if($getValue['status'] == 'Y') { ?><a href="customers?status=N&pid=<?=$getValue['id']?>"><span class="label label-success">Active</span></a><?php } ?><?php if($getValue['status'] == 'N') { ?><a href="customers?status=Y&pid=<?=$getValue['id']?>"><span class="label label-danger">Inactive</span></a><?php } ?></td>
                                            <td style="text-align:left;"><?php if($getValue['type'] == 'U') { ?><a href="customers?type=P&pid=<?=$getValue['id']?>"><span class="label label-primary">Customer</span></a><?php } ?><?php if($getValue['type'] == 'P') { ?><a href="customers?status=U&pid=<?=$getValue['id']?>"><span class="label label-warning">Professional</span></a><?php } ?></td>
											<td class="text-right">
                                                <div class="btn-group text-right">
                                                    <button type="button"
                                                            class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="customers?edit=<?php echo $getValue['id'];?>">Edit</a></li>
                                                        <li><a href="customers?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
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
