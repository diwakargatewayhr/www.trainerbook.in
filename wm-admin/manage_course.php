<?php include("../includes/config.php");
if ($_SESSION['AdminID'] < '1') {
    header("location:login");
}

if (isset($_REQUEST['submit']) && @$_REQUEST['edit'] == '') {
    $video_random = rand(1, 999999);

    $video_target_path = null;

    $video_thumbnail = null;
    $course_image = null;
    $VideoFileName = null;
    if (!empty($_FILES['video_thumbnail']['name'])) {
        $video_target_path = "../upload/course/" . $video_random . basename($_FILES['video_thumbnail']['name']);
        $video_thumbnail = $video_random . $_FILES['video_thumbnail']['name'];
        move_uploaded_file($_FILES['video_thumbnail']['tmp_name'], $video_target_path);
    }
    if (!empty($_FILES['course_image']['name'])) {
        $video_target_path = "../upload/course/" . $video_random . basename($_FILES['course_image']['name']);
        $course_image = $video_random . $_FILES['course_image']['name'];
        move_uploaded_file($_FILES['course_image']['tmp_name'], $video_target_path);
    }
    
    $training_plan = ''; // Initialize the variable

    if (!empty($_FILES['training_plan']['name'])) {
        $video_random = time(); // Add this if $video_random is not defined earlier
        $video_target_path1 = "../upload/course/" . $video_random . basename($_FILES['training_plan']['name']);
        $training_plan = $video_random . $_FILES['training_plan']['name'];
        $file_extension = pathinfo($_FILES['training_plan']['name'], PATHINFO_EXTENSION);
    
        if (strtolower($file_extension) == 'pdf') {
            move_uploaded_file($_FILES['training_plan']['tmp_name'], $video_target_path1);
        } else {
            $training_plan = ''; // Reset if not a PDF
        }
    }
            
    if (!empty($_FILES['course_video']['name'])) {
        $video_target_path = "../upload/course/" . $video_random . basename($_FILES['course_video']['name']);
        $VideoFileName = $video_random . $_FILES['course_video']['name'];
        move_uploaded_file($_FILES['course_video']['tmp_name'], $video_target_path);
    }
    
    $videoThumbnail = $video_thumbnail ? "'" . mysqli_real_escape_string($CONN, $video_thumbnail) . "'" : 'NULL';
    $course_image = $course_image ? "'" . mysqli_real_escape_string($CONN, $course_image) . "'" : 'NULL';
    // $training_plan = $training_plan ? "'" . mysqli_real_escape_string($CONN, $training_plan) . "'" : 'NULL';
    $training_plan = !empty($training_plan) ? "'" . mysqli_real_escape_string($CONN, $training_plan) . "'" : 'NULL';
    $videoFileName = $VideoFileName ? "'" . mysqli_real_escape_string($CONN, $VideoFileName) . "'" : 'NULL';


    $topicData = array();
           if (isset($_REQUEST['course_topic_name']) && isset($_REQUEST['course_topic_duration'])) {
            $topicData = [];
        
            // Check if any files were uploaded
            if (!empty($_FILES['course_topic_pdf']['name'][0])) {
                // Iterate through each uploaded file
                for ($fileIndex = 0; $fileIndex < count($_FILES['course_topic_pdf']['name']); $fileIndex++) {
                    $video_random = uniqid(); 
                    $video_target_path1 = "../upload/course/" . $video_random . basename($_FILES['course_topic_pdf']['name'][$fileIndex]);
                    $course_topic_pdf = $video_random . $_FILES['course_topic_pdf']['name'][$fileIndex];
                    $file_extension = pathinfo($_FILES['course_topic_pdf']['name'][$fileIndex], PATHINFO_EXTENSION);
        
                    // Check if the file is a PDF
                    if (strtolower($file_extension) == 'pdf') {
                        move_uploaded_file($_FILES['course_topic_pdf']['tmp_name'][$fileIndex], $video_target_path1);
                    } else {
                        echo "Only PDF files are allowed.";
                    }
        
                    // Process each topic entry
                    $topicName = $_REQUEST['course_topic_name'][$fileIndex] ?? '';
                    $topicDuration = $_REQUEST['course_topic_duration'][$fileIndex] ?? '';
        
                    // Create topic entry with PDF file if uploaded
                    $topicEntry = [
                        'name' => $topicName,
                        'duration' => $topicDuration,
                    ];
        
                    if (!empty($course_topic_pdf)) {
                        $topicEntry['pdf'] = $course_topic_pdf;
                    }
        
                    if (!empty($topicName) && !empty($topicDuration)) {
                        $topicData[] = $topicEntry;
                    }
                }
            } else {
                echo "No files uploaded.";
            }
        }

    $jsonData = json_encode($topicData);

    $course_name = $_REQUEST['course_name'];
    $course_slug = createSlug($course_name);

    mysqli_query($CONN, "INSERT INTO `course_details` (
        `course_name`, 
        `course_slug`, 
        `course_duration`, 
        `course_cities`,
        `course_category`, 
        `course_outline`, 
        `course_location`, 
        `course_type`, 
        `requirements`, 
        `course_time_slot`, 
        `course_content`, 
        `video_thumbnail`, 
        `course_video`, 
        `course_image`, 
        `training_plan`, 
        `course_topic_details`, 
        `status`, 
        `created_at`
    ) VALUES (
        '" . $_REQUEST['course_name'] . "', 
        '" . $course_slug . "', 
        '" . $_REQUEST['course_duration'] . "', 
        '" . $_REQUEST['course_cities'] . "', 
        '" . $_REQUEST['course_category'] . "', 
        '" . $_REQUEST['course_outline'] . "', 
        '" . $_REQUEST['course_location'] . "', 
        '" . $_REQUEST['course_type'] . "', 
        '" . $_REQUEST['requirements'] . "', 
        '" . $_REQUEST['course_time_slot'] . "', 
        '" . mysqli_real_escape_string($CONN, $_REQUEST['course_content']) . "', 
        $videoThumbnail,
        $videoFileName ,
        $course_image ,
        $training_plan ,
        '$jsonData' ,
        'Y',  
        now()
    )");
    header("location:manage_course?created=yes");
    exit;
}


$courses = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `course_details` WHERE `id` = '" . @$_REQUEST['edit'] . "'"));

if (isset($_REQUEST['submit']) && $_REQUEST['course_name'] != '' && $_REQUEST['edit'] != '') {
    $pid = $_REQUEST['edit'];
    $video_random = rand(1, 999999);
    $video_target_path = null;
    $video_thumbnail = null;
    $VideoFileName = null;

    $existingDataQuery = "SELECT `course_video`, `video_thumbnail`,`course_image` FROM `course_details` WHERE `id` = '$pid'";

    $existingDataResult = mysqli_query($CONN, $existingDataQuery);
    $existingData = mysqli_fetch_assoc($existingDataResult);

    $VideoFileName = $existingData['course_video'];
    $video_thumbnail = $existingData['video_thumbnail'];
    $course_image = $existingData['course_image'];

    $course_name = $_REQUEST['course_name'];
    $course_slug = createSlug($course_name);

    if (!empty($_FILES['video_thumbnail']['name'])) {
        $video_target_path = "../upload/course/" . $video_random . basename($_FILES['video_thumbnail']['name']);
        $video_thumbnail = $video_random . $_FILES['video_thumbnail']['name'];
        move_uploaded_file($_FILES['video_thumbnail']['tmp_name'], $video_target_path);
    }
    if (!empty($_FILES['course_image']['name'])) {
        $video_target_path = "../upload/course/" . $video_random . basename($_FILES['course_image']['name']);
        $course_image = $video_random . $_FILES['course_image']['name'];
        move_uploaded_file($_FILES['course_image']['tmp_name'], $video_target_path);
    }

    if (!empty($_FILES['training_plan']['name'])) {
        $video_target_path1 = "../upload/course/" . $video_random . basename($_FILES['training_plan']['name']);
        $training_plan = $video_random . $_FILES['training_plan']['name'];
        $file_extension = pathinfo($_FILES['training_plan']['name'], PATHINFO_EXTENSION);
    
    
        if (strtolower($file_extension) == 'pdf') {
            move_uploaded_file($_FILES['training_plan']['tmp_name'], $video_target_path1);
        } else {
            echo "Only PDF files are allowed.";
        }
    }
    
    if (!empty($_FILES['course_video']['name'])) {
        $video_target_path = "../upload/course/" . $video_random . basename($_FILES['course_video']['name']);
        $VideoFileName = $video_random . $_FILES['course_video']['name'];
        move_uploaded_file($_FILES['course_video']['tmp_name'], $video_target_path);
    }

    $video_thumbnail = $video_thumbnail ? "'" . mysqli_real_escape_string($CONN, $video_thumbnail) . "'" : 'NULL';
    $VideoFileNameSQL = $VideoFileName ? "'" . mysqli_real_escape_string($CONN, $VideoFileName) . "'" : 'NULL';
    $training_plan = $training_plan ? "'" . mysqli_real_escape_string($CONN, $training_plan) . "'" : 'NULL';
    $course_image = $course_image ? "'" . mysqli_real_escape_string($CONN, $course_image) . "'" : 'NULL';
    
    
  $topicData = array();

if (isset($_REQUEST['course_topic_name']) && isset($_REQUEST['course_topic_duration'])) {
    for ($i = 0; $i < count($_REQUEST['course_topic_name']); $i++) {
        $topicName = $_REQUEST['course_topic_name'][$i];
        $topicDuration = $_REQUEST['course_topic_duration'][$i];
        $oldPdf = isset($_REQUEST['old_pdf'][$i]) ? $_REQUEST['old_pdf'][$i] : '';
        $newPdf = isset($_FILES['course_topic_pdf']['name'][$i]) ? $_FILES['course_topic_pdf']['name'][$i] : '';

        if ($topicDuration !== "") {
            $topicEntry = [
                'name' => $topicName,
                'duration' => $topicDuration,
            ];

            // Handle PDF upload
            if (!empty($newPdf)) {
                $video_random = uniqid();
                $video_target_path1 = "../upload/course/" . $video_random . basename($newPdf);
                $file_extension = pathinfo($newPdf, PATHINFO_EXTENSION);

                // Check if the file is a PDF
                if (strtolower($file_extension) == 'pdf') {
                    move_uploaded_file($_FILES['course_topic_pdf']['tmp_name'][$i], $video_target_path1);
                    $topicEntry['pdf'] = $video_random . $newPdf;
                } else {
                    echo "Only PDF files are allowed.";
                }
            } elseif (!empty($oldPdf)) {
                // Retain old PDF if no new PDF is uploaded
                $topicEntry['pdf'] = $oldPdf;
            }

            $topicData[] = $topicEntry;
        }
    }
}

$jsonData = json_encode($topicData);


    $query = mysqli_query($CONN, "UPDATE course_details SET 
    `course_name` = '" . $_REQUEST['course_name'] . "', 
    `course_duration` = '" . $_REQUEST['course_duration'] . "', 
    `course_cities` = '" . $_REQUEST['course_cities'] . "', 
    `course_category` = '" . $_REQUEST['course_category'] . "', 
    `course_slug` = '" . $course_slug . "', 
    `course_outline` = '" . $_REQUEST['course_outline'] . "', 
    `course_location` = '" . $_REQUEST['course_location'] . "', 
    `course_type` = '" . $_REQUEST['course_type'] . "', 
    `requirements` = '" . $_REQUEST['requirements'] . "', 
    `course_time_slot` = '" . $_REQUEST['course_time_slot'] . "', 
    `course_content` = '" . mysqli_real_escape_string($CONN, $_REQUEST['course_content']) . "', 
    `course_topic_details` = '" . $jsonData . "', 
    `video_thumbnail` = $video_thumbnail, 
    `course_image` = $course_image, 
    `course_video` = $VideoFileNameSQL,
    `training_plan` = $training_plan 
WHERE `id` = '" . $_REQUEST['edit'] . "'");

    header("location:manage_course?created=yes");
    exit;
}

if (isset($_REQUEST['DelId'])) {
    $result = mysqli_query($CONN, "SELECT `course_video` FROM `course_details` WHERE `id` = '" . $_REQUEST['DelId'] . "'");
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['course_video']) && file_exists("../upload/course/" . $row['course_video'])) {
        unlink("../upload/course/" . $row['course_video']);
    }

    mysqli_query($CONN, "DELETE FROM `course_details` WHERE `id` = '" . $_REQUEST['DelId'] . "' ");
    header("location:manage_course");
    exit;
}


function createSlug($string)
{
    $slug = strtolower($string);

    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

    $slug = preg_replace('/[\s-]+/', '-', $slug);

    $slug = trim($slug, '-');

    return $slug;
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>Manage Course - <?php echo $adminTitle; ?> - Admin Control Panel</title>
    <meta name="keywords" content="HTML5, <?php echo $adminTitle; ?> Admin Template, UI Theme" />
    <meta name="description" content="<?php echo $adminTitle; ?> - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="WebMantra Technologies">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/pagination.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.min.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.min.css" />
    <!-- -------------- Plugins -------------- -->
    <link rel="stylesheet" type="text/css" href="assets/js/plugins/c3charts/c3.min.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo '../upload/logo/' . $portalSetting['favicon']; ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>

    <style type="text/css">
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .duration-container {
            width: 100%;
        }
        
        .name-sec {
            display: flex;
            align-items: center;
            padding: 0 10px;
        }
        
         .name-sec label {
             width: 42%;
         }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            height: "300"
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

            <!-- -------------- Topbar -------------- -->
            <header id="topbar" class="ph10" style="padding-top:80px;">
                <?php if (@$_SESSION['AdminID'] == '1') { ?><div class="topbar-right mt5 mr35 topbar_right_area">
                        <a href="#" class="btn btn-primary btn-sm ml10" title="New Order" onClick="showHide('hidden_div'); return false;">
                            <span class="fa fa-plus pr5"></span>Add Course</a>
                    </div><?php } ?>
            </header>
            <!-- -------------- /Topbar -------------- -->

            <?php if (@$_REQUEST['created'] == 'yes') { ?>
                <div class="alert alert-success dark alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <i class="fa fa-info pr10"></i> Congrats! Course added successfully!
                </div>
            <?php } ?>

            <!-- -------------- Content -------------- -->
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="courseForm">
                <div class="mw1000 center-block" id="hidden_div" <?php if (@$_REQUEST['edit'] == '') { ?> style="display:none;" <?php } ?>>
                    <!-- -------------- Change Password -------------- -->
                    <div class="panel mb35">
                        <div class="panel-heading">
                            <span class="panel-title">Add Course</span>
                        </div>
                        <?php if (@$_REQUEST['created'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Course added successfully!
                            </div>
                        <?php } ?>
                        <?php if (@$_REQUEST['updated'] == 'yes') { ?>
                            <div class="alert alert-success dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <i class="fa fa-info pr10"></i> Congrats! Course updated successfully!
                            </div>
                        <?php } ?>

                        <div class="panel-body br-t">
                            <div class="allcp-form theme-primary">
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Category</label>
                                        <div class="col-sm-8 ph10">
                                            <label class="field select">
                                                <select name="course_category" class="gui-input" id="category-dropdown" required>
                                                    <option value="">Select Category...</option>
                                                    <?php $getCategory = mysqli_query($CONN, "SELECT * FROM `category` ORDER BY `cat_id` ASC");
                                                    while ($categoryArr = mysqli_fetch_array($getCategory)) { ?>
                                                        <option <?php if (@$courses['course_category'] == $categoryArr['cat_id']) { ?> selected <?php } ?> value="<?php echo @$categoryArr['cat_id']; ?>"><?php echo @$categoryArr['category']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i class="arrow double"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Cities</label>
                                        <div class="col-sm-8 ph10">
                                            <label class="field select">
                                                <select name="course_cities" class="gui-input" required>
                                                    <option value="">Select Category...</option>
                                                    <?php $getCities = mysqli_query($CONN, "SELECT * FROM `city` Where `status` = 'Y' ");
                                                    while ($cities = mysqli_fetch_array($getCities)) { ?>
                                                        <option <?php if (@$courses['course_cities'] == $cities['id']) { ?> selected <?php } ?> value="<?php echo @$cities['id']; ?>"><?php echo @$cities['city']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i class="arrow double"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="refund-policy" class="field-label col-sm-4 ph10">Course Name</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="course_name" class="gui-input" value="<?php echo @$courses['course_name'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="location" class="field-label col-sm-4 ph10">Course Duration</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="course_duration" class="gui-input" value="<?php echo @$courses['course_duration'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="mode" class="field-label col-sm-4 ph10">Course Time Slot</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="course_time_slot" class="gui-input" value="<?php echo @$courses['course_time_slot'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="pricing" class="field-label col-sm-4 ph10">Course Type</label>
                                        <div class="col-sm-8 ph10">
                                            <select class="gui-input" name="course_type" id="course_type">
                                                <option value="">Select</option>
                                                <option value="online" <?php if (@$courses['course_type'] == "online") { ?> selected <?php } ?>>Online</option>
                                                <option value="offline" <?php if (@$courses['course_type'] == "offline") { ?> selected <?php } ?>>Offline</option>
                                                <option value="Online And Offline" <?php if (@$courses['course_type'] == "Online And Offline") { ?> selected <?php } ?>>Online And Offline</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="phone" class="field-label col-sm-4 ph10">Course Location</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="tel" name="course_location" class="gui-input" value="<?php echo @$courses['course_location'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="email" class="field-label col-sm-4 ph10">Outline Of Course</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="text" name="course_outline" class="gui-input" value="<?php echo @$courses['course_outline'] ?>"></input>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="pricing" class="field-label col-sm-4 ph10">Upcoming Batches</label>
                                        <div class="col-sm-8 ph10">
                                            <select class="gui-input" name="upcoming_batches" id="upcoming_batches">
                                                <option value="online">Online</option>
                                                <option value="offline">Offline</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-12">
                                    <div class="section row mb25">
                                        <label for="mode" class="field-label col-sm-4 ph10">Requirements</label>
                                        <div class="col-sm-12 ph10">
                                            <textarea type="text" name="requirements" class="gui-input"><?php echo @$courses['requirements'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="section row mb25">
                                        <label for="mode" class="field-label col-sm-4 ph10">Course content</label>
                                        <div class="col-sm-12 ph10">
                                            <textarea type="text" name="course_content" class="gui-input"><?php echo @$courses['course_content'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="container duration-container mt-5">
                                    <div class="row mb25" id="add_new_topics">
                                        <?php 
                                            $topic_data = isset($courses['course_topic_details']) ? $courses['course_topic_details'] : '';
                                            $topic_data_array = json_decode($topic_data, true); // Decode JSON string into PHP array
                                            ?>
                                            <?php if (!empty($topic_data_array) && is_array($topic_data_array)) : ?>
                                                <?php foreach ($topic_data_array as $index => $topic) : ?>
                                                    <div class="col-md-4 name-sec">
                                                        <label for="mode" class="field-label">Name</label>
                                                        <div class="ph10">
                                                            <input type="text" name="course_topic_name[]" class="gui-input" value="<?php echo htmlspecialchars($topic['name']); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 name-sec">
                                                        <label for="pdf_upload" class="field-label">PDF Only</label>
                                                        <div class="ph10">
                                                            <?php if (!empty($topic['pdf'])) : ?>
                                                                <!--<a href="../upload/course/<?php echo htmlspecialchars($topic['pdf']); ?>" target="_blank"><?php echo htmlspecialchars($topic['pdf']); ?></a>-->
                                                                <input type="hidden" name="old_pdf[]" value="<?php echo htmlspecialchars($topic['pdf']); ?>">
                                                            <?php endif; ?>
                                                            <input class="form-control" name="course_topic_pdf[]" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="section row mb25 name-sec">
                                                            <label for="mode" class="field-label ph10">Duration</label>
                                                            <div class="ph10">
                                                                <input type="text" name="course_topic_duration[]" class="gui-input" value="<?php echo htmlspecialchars($topic['duration']); ?>">
                                                            </div>
                                                            <div class="ph10">
                                                                <button type="button" class="btn btn-danger remove_topic_btn">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <div class="col-md-4 name-sec">
                                                <label for="mode" class="field-label">Name</label>
                                                <div class=" ph10">
                                                    <input type="text" name="course_topic_name[]" class="gui-input" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4 name-sec">
                                                <label for="pdf_upload" class="field-label">PDF Only</label>
                                                <div class="ph10">
                                                    <input type="file" name="course_topic_pdf[]" class="gui-input" accept="application/pdf">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="section row mb25 name-sec">
                                                    <label for="mode" class="field-label ph10">Duration</label>
                                                    <div class="ph10">
                                                        <input type="text" name="course_topic_duration[]" class="gui-input" value="">
                                                    </div>
                                                    <div class="ph10">
                                                        <button type="button" class="btn btn-primary" id="add_topic_btn">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="image" class="field-label col-sm-4 ph10">Video Thumbnail</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="video_thumbnail" class="gui-input" >
                                            <?php if (@$courses['video_thumbnail'] != '') { ?>
                                                <img src="../upload/course/<?php echo @$courses['video_thumbnail']; ?>" height="100px" alt="" />
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="video" class="field-label col-sm-4 ph10">Course Video</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="course_video" class="gui-input">
                                            <?php if (@$courses['course_video'] != '') { ?>
                                                <video controls style="width: 228px; height: 150px;">
                                                    <source src="../upload/course/<?php echo @$courses['course_video']; ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="image" class="field-label col-sm-4 ph10">Course Image</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="course_image" class="gui-input" >
                                            <?php if (@$courses['course_image'] != '') { ?>
                                                <img src="../upload/course/<?php echo @$courses['course_image']; ?>" height="100px" alt="" />
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="section row mb25">
                                        <label for="image" class="field-label col-sm-4 ph10">Training Plan (Only PDF Allowed)</label>
                                        <div class="col-sm-8 ph10">
                                            <input type="file" name="training_plan" class="gui-input" accept="application/pdf">
                                            <?php if (@$courses['training_plan'] != '') { ?>
                                                <a href="../upload/course/<?php echo @$courses['training_plan']; ?>">Download PDF</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="padding-right:23px;"><input type="submit" name="submit" class="btn btn-bordered btn-primary pull-right" value="<?php if (@$_REQUEST['edit'] != '') { ?>UPDATE<?php } else { ?>ADD<?php } ?> Course"></div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- -------------- /Content -------------- -->

            <!-- -------------- Content -------------- -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- -------------- Column Center -------------- -->
                <div class="chute chute-center" style="padding-top:0px;">

                    <!-- -------------- Products Status Table -------------- -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title ">Manage Course</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="table-responsive responsive_table_area">
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="">Sl. No.</th>
                                                    <th class="">Course Name</th>
                                                    <th class="">Course Duration</th>
                                                    <th class="">Course Location</th>
                                                    <th class="">Course Type</th>
                                                    <th class="">Status</th>
                                                    <?php if ($_SESSION['AdminID'] == '1') { ?><th class="text-right">Options</th><?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sl = 0;
                                                if (@$_REQUEST['search'] == '') {
                                                    $result = mysqli_query($CONN, "SELECT * FROM `course_details`");
                                                }
                                                if (@$_REQUEST['search'] != '') {
                                                    $result = mysqli_query($CONN, "SELECT * FROM `course_details` WHERE `course_name` LIKE '%" . $_REQUEST['search'] . "%'");
                                                }

                                                while ($getValue = mysqli_fetch_array($result)) {
                                                    $sl++;
                                                ?>
                                                    <tr class="order_item">
                                                        <td><?php echo $sl; ?></td>
                                                        <td data-title="Name"><?php echo $getValue['course_name']; ?></td>
                                                        <td data-title="duration"><?php echo $getValue['course_duration']; ?></td>
                                                        <td data-title="Location"><?php echo $getValue['course_location']; ?></td>
                                                        <td data-title="type"><?php echo $getValue['course_type']; ?></td>
                                                        <td class="" data-title="Status"><?php if ($getValue['status'] == 'Y') { ?><span class="label label-success">Active</span><?php } ?><?php if ($getValue['status'] == 'N') { ?><span class="label label-danger">Inactive</span></span><?php } ?></td>
                                                        <?php if ($_SESSION['AdminID'] == '1') { ?><td class="text-right" data-title="Options">
                                                                <div class="btn-group text-right">
                                                                    <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                                        <span class="caret ml5"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><a href="manage_course?edit=<?php echo $getValue['id']; ?>">Edit</a></li>
                                                                        <li><a href="manage_course?DelId=<?php echo $getValue['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td><?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div><? ?></div>
                </div>
            </section>
        </section>
    </div>
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

    <!--<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>-->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                "lengthMenu": [10, 25, 50, 75, 100],
                "pageLength": 50,
                buttons: [
                    'csv', 'excel', 'print'
                ]
            });
        });
    </script>
    <!-- -------------- /Scripts -------------- -->
    <script>
        function addInput() {
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'whats_included[]';
            newInput.className = 'gui-input';

            document.getElementById('inputContainer').appendChild(newInput);

            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Remove';
            removeButton.onclick = function() {
                document.getElementById('inputContainer').removeChild(newInput);
                document.getElementById('inputContainer').removeChild(removeButton);
            };

            document.getElementById('inputContainer').appendChild(removeButton);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#add_topic_btn').click(function() {
                var newTopic = `
        <div class="col-md-4 name-sec">
                                                <label for="mode" class="field-label">Name</label>
                                                <div class=" ph10">
                                                    <input type="text" name="course_topic_name[]" class="gui-input" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4 name-sec">
                                                <label for="pdf_upload" class="field-label">Upload PDF</label>
                                                <div class="ph10">
                                                    <input type="file" name="course_topic_pdf[]" class="gui-input" accept="application/pdf">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="section row mb25 name-sec">
                                                    <label for="mode" class="field-label ph10">Duration</label>
                                                    <div class="ph10">
                                                        <input type="text" name="course_topic_duration[]" class="gui-input" value="">
                                                    </div>
                                                    <div class="ph10">
                                                            <button type="button" class="btn btn-danger remove_topic_btn">Remove</button>
                                                        </div>
                                                </div>
                                            </div>`;

                $('#add_new_topics').append(newTopic);
            });

            $(document).on('click', '.remove_topic_btn', function() {
                $(this).closest('.topic-row').remove();
            });
        });
    </script>
    
     <script>
        // $(document).ready(function() {
        //     $('#courseForm').on('submit', function(e) {
        //         let isValid = true;
        //         $('input[type="file"]').each(function() {
        //             if (this.files.length > 0) {
        //                 const fileType = this.files[0].type;
        //                 if (fileType !== 'application/pdf') {
        //                     isValid = false;
        //                     alert('Only PDF files are accepted.');
        //                 }
        //             }
        //         });
        //         if (!isValid) {
        //             e.preventDefault();
        //         }
        //     });
        // });
    </script>
</body>

</html>