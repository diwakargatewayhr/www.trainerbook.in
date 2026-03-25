<?php $permission = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `access_permissions` WHERE uid = '" . $_SESSION['AdminID'] . "'")); ?>
<?php $getSettings = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `website_settings` WHERE id = '" . $_SESSION['AdminID'] . "'")); ?>
<?php if (isset($_REQUEST['result'])) {
    header("location:campaign?search=" . $_REQUEST['keyword'] . "");
    exit();
} ?>
<!-- -------------- Header  -------------- -->
<header class="navbar navbar-fixed-top bg-dark">
    <div class="navbar-logo-wrapper">
        <!--<img src="https://shopsready.com/wm-admin/assets/img/shopsready_favicon.png" class="navbar_logo_img">-->
        <a class="navbar-logo-text" href="index">
            <b><?php echo $getSettings['name']; ?></b>
        </a>
        <!--<span id="sidebar_left_toggle" class="ad ad-lines"></span>-->
    </div>
    <ul class="nav navbar-nav navbar-left">
        <li class="">

            <span id="sidebar_left_toggle" class="ad ad-lines"></span>

            <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>

        </li>
        <li class="dropdown dropdown-fuse hidden-xs" style="display:none;">
            <a href="#" class="dropdown-toggle non-m-left" data-toggle="dropdown" role="button" aria-expanded="false">Site Tools
                <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="admin-logins">Admin Logins</a></li>
                <li><a href="compose-mail">Compose Mail</a></li>
                <!--<li><a href="subscribe">Subscribe Mails</a></li>-->
                <li><a href="visitor-history">Visitor History</a></li>
                <li><a href="settings">Settings</a></li>
                <li><a href="gateways">Payment Getaway</a></li>
                <li><a href="change-password">Change Password</a></li>
                <!--<li class="divider"></li>
                    <li><a href="export-orders">Export Orders (.xls)</a></li>
                    <li><a href="export-products">Export Products (.xls)</a></li>
                    <li><a href="export-customer">Export Customers (.xls)</a></li>
                    <li><a href="export-jobs">Export Jobs (.xls)</a></li>-->
                <li class="divider"></li>
                <li><a href="shutdown">Maintainance Mode</a></li>
            </ul>
        </li>
        <li class="hidden-xs">
            <a class="navbar-fullscreen toggle-active" href="#">
                <span class="glyphicon glyphicon-fullscreen"></span>
            </a>
        </li>
    </ul>

    <form class="navbar-form navbar-left search-form square" role="search" action="">
        <!--<div class="input-group add-on">
                <input type="text" class="form-control" name="keyword" placeholder="Search Campaigns..." onFocus="this.placeholder=''"
                       onblur="this.placeholder='Search Campaigns...'" value="<?php echo $_REQUEST['result']; ?>">
                <div class="input-group-btn">
                    <button class="btn btn-default" name="result" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
			<div class="position-relative">
			<input type="text" placeholder="Search..." class="form-control">
			<span class="glyphicon glyphicon-search"></span>
			</div>-->
    </form>


    <?php if (@$permission['search_candidates'] == 'Y') { ?>
        <form class="navbar-form navbar-left search-form square" role="search" action="">
            <!--<div class="input-group add-on">
                <input type="text" class="form-control" name="keyword" placeholder="Search Campaigns..." onFocus="this.placeholder=''"
                       onblur="this.placeholder='Search Campaigns...'" value="<?php echo $_REQUEST['result']; ?>">
                <div class="input-group-btn">
                    <button class="btn btn-default" name="result" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
			<div class="position-relative">
			<input type="text" placeholder="Search..." class="form-control">
			<span class="glyphicon glyphicon-search"></span>
			</div>-->
        </form>
    <?php } ?>

    <ul class="nav navbar-nav navbar-right">
        <!--<li class="hidden-xs">
                <div class="navbar-btn btn-group">
                    <a href="#" class="topbar-dropmenu-toggle btn" data-toggle="button">
                        <span class="fa fa-magic fs20 text-info"></span>
                    </a>
                </div>
            </li>-->
        <li class="dropdown dropdown-fuse" style="display:none;">
            <div class="navbar-btn btn-group">
                <button data-toggle="dropdown" class="btn dropdown-toggle" onclick="window.location='support-desk'">
                    <!--<span class="fa fa-envelope fs20 text-danger"></span>
						<span class="fa fa-envelope-o fs20"></span>-->
                    <!--<span class="badge badge-danger badge-pill">3</span>-->
                </button>
                <!--<button data-toggle="dropdown" class="btn dropdown-toggle fs18 visible-xl">
                        3
                    </button>-->
            </div>
        </li>
        <li class="dropdown dropdown-fuse" style="display:none;">
            <div class="navbar-btn btn-group">
                <button data-toggle="dropdown" class="btn dropdown-toggle" onclick="window.location='transaction'">
                    <!--<span class="fa fa-bell fs20 text-primary"></span>
						<span class="fa fa-bell-o fs20"></span>-->
                    <!--<span class="badge badge-danger badge-pill">8</span>-->
                </button>
                <!--<button data-toggle="dropdown" class="btn dropdown-toggle fs18 visible-xl">
                        8
                    </button>-->
            </div>
        </li>
        <li class="dropdown dropdown-fuse">
            <div class="navbar-btn btn-group" style="padding-top:8px;">
                Version <b>2.0</b>
            </div>
        </li>
        <li class="dropdown dropdown-fuse ">
            <a href="#" class="dropdown-toggle fw600 non-m-left" data-toggle="dropdown" aria-expanded="true">
                <?php if ($_SESSION['AdminID'] == '1') { ?>
                    <img src="../upload/logo/<?php echo $getSettings['logo']; ?>" alt="avatar" class="mw55 rounded-circle header-profile-user">
                <?php } else { ?>
                    <img src="assets/img/moderator.jpg" alt="avatar" class="mw55 rounded-circle header-profile-user">
                <?php } ?>

                <span class="hidden-xs">
                    <name>Hi, <?php echo $getSettings['name']; ?></name>
                </span>
                <!--<span class="fa fa-caret-down hidden-xs mr15"></span>-->
                <span class="fa fa-caret-down hidden-xs"></span>

            </a>
            <!--<ul class="dropdown-menu list-group keep-dropdown w250" role="menu">-->
            <ul class="dropdown-menu list-group keep-dropdown w200" role="menu">
                <li class="list-group-item" style="display:none;">
                    <a href="support-desk" class="animated animated-short fadeInUp">
                        <span class="fa fa-envelope-o"></span> Support Desk
                        <span class="label label-warning">60</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="settings" class="animated animated-short fadeInUp">
                        <span class="fa fa-users"></span> General Settings
                        <span class="label label-warning"></span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="change-password" class="animated animated-short fadeInUp">
                        <span class="fa fa-cogs"></span> Change Password </a>
                </li>
                <li class="list-group-item" style="display:none;">
                    <a href="gateways" class="animated animated-short fadeInUp">
                        <span class="fa fa-credit-card"></span> Payment Getaway </a>
                </li>
                <li class="dropdown-footer text-center">
                    <a href="logout" class="btn btn-primary btn-sm btn-bordered">
                        <span class="fa fa-power-off pr5"></span> Logout </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--<ul class="nav navbar-nav navbar-right">
            <li class="hidden-xs">
                <div class="navbar-btn btn-group">
                    <a href="#" class="topbar-dropmenu-toggle btn" data-toggle="button">
                        <span class="fa fa-magic fs20 text-info"></span>
                    </a>
                </div>
            </li>
            <li class="dropdown dropdown-fuse">
                <?php if ($permission['sales_enquiry'] == 'Y') { ?>
                <div class="navbar-btn btn-group">
                    <button data-toggle="dropdown" class="btn dropdown-toggle" onclick="window.location='salesQuery'">
                        <span class="fa fa-envelope fs20 text-danger"></span>
                    </button>
                    <button data-toggle="dropdown" class="btn dropdown-toggle fs18 visible-xl">
                        3
                    </button>
                </div>
                <?php } ?>
            </li>
            <li class="dropdown dropdown-fuse">
                <div class="navbar-btn btn-group">
                    <button data-toggle="dropdown" class="btn dropdown-toggle" onclick="return confirm('Ohhh! No Notification Found.')">
                        <span class="fa fa-bell fs20 text-primary"></span>
                    </button>
                    <button data-toggle="dropdown" class="btn dropdown-toggle fs18 visible-xl">
                        8
                    </button>
                </div>
            </li>
            <li class="dropdown dropdown-fuse">
                <div class="navbar-btn btn-group">
                    <button data-toggle="dropdown" class="btn btn-md dropdown-toggle">
                        V2.0
                    </button>
                </div>
            </li>
            <li class="dropdown dropdown-fuse">
                <a href="#" class="dropdown-toggle fw600" data-toggle="dropdown">
                    <span class="hidden-xs"><name>Hi, <?php $labname = explode(' ', $getlogin['fullname']);
                                                        echo $labname[0]; ?></name></span>
                    <span class="fa fa-caret-down hidden-xs mr15"></span>
                    <?php if ($_SESSION['AdminID'] == '1') { ?>
                        <img src="../upload/logo/<?php echo $portalSetting['profile']; ?>" alt="avatar" class="mw55" />
                    <?php } else { ?>
                        <img src="assets/img/moderator.jpg" border="0" alt="avatar" class="mw55" />
                    <?php } ?>
                </a>
                <ul class="dropdown-menu list-group keep-dropdown w250" role="menu">
                    <li class="list-group-item">
                        <a href="settings" class="animated animated-short fadeInUp">
                            <span class="fa fa-cogs"></span> Profile Settings
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="change-password" class="animated animated-short fadeInUp">
                            <span class="fa fa-unlock-alt"></span> Change Password
                        </a>
                    </li>
                    <?php /* if($permission['sales_enquiry'] == 'Y') { ?>
                    <li class="list-group-item">
                        <a href="subscriptions" class="animated animated-short fadeInUp">
                            <span class="fa fa-users"></span> Subscription
                            <span class="label label-warning"><?php echo mysqli_num_rows(mysqli_query($CONN,"SELECT * FROM `contact_sales` WHERE status = 'N'")); ?></span>
                        </a>
                    </li><?php } */ ?>
                    <?php /*if($permission['admin_settings'] == 'Y') { ?>
                    <li class="list-group-item">
                        <a href="settings" class="animated animated-short fadeInUp">
                            <span class="fa fa-cogs"></span> Settings </a>
                    </li><?php } ?>
                    <?php if($permission['payment_getaway'] == 'Y') { ?>
                    <li class="list-group-item">
                        <a href="gateways" class="animated animated-short fadeInUp">
                            <span class="fa fa-credit-card"></span> Payment Getaway </a>
                    </li>
                    <?php }*/ ?>
                    <li class="dropdown-footer text-center">
                        <a href="logout" class="btn btn-primary btn-sm btn-bordered">
                            <span class="fa fa-power-off pr5"></span> Logout </a>
                    </li>
                </ul>
            </li>
        </ul>-->
</header>
<!-- -------------- /Header  -------------- -->