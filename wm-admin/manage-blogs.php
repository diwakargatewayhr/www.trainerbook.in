<?php
include("../includes/config.php");
if($_SESSION['AdminID'] < '1')
{
    header("location:login");
}

if(@$_REQUEST['DelId']!='')
{
    mysqli_query($CONN, "DELETE FROM `blogs` WHERE blog_id = '".$_REQUEST['DelId']."'");
    header("location:manage-blogs"); exit;
}

if(@$_REQUEST['activate']!= '')
{
    mysqli_query($CONN, "UPDATE `blogs` SET status = '".$_REQUEST['update']."' WHERE blog_id = '".$_REQUEST['activate']."'");
    header("location:manage-blogs"); exit;
}

if(@$_REQUEST['block']!= '')
{
    mysqli_query($CONN, "UPDATE `blogs` SET status = '".$_REQUEST['update']."' WHERE blog_id = '".$_REQUEST['block']."'");
    header("location:manage-blogs"); exit;
}

$tbl_name="blogs"; //your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
/*
First get total number of rows in data table.
If you have a WHERE clause in your query, make sure you mirror it here.
*/
if(@$_REQUEST['date']=='') { $query = "SELECT COUNT(*) as num FROM $tbl_name ORDER BY datetime DESC"; }
if(@$_REQUEST['date']!='') { $query = "SELECT COUNT(*) as num FROM $tbl_name ORDER BY datetime DESC"; }
$total_pages = mysqli_fetch_array(mysqli_query($CONN, $query));
$total_pages = $total_pages['num'];

/* Setup vars for query. */
$targetpage = "manage-blogs"; 	//your file name  (the name of this file)
$limit = 20; 								//how many items to show per page
$page = @$_GET['page'];
if($page)
    $start = ($page - 1) * $limit; 			//first item to display on this page
else
    $start = 0;								//if no page var is given, set start to 0

/* Get data. */
if(@$_REQUEST['date']=='') { $sql = "SELECT * FROM $tbl_name ORDER BY datetime DESC LIMIT $start, $limit"; }
if(@$_REQUEST['date']!='') { $sql = "SELECT * FROM $tbl_name ORDER BY datetime DESC LIMIT $start, $limit"; }
$result = mysqli_query($CONN, $sql);

/* Setup page vars for display. */
if ($page == 0) $page = 1;					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/*
Now we apply our rules and draw the pagination object.
We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
if($lastpage > 1)
{
    $pagination .= "<div class=\"pagination\">";
//previous button
    if ($page > 1)
        $pagination.= "<a href=\"$targetpage?page=$prev\">&lt; previous</a>";
    else
        $pagination.= "<span class=\"disabled\">&lt; previous</span>";

//pages
    if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
    {
        for ($counter = 1; $counter <= $lastpage; $counter++)
        {
            if ($counter == $page)
                $pagination.= "<span class=\"current\">$counter</span>";
            else
                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
        }
    }
    elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
    {
//close to beginning; only hide later pages
        if($page < 1 + ($adjacents * 2))
        {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
        }
//in middle; hide some front and some back
        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
        {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
        }
//close to end; only hide early pages
        else
        {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
        }
    }
//next button
    if ($page < $counter - 1)
        $pagination.= "<a href=\"$targetpage?page=$next\">next &gt;</a>";
    else
        $pagination.= "<span class=\"disabled\">next &gt;</span>";
    $pagination.= "</div>\n";
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

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/pagination.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css" />

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.min.css">

    <!-- -------------- Plugins -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/c3charts/c3.min.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo '../upload/logo/'.$portalSetting['favicon']; ?>">

    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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

        <?php if(@$_REQUEST['created'] == 'yes') { ?>
            <div class="alert alert-success dark alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <i class="fa fa-info pr10"></i> Blog added successfully!
            </div>
        <?php } ?>


        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <!-- -------------- Products Status Table -------------- -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> Blogs (<?php echo $total_pages; ?>)</span>
                            </div>
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr class="bg-light">
                                            <th class="">sl.no.</th>
                                            <th class="">Blog Name</th>
                                            <!--<th class="">Role</th>-->
                                            <th class="">Category</th>
                                            <!--<th class="">Campaigns</th>-->
                                            <th class="">Status</th>
                                            <th class="">Date</th>
                                            <th class="text-right">Actions</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $yy = ""; 
                                        while($getValue = mysqli_fetch_array($result)) {
                                            $yy++;
                                            $count_campaigns = mysqli_num_rows(mysqli_query($CONN, "SELECT * FROM `blogs` ORDER BY `blog_id` DESC"));
                                            ?>
                                            <tr>
                                                <td style="text-transform:capitalize; text-align:left;"><?php echo $yy; ?></td>
                                                <td class=""><?php echo $getValue['blog_title']; ?></td>
                                                <!--<td class="">
                                            <?php if($getValue['type'] == 'A') { ?> Administrator <?php }elseif($getValue['type'] == 'M'){ ?> Moderator <?php } else{ ?> Subscriber <?php } ?>

                                                </td>-->
                                                <td class=""><?php $getCategory = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `blog_category` WHERE cat_id = '".$getValue['category']."'")); echo $getCategory['category_name']; ?></td>
                                                <!--<td class=""><?php echo $count_campaigns; ?></td>-->
                                                <td class="">
                                                    <?php if(@$getValue['status'] == 'Y') { ?><a href="manage-allmembers?activate=<?php echo @$getValue['id']; ?>&update=N" style="color:#090;">Active</a><?php } else{ ?><a href="manage-allmembers?block=<?php echo @$getValue['id']; ?>&update=Y" style="color:#F00;">Block</a><?php } ?>
                                                </td>
                                                <td class=""><?php echo $getValue['datetime']; ?></td>
                                                <td class="text-right">
                                                    <div class="btn-group text-right">
                                                        <button type="button"
                                                                class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false"> Action
                                                            <span class="caret ml5"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            
                                                            <li>
                                                                <a href="add-blog?edit=<?php echo $getValue['blog_id'];?>">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="manage-blogs?DelId=<?php echo $getValue['blog_id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                            </li>
                                                            
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
                <div><?=$pagination?></div>
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

<!-- -------------- JvectorMap Plugin -------------- -->
<script src="assets/js/plugins/jvectormap/jquery.jvectormap.min.js"></script>
<script src="assets/js/plugins/jvectormap/assets/jquery-jvectormap-world-mill-en.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="assets/js/plugins/highcharts/highcharts.js"></script>
<script src="assets/js/plugins/c3charts/d3.min.js"></script>
<script src="assets/js/plugins/c3charts/c3.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="assets/js/utility/utility.js"></script>
<script src="assets/js/demo/demo.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/demo/widgets_sidebar.js"></script>
<script src="assets/js/pages/dashboard2.js"></script>

<!-- -------------- Page JS -------------- -->
<script src="assets/js/demo/charts/highcharts.js"></script>
<script src="assets/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/datatable/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<!-- -------------- /Scripts -------------- -->

</body>

</html>
