<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- -------------- Sidebar  -------------- -->
<aside id="sidebar_left" class="nano nano-light affix">

    <!-- -------------- Sidebar Left Wrapper  -------------- -->
    <div class="sidebar-left-content nano-content">

        <!-- -------------- Sidebar Header -------------- -->
        <header class="sidebar-header">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

            <!-- -------------- Sidebar - Author -------------- -->
            <div class="sidebar-widget author-widget author_widget22" style="display:none;">
                <div class="media">
                    <a class="media-left" href="#">
                        <?php if ($_SESSION['AdminID'] == '1') { ?>
                            <img src="../upload/logo/<?php echo $getSettings['logo']; ?>" alt="" border="0" class="img-responsive" />
                        <?php } else { ?>
                            <img src="assets/img/moderator.jpg" alt="" border="0" class="img-responsive" />
                        <?php } ?>
                        <!--<img src="assets/img/avatars/profile_avatar.jpg" class="img-responsive">-->
                    </a>

                    <div class="media-body media_body22">
                        <div class="media-links">
                            <!--<a href="#" class="sidebar-menu-toggle">User Menu -</a> <a href="logout">Logout</a>-->
                        </div>
                        <div class="user_dtl">
                            <p class="user_name">Hello, <span><?php echo $getSettings['name']; ?></span></p>
                            <p class="user_email"></p>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <!-- -------------- /Sidebar Header -------------- -->

        <!-- -------------- Sidebar Menu  -------------- -->
        <ul class="nav sidebar-menu">
            <!--<li class="sidebar-label pt30">Menu</li>-->
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'index') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa fa-dashboard"></span>
                    <span class="sidebar-title">Dashboard</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="index"><span class="fa fa-file-text-o"></span>Statistics</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'categories.php' || basename($_SERVER['PHP_SELF']) == 'subcat.php' || basename($_SERVER['PHP_SELF']) == 'manage-trainer.php') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa-solid fa-users"></span>
                    <span class="sidebar-title">Manage Trainers</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="categories">Categories</a></li>
                    <!-- <li><a href="subcat">Sub Categories</a></li> -->
                    <li><a href="manage-trainer">Manage Trainer</a></li>
                </ul>
            </li>
            <!-- 
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'bookings') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa fa-calendar"></span>
                    <span class="sidebar-title">Bookings</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="bookings">All Bookings</a></li>
                </ul>
            </li> -->

            <!-- <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'customers') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa fa-user"></span>
                    <span class="sidebar-title">Customers</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav"> -->
            <!--<li><a href="add-business">Add Model</a></li>-->
            <!-- <li><a href="customers">Manage Customers</a></li>
                </ul>
            </li> -->
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'gallery.php') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa-regular fa-image"></span>
                    <span class="sidebar-title">Gallery </span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="gallery">Gallery</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'certification.php') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa-solid fa-certificate"></span>
                    <span class="sidebar-title">Certification </span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="certification">Certification</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'manage_course.php') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa-solid fa-certificate"></span>
                    <span class="sidebar-title">Course </span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="manage_course">Course</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'trainer_schedule.php') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa-solid fa-list"></span>
                    <span class="sidebar-title">Trainer Schedule </span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="trainer_schedule">Trainer Schedule</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'add_page.php') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa-solid fa-list"></span>
                    <span class="sidebar-title">Add Page</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="add_page">Add Page</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'manage_banner.php') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa-solid fa-list"></span>
                    <span class="sidebar-title">Add Banners</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="manage_banner">Add Page</a></li>
                </ul>
            </li>
            <li style="display:none">
                <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'blog-category' || basename($_SERVER['PHP_SELF']) == 'add-blog' || basename($_SERVER['PHP_SELF']) == 'manage-blogs') { ?>menu-open<?php } ?>" href="#">
                    <span class="fa fa-rss"></span>
                    <span class="sidebar-title">Blogs</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li><a href="blog-category">Categories</a></li>
                    <li><a href="add-blog">Add Blog</a></li>
                    <li><a href="manage-blogs">Manage Blog</a></li>
                </ul>
            </li>
            <?php if ($permission['control_panel'] == 'Y') { ?>
                <li style="display:none">
                    <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'home_editor' || basename($_SERVER['PHP_SELF']) == 'category_editor') { ?>menu-open<?php } ?>" href="#">
                        <span class="fa fa-file-text"></span>
                        <span class="sidebar-title">Page Editor</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li><a href="home_editor">Home Page</a></li>
                        <li><a href="category_editor">Category Page</a></li>
                        <li><a href="#" onClick="return confirm('Development in Progress...')">Sub Category Page</a></li>
                        <!--<li><a href="testimonials">Testimonials</a></li>
                            <li><a href="manage_faq">Manage FAQ</a></li>
							<li><a href="ads_request">Manage Ads</a></li>
							<li><a href="header_slider">Header Slider</a></li>
                            <li><a href="change-password">Change Password</a></li>-->
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'settings.php' || basename($_SERVER['PHP_SELF']) == 'manage_faq.php' || basename($_SERVER['PHP_SELF']) == 'change-password.php') { ?>menu-open<?php } ?>" href="#">
                        <span class="fa fa-cogs"></span>
                        <span class="sidebar-title">Settings</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li><a href="settings">General Settings</a></li>
                        <li><a href="manage-city">Cities </a></li>
                        <li><a href="manage-industry">Industry Type </a></li>
                        <li><a href="manage-training-indusctries">Training Industries</a></li>
                        <!--<li><a href="testimonials">Testimonials</a></li>-->
                        <li><a href="manage_faq">Manage FAQ</a></li>
                        <!--<li><a href="ads_request">Manage Ads</a></li>-->
                        <!--<li><a href="header_slider">Header Slider</a></li>-->
                        <li><a href="change-password">Change Password</a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
        <!-- -------------- /Sidebar Menu  -------------- -->
    </div>
    <!-- -------------- /Sidebar Left Wrapper  -------------- -->
</aside>
<!-- -------------- /Sidebar -------------- -->