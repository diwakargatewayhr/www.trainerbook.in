<?php include("../includes/config.php");
if ($_SESSION['AdminID'] < '1') {
  header("location:login");
}

if(@$_REQUEST['DelId'] != '')
{
    mysqli_query($CONN, "DELETE FROM `enquiry_data` WHERE id = '".$_REQUEST['DelId']."'");
    header("location:index");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- -------------- Meta and Title -------------- -->
  <title><?php echo $adminTitle; ?> - Admin Control Panel</title>
  <meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme" />
  <meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
  <meta name="author" content="WebMantra Technologies">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- -------------- Fonts -------------- -->
  <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap" rel="stylesheet">
  <!-- -------------- Icomoon -------------- -->
  <link rel="stylesheet" type="text/css" href="assets/fonts/icomoon/icomoon.css">
  <!-- -------------- FullCalendar -------------- -->
  <link rel="stylesheet" type="text/css" href="assets/js/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="assets/js/plugins/magnific/magnific-popup.css">
  <!-- -------------- Plugins -------------- -->
  <link rel="stylesheet" type="text/css" href="assets/js/plugins/c3charts/c3.min.css">
  <!-- -------------- CSS - theme -------------- -->
  <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">
  <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/pagination.css">
  <link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css">
  <!-- -------------- CSS - allcp forms -------------- -->
  <link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- -------------- Favicon -------------- -->
  <link rel="shortcut icon" href="<?php echo '../upload/logo/' . $portalSetting['favicon']; ?>">
  <!-- -------------- IE8 HTML5 support  -------------- -->
  <!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  <style>
    .col-xs-1,
    .col-sm-1,
    .col-md-1,
    .col-lg-1,
    .col-xl-1,
    .col-xs-2,
    .col-sm-2,
    .col-md-2,
    .col-lg-2,
    .col-xl-2,
    .col-xs-3,
    .col-sm-3,
    .col-md-3,
    .col-lg-3,
    .col-xl-3,
    .col-xs-4,
    .col-sm-4,
    .col-md-4,
    .col-lg-4,
    .col-xl-4,
    .col-xs-5,
    .col-sm-5,
    .col-md-5,
    .col-lg-5,
    .col-xl-5,
    .col-xs-6,
    .col-sm-6,
    .col-md-6,
    .col-lg-6,
    .col-xl-6,
    .col-xs-7,
    .col-sm-7,
    .col-md-7,
    .col-lg-7,
    .col-xl-7,
    .col-xs-8,
    .col-sm-8,
    .col-md-8,
    .col-lg-8,
    .col-xl-8,
    .col-xs-9,
    .col-sm-9,
    .col-md-9,
    .col-lg-9,
    .col-xl-9,
    .col-xs-10,
    .col-sm-10,
    .col-md-10,
    .col-lg-10,
    .col-xl-10,
    .col-xs-11,
    .col-sm-11,
    .col-md-11,
    .col-lg-11,
    .col-xl-11,
    .col-xs-12,
    .col-sm-12,
    .col-md-12,
    .col-lg-12,
    .col-xl-12 {
      position: relative;
      min-height: 1px;
      padding-left: 11px
        /*/ 2*/
      ;
      padding-right: 11px
        /*/ 2*/
      ;
    }

    .panel {
      margin-bottom: 22px;
    }

    .chart {
      width: 100%;
      min-height: 550px;
    }

    .profile-user-wid {
      margin-top: -45px;
      margin-left: 10px;
    }

    .avatar-md {}

    .rounded-circle2 {
      border-radius: 50%;
      height: 65px;
      width: 65px;
    }

    .bg-soft-primary h5 {
      font-size: 16px;
      margin-bottom: 5px;
      padding-bottom: 0px;
      font-weight: 500;
      padding-left: 15px;
    }

    .bg-soft-primary p {
      margin-bottom: 0px;
      padding-left: 5px;
      font-size: 13px;
      padding-left: 15px;
    }

    h5.font-size-15 {
      font-weight: 500;
      font-size: 16px;
      color: #495057;
      margin-bottom: 0px;
      padding-bottom: 5px;
      margin-top: 15px;
    }

    p.text-muted {
      color: #74788d;
      font-size: 13px;
    }

    .card-title.mb-4 {
      font-size: 15px;
      margin: 0 0 7px 0;
      font-weight: 600;
      color: #495057;
    }

    .das_cat_area {
      margin-top: 30px;
    }

    .block_img {
      /* text-align: left; */
      margin-top: -65px;
      /* box-shadow: 0 5px 5px rgb(0 0 0 / 25%); */
      /* border-radius: 100%; */
      -webkit-transition: all 0.5s;
      -ms-transition: all 0.5s;
      transition: all 0.5s;
    }

    .block_img img {
      display: inline-block;
    }

    .block_detail {
      /*text-align:right;*/
    }

    .block_detail h6.text-muted {
      font-weight: 400;
      /* color: #000; */
      font-size: 15px;
      color: #7e7e7e;
    }

    .block_detail h4.ttl.mt5.mbn {
      font-weight: 700;
      font-size: 25px;
    }

    .block_detail h4.ttl.mt5.mbn a {
      color: #000;
    }

    .block_detail h4.ttl.mt5.mbn a:hover {
      text-decoration: none;
    }

    #chartdiv {
      width: 100%;
      height: 500px;
    }

    .avatar-title {
      font-weight: 500;
      width: 40px;
      height: 40px;
      line-height: 40px;
      display: inline-block;
      background-color: #556ee6;
      color: #fff;
      border-radius: 50% !important;
    }

    .heading22 {
      font-size: 16px !important;
      margin: 30px 0 7px 0;
      font-weight: 500 !important;
      color: #495057 !important;
      padding-bottom: 0px !important;
    }

    .mb-01 {
      margin-bottom: 0px;
    }

    .mb-0 {
      padding-bottom: 0px !important;
      margin-bottom: 0px !important;
      font-weight: 600 !important;
      font-size: 17px !important;
      margin-top: 0px;
      color: #495057 !important;
    }

    .progress1 {
      margin-bottom: 0px;
    }

    .table22 {}

    .table22 tr td {
      padding: 18px 9px !important;
    }

    /*==================================
    TIMELINE
==================================*/
    /*-- GENERAL STYLES
------------------------------*/
    .timeline {
      line-height: 1.4em;
      list-style: none;
      margin: 0;
      padding: 0;
      width: 100%;
    }

    .timeline h1,
    .timeline h2,
    .timeline h3,
    .timeline h4,
    .timeline h5,
    .timeline h6 {
      line-height: inherit;
    }

    /*----- TIMELINE ITEM -----*/
    .timeline-item {
      padding-left: 40px;
      position: relative;
    }

    .timeline-item:last-child {
      padding-bottom: 0;
    }

    /*----- TIMELINE INFO -----*/
    .timeline-info {
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 3px;
      margin: 0 0 .5em 0;
      text-transform: uppercase;
      white-space: nowrap;
    }

    /*----- TIMELINE MARKER -----*/
    .timeline-marker {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      width: 15px;
    }

    .timeline-marker:before {
      background: #FF6B6B;
      border: 3px solid transparent;
      border-radius: 100%;
      content: "";
      display: block;
      height: 15px;
      position: absolute;
      top: 4px;
      left: 0;
      width: 15px;
      transition: background 0.3s ease-in-out, border 0.3s ease-in-out;
    }

    .timeline-marker:after {
      content: "";
      width: 3px;
      background: #CCD5DB;
      display: block;
      position: absolute;
      top: 24px;
      bottom: 0;
      left: 6px;
    }

    .timeline-item:last-child .timeline-marker:after {
      content: none;
    }

    .timeline-item:not(.period):hover .timeline-marker:before {
      background: transparent;
      border: 3px solid #FF6B6B;
    }

    /*----- TIMELINE CONTENT -----*/
    .timeline-content {
      padding-bottom: 40px;
    }

    .timeline-content p:last-child {
      margin-bottom: 0;
    }

    /*----- TIMELINE PERIOD -----*/
    .period {
      padding: 0;
    }

    .period .timeline-info {
      display: none;
    }

    .period .timeline-marker:before {
      background: transparent;
      content: "";
      width: 15px;
      height: auto;
      border: none;
      border-radius: 0;
      top: 0;
      bottom: 30px;
      position: absolute;
      border-top: 3px solid #CCD5DB;
      border-bottom: 3px solid #CCD5DB;
    }

    .period .timeline-marker:after {
      content: "";
      height: 32px;
      top: auto;
    }

    .period .timeline-content {
      padding: 40px 0 70px;
    }

    .period .timeline-title {
      margin: 0;
    }

    .panel_body_block22 {
      min-height: 123px;
      padding-top: 30px;
      margin-bottom: 60px;
      background-color: #fff;
      transition: all .5s ease-in-out;
      position: relative;
      border: 0px solid transparent;
      border-radius: .35rem;
      box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
      height: calc(100% - 30px);
      text-align: center;
    }

    /*----------------------------------------------
    MOD: TIMELINE SPLIT
----------------------------------------------*/
    @media (min-width: 768px) {

      .timeline-split .timeline,
      .timeline-centered .timeline {
        display: table;
      }

      .timeline-split .timeline-item,
      .timeline-centered .timeline-item {
        display: table-row;
        padding: 0;
      }

      .timeline-split .timeline-info,
      .timeline-centered .timeline-info,
      .timeline-split .timeline-marker,
      .timeline-centered .timeline-marker,
      .timeline-split .timeline-content,
      .timeline-centered .timeline-content,
      .timeline-split .period .timeline-info,
      .timeline-centered .period .timeline-info {
        display: table-cell;
        vertical-align: top;
      }

      .timeline-split .timeline-marker,
      .timeline-centered .timeline-marker {
        position: relative;
      }

      .timeline-split .timeline-content,
      .timeline-centered .timeline-content {
        padding-left: 30px;
      }

      .timeline-split .timeline-info,
      .timeline-centered .timeline-info {
        padding-right: 30px;
      }

      .timeline-split .period .timeline-title,
      .timeline-centered .period .timeline-title {
        position: relative;
        left: -45px;
      }
    }

    /*----------------------------------------------
    MOD: TIMELINE CENTERED
----------------------------------------------*/
    @media (min-width: 992px) {

      .timeline-centered,
      .timeline-centered .timeline-item,
      .timeline-centered .timeline-info,
      .timeline-centered .timeline-marker,
      .timeline-centered .timeline-content {
        display: block;
        margin: 0;
        padding: 0;
      }

      .timeline-centered .timeline-item {
        padding-bottom: 40px;
        overflow: hidden;
      }

      .timeline-centered .timeline-marker {
        position: absolute;
        left: 50%;
        margin-left: -7.5px;
      }

      .timeline-centered .timeline-info,
      .timeline-centered .timeline-content {
        width: 50%;
      }

      .timeline-centered>.timeline-item:nth-child(odd) .timeline-info {
        float: left;
        text-align: right;
        padding-right: 30px;
      }

      .timeline-centered>.timeline-item:nth-child(odd) .timeline-content {
        float: right;
        text-align: left;
        padding-left: 30px;
      }

      .timeline-centered>.timeline-item:nth-child(even) .timeline-info {
        float: right;
        text-align: left;
        padding-left: 30px;
      }

      .timeline-centered>.timeline-item:nth-child(even) .timeline-content {
        float: left;
        text-align: right;
        padding-right: 30px;
      }

      .timeline-centered>.timeline-item.period .timeline-content {
        float: none;
        padding: 0;
        width: 100%;
        text-align: center;
      }

      .timeline-centered .timeline-item.period {
        padding: 50px 0 90px;
      }

      .timeline-centered .period .timeline-marker:after {
        height: 30px;
        bottom: 0;
        top: auto;
      }

      .timeline-centered .period .timeline-title {
        left: auto;
      }
    }

    /*----------------------------------------------
    MOD: MARKER OUTLINE
----------------------------------------------*/
    .marker-outline .timeline-marker:before {
      background: transparent;
      border-color: #FF6B6B;
    }

    .marker-outline .timeline-item:hover .timeline-marker:before {
      background: #FF6B6B;
    }
  </style>
  <script type="text/javascript">
    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();

      // add a zero in front of numbers<10
      m = checkTime(m);
      s = checkTime(s);
      if (h < 12)
        document.getElementById('clock').innerHTML = h + ":" + m + ":" + s + " AM";
      else
        document.getElementById('clock').innerHTML = h + ":" + m + ":" + s + " PM";

      t = setTimeout('startTime()', 500);
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
  </script>
</head>

<body class="dashboard-page">
  <?php include 'templates/wm-customizer.php'; ?>
  <!-- -------------- Body Wrap  -------------- -->
  <div id="main">
    <?php include 'templates/wm-header.php'; ?>
    <?php include 'templates/wm-sidebar.php'; ?>
    <!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper">
      <?php include 'templates/main-wrapper.php'; ?>
      <!-- -------------- Topbar -------------- -->
      <header id="topbar" class="alt">
        <div class="topbar-left">
          <ol class="breadcrumb">
            <li class="breadcrumb-icon"> <a href="index"> <span class="fa fa-home"></span> </a> </li>
            <li class="breadcrumb-active"> <a href="index">Dashboard</a> </li>
            <li class="breadcrumb-link"> <a href="index">Home</a> </li>
            <li class="breadcrumb-current-item">Statistics</li>
          </ol>
        </div>
        <div class="topbar-right">
          <div class="ib topbar-dropdown">
            <label for="topbar-multiple" class="control-label">Today is <b></b><?php echo date("d F, Y"); ?></b></label>
          </div>
        </div>
      </header>
      <!-- -------------- /Topbar -------------- -->
      <!-- -------------- Content -------------- -->
      <section id="content" class="table-layout animated fadeIn">
        <!-- -------------- Column Center -------------- -->
        <div class="chute chute-center">
          <div class="row">

            <div class="col-sm-12 col-xl-12">
              <div class="das_cat_area">
                <div class="row">
                  <div class="col-sm-3 col-xl-3">
                    <div class="">
                      <div class="panel-body panel_body_block22">
                        <div class="row">
                          <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/new_leads.png" class="img-responsive mauto" alt=""></div>
                          <div class="col-xs-12 pl5 block_detail">
                            <h6 class="text-muted">Trainers</h6>
                            <h4 class="ttl mt5 mbn"><a href="customers"><?php echo mysqli_num_rows(mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `type` = 'U'")); ?></a></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3 col-xl-3">
                    <div class="">
                      <div class="panel-body panel_body_block22">
                        <div class="row">
                          <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/quality_leads.png" class="img-responsive mauto" alt=""></div>
                          <div class="col-xs-12 pl5 block_detail">
                            <h6 class="text-muted">Courses</h6>
                            <h4 class="ttl mt5 mbn"><a href="providers"><?php echo mysqli_num_rows(mysqli_query($CONN, "SELECT * FROM `course_details`")); ?></a></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3 col-xl-3">
                    <div class="">
                      <div class="panel-body panel_body_block22">
                        <div class="row">
                          <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/hot_leads.png" class="img-responsive mauto" alt=""></div>
                          <div class="col-xs-12 pl5 block_detail">
                            <h6 class="text-muted">Inquiries</h6>
                            <h4 class="ttl mt5 mbn"><a href="bookings"><?php echo mysqli_num_rows(mysqli_query($CONN, "SELECT * FROM `transaction`")); ?></a></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3 col-xl-3">
                    <div class="">
                      <div class="panel-body panel_body_block22">
                        <div class="row">
                          <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/pending_bookings.png" class="img-responsive mauto" alt=""></div>
                          <div class="col-xs-12 pl5 block_detail">
                            <h6 class="text-muted">Reviews</h6>
                            <h4 class="ttl mt5 mbn"><a href="bookings"><?php echo mysqli_num_rows(mysqli_query($CONN, "SELECT * FROM `review`")); ?></a></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!--<div class="col-sm-3 col-xl-3">-->
                  <!--  <div class="">-->
                  <!--    <div class="panel-body panel_body_block22">-->
                  <!--      <div class="row">-->
                  <!--        <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/closed_leads.png" class="img-responsive mauto" alt=""></div>-->
                  <!--        <div class="col-xs-12 pl5 block_detail">-->
                  <!--          <h6 class="text-muted">Active Services</h6>-->
                  <!--          <h4 class="ttl mt5 mbn"><a href="bookings"><?php echo mysqli_num_rows(mysqli_query($CONN, "SELECT * FROM `products`")); ?></a></h4>-->
                  <!--        </div>-->
                  <!--      </div>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->

                  <!--<div class="col-sm-3 col-xl-3">-->
                  <!--  <div class="">-->
                  <!--    <div class="panel-body panel_body_block22">-->
                  <!--      <div class="row">-->
                  <!--        <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/total_sales.png" class="img-responsive mauto" alt=""></div>-->
                  <!--        <div class="col-xs-12 pl5 block_detail">-->
                  <!--          <h6 class="text-muted">Total Sales</h6>-->
                  <!--          <h4 class="ttl mt5 mbn"><a href="bookings">₹<?php $TotalBooking = mysqli_fetch_array(mysqli_query($CONN, "SELECT SUM(price) AS TotalBooking FROM `mycart`"));
                                                                        echo number_format($TotalBooking['TotalBooking']); ?></a></h4>-->
                  <!--        </div>-->
                  <!--      </div>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->

                  <!--<div class="col-sm-3 col-xl-3">-->
                  <!--  <div class="">-->
                  <!--    <div class="panel-body panel_body_block22">-->
                  <!--      <div class="row">-->
                  <!--        <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/todays_sales.png" class="img-responsive mauto" alt=""></div>-->
                  <!--        <div class="col-xs-12 pl5 block_detail">-->
                  <!--          <h6 class="text-muted">Today's Sales</h6>-->
                  <!--          <h4 class="ttl mt5 mbn"><a href="bookings">₹<?php $TodayBooking = mysqli_fetch_array(mysqli_query($CONN, "SELECT SUM(price) AS TodayBooking FROM `mycart` WHERE datetime LIKE '%" . date('Y-m-d') . "%'"));
                                                                        echo number_format($TodayBooking['TodayBooking']); ?></a></h4>-->
                  <!--        </div>-->
                  <!--      </div>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->

                  <!--<div class="col-sm-3 col-xl-3">-->
                  <!--  <div class="">-->
                  <!--    <div class="panel-body panel_body_block22">-->
                  <!--      <div class="row">-->
                  <!--        <div class="col-xs-12 ph10 block_img"><img src="assets/img/pages/completed_bookings.png" class="img-responsive mauto" alt=""></div>-->
                  <!--        <div class="col-xs-12 pl5 block_detail">-->
                  <!--          <h6 class="text-muted">Completed Bookings</h6>-->
                  <!--          <h4 class="ttl mt5 mbn"><a href="bookings">0</a></h4>-->
                  <!--        </div>-->
                  <!--      </div>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->
                  
                </div>

              </div>
            </div>
          </div>



          <!--  Column Center  -->
          <div class="chute chute-center">

            <!-- Products Status Table -->
            <div class="row">
              <div class="col-xs-12">
                <div class="panel">
                  <div class="panel-heading">
                    <span class="panel-title hidden-xs">Latest Inquiries</span>
                  </div>
                  <div class="panel-body pn">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr class="bg-light">
                            <th class="">Course</th>
                            <th class="">Full Name</th>
                            <th class="">Phone</th>
                            <th class="">Email</th>
                            <th class="">Date</th>
                            <th class="text-right">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sl = 0;
                          $result2 = mysqli_query($CONN, "SELECT * FROM `enquiry_data` ORDER BY `id` DESC");
                          while ($getValue = mysqli_fetch_array($result2)) {
                            $provider = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `course_details` WHERE `id` = '" . $getValue['fk_course_id'] . "'"));
                            $sl++;
                          ?>
                            <tr>
                              <td class="" style="text-align:left;"><?php echo $provider['course_name']; ?></td>
                              <td class="" style="text-align:left;"><?php echo $getValue['name']; ?></td>
                              <td class="" style="text-align:left;"><?php echo $getValue['phone']; ?></td>
                              <td class="" style="text-align:left;"><?php echo $getValue['email']; ?></td>
                              <td class="" style="text-align:left;"><?php echo $getValue['created_at']; ?></td>
                              <td class="text-right">
                                <div class="btn-group text-right">
                                  <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                    <span class="caret ml5"></span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="index?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
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
            <!--<div><?= $pagination ?></div>-->
          </div>
          <!-- /Column Center -->
          <div class="row" style="display:none;">
            <div class="col-xs-12">
              <div class="panel">
                <div class="panel-heading"> <span class="panel-title hidden-xs">Last 25 Reports</span> </div>
                <div class="panel-body pn">
                  <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr class="bg-light">
                          <th class="">Booking No.</th>
                          <th class="">Patient Name</th>
                          <th class="">Referance Doctor</th>
                          <th class="">Report Fee</th>
                          <th class="">Uploaded On</th>
                          <th class="">Report</th>
                          <th class="text-right">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php //$getQuery = mysqli_query($CONN,"SELECT * FROM `test_reports` WHERE `labid` = '".@$_SESSION['AdminID']."' AND status = 'D'"); 
                        //while($getValue = mysqli_fetch_array($getQuery)) { 
                        ?>
                        <tr>
                          <td class="" style="text-align:left;"><?php echo @$getValue['bookingno']; ?></td>
                          <td class=""><?php //$patient = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `patients` WHERE `patientid` = '".$getValue['patient_name']."'")); echo $patient['fullname']; 
                                        ?></td>
                          <td class=""><?php //$bookings = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `bookings` WHERE `id` = '".$getValue['bookingno']."'")); //$getDoctor = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `doctors` WHERE `id` = '".$bookings['referred_doctor']."'")); echo $getDoctor['doctor_name']; 
                                        ?></td>
                          <td class="">₹ <?php echo @$getValue['sale_fee']; ?></td>
                          <td class=""><?php echo @$getValue['datetime']; ?></td>
                          <td class=""><a href="../upload/document/<?php echo @$getValue['document']; ?>" target="_blank">Download</a></td>
                          <td class="text-right"><?php if (@$bookings['method'] == '') { ?><span class="label label-danger">Unpaid</span><?php } ?><?php if (@$bookings['method'] != '') { ?><span class="label label-success">Paid</span><?php } ?></td>
                        </tr>
                        <?php //} 
                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12" style="display:none;">
              <div class="panel">
                <div class="panel-heading"> <span class="panel-title hidden-xs">20 New Leads</span> </div>
                <div class="panel-body pn">
                  <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Lead No.</th>
                          <th>Project Title</th>
                          <th>Budget</th>
                          <!--<th>Country</th>-->
                          <th>Lead Fee</th>
                          <th>Client Name</th>
                          <th>Phone No.</th>
                          <!--<th>Withdral Status</th>-->
                          <th>Date</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><a href="#" target="_blank">99776266</a></td>
                          <td class="">Need Android Developer</td>
                          <td class=""><span class="fa fa-rupee"></span> To be discussed</td>
                          <!--<td class=""></td>-->
                          <td class=""><span class="fa fa-rupee"></span> 200</td>
                          <td class="">&lrm;Sanjana Rathore</td>
                          <td class="">+917791910007</td>
                          <td class="">2020-06-01 08:30:15</td>
                          <td class="text-right">
                            <div class="btn-group text-right">
                              <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret ml5"></span> </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="add-lead?edit=99776266">Edit</a></li>
                                <li><a href="javascript:void(0);" onClick="window.open(&quot;view-lead?data=99776266&quot;, &quot;_blank&quot;, &quot;toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=600,height=450&quot;)">View Mail</a></li>
                                <li><a href="#" onClick="return confirm('Would you like to send alerts to subscribers?')">Send Alert</a></li>
                                <li><a href="#" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- -------------- Quick Links -------------- -->
          <!--<div class="row">
                    <div class="col-sm-4 col-xl-4">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="assets/img/pages/tests_ico.png" class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h6 class="text-muted">Tests</h6>
                                        <h4 class="fs20 mt5 mbn"><a href="manage_tests"><?php //echo mysqli_num_rows(mysqli_query($CONN,"SELECT * FROM `clinto_tests`")); 
                                                                                        ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="assets/img/pages/patient-ico.png" class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h6 class="text-muted">Patients</h6>
                                        <h4 class="fs20 mt5 mbn"><a href="manage-patient"><?php //echo mysqli_num_rows(mysqli_query($CONN,"SELECT * FROM `patients`")); 
                                                                                          ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-sm-4 col-xl-4">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="assets/img/pages/bookings-ico.png" class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h6 class="text-muted">All Bookings</h6>

                                        <h4 class="fs20 mt5 mbn"><a href="all-bookings">0<?php //echo mysqli_num_rows(mysqli_query($CONN,"SELECT * FROM `user_register`")); 
                                                                                          ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>-->
          <!-- -------------- AllCP Info -------------- -->
          <div class="allcp-panels fade-onload">
            <div class="row">
              <!--<div class="col-md-12">
                        <?php //$getQuery = mysqli_query($CONN,"SELECT * FROM `campaigns` WHERE `status` = 'Block' ORDER BY `datetime` DESC LIMIT 0,10"); 
                        ?>
                           
                            <div class="panel" id="spy5">
                                <div class="panel-heading">
                                    <span class="panel-title">New Bookings</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="bs-component">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                
                                                <thead class="bg-dark">
                                                <tr>
                                                    <th class="br-t-n pl30">BOOKING ID</th>
                                                    <th class="br-t-n hidden-xs">TEST</th>
                                                    <th class="br-t-n">PATIENT NAME</th>
                                                    <th class="br-t-n">BOOKING DATE</th>
                                                    <th class="br-t-n">PAID</th>
                                                    <th class="br-t-n">STATUS</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php //while($getValue = mysqli_fetch_array($getQuery)) { 
                                                ?>
                                                <tr>
                                                    <td class="pl30"><a href="edit-campaign?edit=<?php //echo $getValue['id']; 
                                                                                                  ?>"><?php //echo $getValue['title']; 
                                                                                                                                    ?></a></td>
                                                   
                                                    <td><?php //echo $getValue['datetime']; 
                                                        ?></td>
                                                    <td><?php //if($getValue['status'] == 'Active') { 
                                                        ?><span class="label label-success ml5">Active</span><?php //} else { 
                                                                                                                                                            ?><span class="label label-danger ml5">Pending</span><?php //} 
                                                                                                                                                                                                                                  ?></td>
                                                    <td><?php //echo $getValue['datetime']; 
                                                        ?></td>
                                                    <td><?php //echo $getValue['datetime']; 
                                                        ?></td>
                                                    <td><?php //echo $getValue['datetime']; 
                                                        ?></td>
                                                </tr>
                                                <?php //} 
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>-->
              <!--<div class="col-md-12">
                        <?php //$getQuery = mysqli_query($CONN, "SELECT * FROM `campaigns` WHERE `status` = 'Active' ORDER BY `datetime` DESC LIMIT 0,10"); 
                        ?>
                            
                            <div class="panel" id="spy3">
                                <div class="panel-heading">
                                    <span class="panel-title">New Patients</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="bs-component">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                
                                                <thead class="bg-dark">
                                                <tr>
                                                    <th class="br-t-n pl30">PATIENT NO.</th>
                                                    <th class="br-t-n hidden-xs">NAME</th>
                                                    <th class="br-t-n">PHONE NO</th>
                                                    <th class="br-t-n">REGISTERED ON</th>
                                                    <th class="br-t-n">STATUS</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php //while($getValue = mysqli_fetch_array($getQuery)) { 
                                                ?>
                                                <tr>
                                                    <td class="pl30">
                                                    <a href="edit-campaign?edit=<?php //echo $getValue['id']; 
                                                                                ?>"><?php //echo $getValue['title']; 
                                                                                                                  ?></a></td>
                                                    
                                                    <td><?php //echo $getValue['datetime']; 
                                                        ?></td>
                                                    <td><?php //if($getValue['status'] == 'Active') { 
                                                        ?><span class="label label-success ml5">Active</span><?php //} else { 
                                                                                                                                                            ?><span class="label label-danger ml5">Pending</span><?php //} 
                                                                                                                                                                                                                                  ?></td>
                                                </tr>
                                                <?php //} 
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>-->
              <div class="col-md-6">
                <!-- -------------- Traphic Sources -------------- -->
                <!--<div class="panel" id="spy9">
                                <div class="panel-heading">
                                    <span class="panel-title">Host Condition (Estimated)</span>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4 text-center p5">
                                            <div class="info-circle  va-m" id="c1" value="<?php //echo rand(94,96); 
                                                                                          ?>"
                                                 data-circle-color="primary"></div>
                                            <div class="text-dark fw600">Available Space(%)</div>
                                        </div>
                                        <div class="col-sm-4 text-center p5">
                                            <div class="info-circle" id="c2" value="<?php //echo rand(40,50); 
                                                                                    ?>"
                                                 data-circle-color="primary"></div>
                                            <div class="text-dark fw600">Server Load Averages(%)</div>
                                        </div>
                                        <div class="col-sm-4 text-center p5">
                                            <div class="info-circle" id="c3" value="100"
                                                 data-circle-color="primary"></div>
                                            <div class="text-dark fw600">Server Uptime(%)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
              </div>
            </div>
          </div>
        </div>
  </div>
  <!-- -------------- /Column Center -------------- -->
  </section>
  <!-- -------------- /Content -------------- -->
  </section>
  <!-- -------------- /Main Wrapper -------------- -->
  </div>
  <!-- -------------- /Body Wrap  -------------- -->
  <!-- -------------- Scripts -------------- -->
  <!-- -------------- jQuery -------------- -->
  <script src="assets/js/jquery/jquery-1.11.3.min.js"></script>
  <script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>
  <!-- datatable -->
  <script src="assets/datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/datatable/js/dataTables.bootstrap.min.js"></script>
  <!-- -------------- HighCharts Plugin -------------- -->
  <script src="assets/js/plugins/highcharts/highcharts.js"></script>
  <script src="assets/js/plugins/c3charts/d3.min.js"></script>
  <script src="assets/js/plugins/c3charts/c3.min.js"></script>
  <!-- -------------- Simple Circles Plugin -------------- -->
  <script src="assets/js/plugins/circles/circles.js"></script>
  <!-- -------------- Maps JSs -------------- -->
  <script src="assets/js/plugins/jvectormap/jquery.jvectormap.min.js"></script>
  <script src="assets/js/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js"></script>
  <!-- -------------- FullCalendar Plugin -------------- -->
  <script src="assets/js/plugins/fullcalendar/lib/moment.min.js"></script>
  <script src="assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
  <!-- -------------- Date/Month - Pickers -------------- -->
  <script src="assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
  <script src="assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
  <!-- -------------- Magnific Popup Plugin -------------- -->
  <script src="assets/js/plugins/magnific/jquery.magnific-popup.js"></script>
  <!-- -------------- Theme Scripts -------------- -->
  <script src="assets/js/utility/utility.js"></script>
  <script src="assets/js/demo/demo.js"></script>
  <script src="assets/js/main.js"></script>
  <!-- -------------- Widget JS -------------- -->
  <script src="assets/js/demo/widgets.js"></script>
  <script src="assets/js/demo/widgets_sidebar.js"></script>
  <script src="assets/js/pages/dashboard1.js"></script>
  <!-- -------------- /Scripts -------------- -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
  <script src='https://www.google.com/jsapi'></script>
  <script>
    google.load("visualization", "1", {
      packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart1);

    function drawChart1() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', 'Expenses'],
        ['2004', 1000, 400],
        ['2005', 1170, 460],
        ['2006', 660, 1120],
        ['2007', 1030, 540]
      ]);

      var options = {
        /*title: 'Company Performance',*/
        hAxis: {
          title: 'Year',
          titleTextStyle: {
            color: 'red'
          }
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
      chart.draw(data, options);
    }

    google.load("visualization", "1", {
      packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart2);

    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', 'Expenses'],
        ['2013', 1000, 400],
        ['2014', 1170, 460],
        ['2015', 660, 1120],
        ['2016', 1030, 540]
      ]);

      var options = {
        /* title: 'Company Performance',*/
        hAxis: {
          title: 'Year',
          titleTextStyle: {
            color: '#333'
          }
        },
        vAxis: {
          minValue: 0
        }
      };

      var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
      chart.draw(data, options);
    }

    $(window).resize(function() {
      drawChart1();
      drawChart2();
    });

    // Reminder: you need to put https://www.google.com/jsapi in the head of your document or as an external resource on codepen //
  </script>
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Jan 20", "Feb 20", "Mar 20", "Apr 20", "May 20", "Jun 20", " Jul 20"],
        datasets: [{
          label: 'Leads',
          data: [150, 160, 170, 240, 0, 0, 0],
          backgroundColor: "rgba(185,157,38,1)"
        }, {
          label: 'Sales',
          data: [25, 27, 30, 40, 0, 0, 0],
          backgroundColor: "rgba(1,171,168,1)"
        }]
      }
    });
  </script>
  <!-- Chart code -->
  <script>
    am4core.ready(function() {

      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end

      // Create chart instance
      var chart = am4core.create("chartdiv", am4charts.PieChart);

      // Add data
      chart.data = [{
        "country": "Lithuania",
        "litres": 501.9
      }, {
        "country": "Czech Republic",
        "litres": 301.9
      }, {
        "country": "Ireland",
        "litres": 201.1
      }, {
        "country": "Germany",
        "litres": 165.8
      }, {
        "country": "Australia",
        "litres": 139.9
      }, {
        "country": "Austria",
        "litres": 128.3
      }, {
        "country": "UK",
        "litres": 99
      }, {
        "country": "Belgium",
        "litres": 60
      }, {
        "country": "The Netherlands",
        "litres": 50
      }];

      // Set inner radius
      chart.innerRadius = am4core.percent(50);

      // Add and configure Series
      var pieSeries = chart.series.push(new am4charts.PieSeries());
      pieSeries.dataFields.value = "litres";
      pieSeries.dataFields.category = "country";
      pieSeries.slices.template.stroke = am4core.color("#fff");
      pieSeries.slices.template.strokeWidth = 2;
      pieSeries.slices.template.strokeOpacity = 1;

      // This creates initial animation
      pieSeries.hiddenState.properties.opacity = 1;
      pieSeries.hiddenState.properties.endAngle = -90;
      pieSeries.hiddenState.properties.startAngle = -90;

    }); // end am4core.ready()
  </script>

  <script>
    $(document).ready(function() {
      $('#example').dataTable({
        "order": [
          [0, "desc"]
        ],
        "pageLength": 15
      });
    });
  </script>

</body>

</html>