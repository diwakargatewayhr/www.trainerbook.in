<?php
include("../includes/config.php");

if(isset($_REQUEST['submit']))
{
	$sql = mysqli_query($CONN, "SELECT * FROM `admin_login` WHERE `username` = '".$_REQUEST['login']."' AND `password` = '".md5($_REQUEST['password'])."' AND `status` = 'Y'");
	$get = mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql) > 0)
	{
		$_SESSION['AdminID'] = $get['id'];
		$_SESSION['domain'] = $_REQUEST['domain'];
		$_SESSION['username'] = $get['username'];
		$_SESSION['modaratorid'] = $get['modaratorid'];
		
        mysqli_query($CONN, "INSERT INTO `admin_lastlogin` (`id`, `adminid`, `timestamp`, `again`, `IP`, `browser`, `OS`, `date`,  `status`) VALUES ('', '".$_SESSION['AdminID']."', '".date("d M, Y G:i A")."', 'Yes', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."', 'Direct access', '".date("d F, Y")."', 'Y')");
		header("location:index");
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- -------------- Meta and Title -------------- -->

<title><?php echo $adminTitle; ?> - Admin Control Panel</title>
<meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme"/>
<meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
<meta name="author" content="WebMantra Technologies">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- -------------- Fonts -------------- -->
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>

<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

<!-- -------------- CSS - theme -------------- -->

<link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">

<!-- -------------- CSS - allcp forms -------------- -->

<link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.css">

<!-- -------------- Favicon -------------- -->

<link rel="shortcut icon" href="<?php echo '../upload/logo/'.$portalSetting['favicon']; ?>">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<!-- -------------- IE8 HTML5 support  -------------- -->

<!--[if lt IE 9]>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->



<script language="Javascript">
function validateForm() {
    var x = document.forms["myForm"]["login"].value;
    if (x == null || x == "") {
        alert("Alert: Please enter username");
        document.myForm.login.focus() ;
        return false;
    }

    var y = document.forms["myForm"]["password"].value;
    if (y == null || y == "") {
        alert("Alert: Please enter password");
        document.myForm.password.focus() ;
        return false;
    }
}
</script>

</head>

<body class="utility-page sb-l-c sb-r-c" style="background:#fff;">



<div class="admin_login_field_area">

<div class="left_admin_login_field_area">
<div class="left_admin_login_field_areainner">
	<a href="#" class="text-center admin_logo">
		<img src="https://kidzz.in/projects/trainerbook/wm-admin/assets/logo_admin.png" alt="" border="0" class="img_fluid" />
	</a>	
<h3>Discover Amazing Trainerbook<br>with great Learning Solution</h3>
</div>
<div class="left_admin_login_field_img" style="background-image:url(assets/img/login-visual-2.png);">

</div>
</div>

<div class="right_admin_login_field_area">
<div class="right_admin_login_field_areainner">
	<div class="login_field_form_area">	
	<div class="login_field_form_header_area">
		<div class="mobile_admin_logo">
		<a href="#" class="text-center">
		<img src="../assets/images/logo.png" alt="" border="0" class="img_fluid" style="" />
		</a>
		</div>
		<h3 class="ttl">Welcome to Trainerbook</h3>
		<!--<span class="text-muted font-weight-bold font-size-h4">New Here? 
		<a href="#" class="text-primary font-weight-bolder">Create an Account</a></span>-->
	</div>
	<form name="myForm" action="login" method="post" onSubmit="return validateForm()">
			<div class="panel-body222">
			<div class="form-group">

			 <label class="d-block">Username</label>
			 <input type="text" name="login" id="username" class="form-control" placeholder="Username">

					</div> 
					<div class="form-group">
							<label class="d-block">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password">

					</div>

			  <div class="form-group">
					<div class="radio-custom radio-primary">
						<input type="radio" id="remember" name="remember">
						<label for="remember">Remember me</label>
					</div>
						<input type="submit" name="submit" class="btn btn-bordered btn_primary22" value="LOGIN" onClick="IsEmpty();">
			  </div>
				   
			  </div>                   		

			</form>
			</div>
</div>
</div>


</div>






<!--

<div id="main" class="animated fadeIn">   
    <section id="content_wrapper"> 
        <section id="content">			
		<div class="ligin_form_area" id="login">                
				<div class="bg-soft-primary">
				<div class="row">
				  <div class="col-md-7 col-sm-7">
					<div class="text-primary text_primary22">
					  <h5 class="text-primary">Welcome Back !</h5>
					  <p>Sign in to <?=$adminTitle?></p>
					</div>
				  </div>
				  <div class="col-md-5 col-sm-5 align-self-end"><img src="assets/img/profile-img.ba4e037e.png" alt="" class="img-responsive"></div>
				</div>
			  </div>
			  <div class="ligin_form_areainner">
			  <div class="bg_soft_img_area">
				<div class="bg_soft_img_areainner">
					<span><img src="assets/img/logo.4dbbacd2.svg"></span>
				</div>
			  </div>
			  <div class="login_logo"><img src="../images/logo.png" alt="" border="0" style="width:240px;" /></div>
			  
                <div class="panel222">				
				<form name="myForm" action="login" method="post" onSubmit="return validateForm()">
                <div class="panel-body222">
				<div class="form-group">

					 <label class="d-block">Username</label>
                     <input type="text" name="login" id="username" class="form-control" placeholder="Username">

                            </div> 
                            <div class="form-group">
									<label class="d-block">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">

                            </div>

                      <div class="form-group">
                            <div class="radio-custom radio-primary">
                                <input type="radio" id="remember" name="remember">
                                <label for="remember">Remember me</label>
                            </div>
                                <input type="submit" name="submit" class="btn btn-bordered btn_primary22" value="LOGIN" onClick="IsEmpty();">
                      </div>
                           
                      </div>                   		

				    </form>                 

                </div>               
				
				</div>

            </div>		

			<div class="login_bottom_text_area">
				<p>&copy; 2020 <?=$adminTitle?>. <a href="#">Made with <span style="color: #e74c3c">&hearts;</span> in India</a></p>
			</div>  

        </section>

    </section>
</div>-->

<!-- -------------- /Body Wrap  -------------- -->

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->

<script src="assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>
<!-- -------------- CanvasBG JS -------------- -->
<script src="assets/js/plugins/canvasbg/canvasbg.js"></script>
<!-- -------------- Theme Scripts -------------- -->
<script src="assets/js/utility/utility.js"></script>
<script src="assets/js/demo/demo.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>