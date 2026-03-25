<?php include('includes/config.php'); $session_city_id = @$_SESSION['city_id']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Trainer book">
    <meta name="keywords" content="Hire trainer, Classroom training, Safety trainer, Corporate trainer, Soft skills trainer, Customer service trainer, Soft skill trainer, SIX sigma trainers, Behavioural trainer, Leadership trainer, IT trainer, ITIL trainer, AI & chat GPT trainer, POSH trainer, Diversity, Equity, and Inclusion trainer, Sales trainer, Customer service trainer, V&A Trainer Voice & accent trainer, Soft Skills & Corporate Training Company in Pune, Customer handling skills training, Corporate training companies in Pune, Corporate training companies in Mumbai, Corporate training companies in Navi Mumbai, Corporate Training Solution, Customer experience optimisation training, Soft Skills Training Program, Leadership training, Team building activities, Team building training, Soft Skill Trainer, Facilitation training plan, Corporate Training, Safety training, ITIL Training, Time management training plan, Communication skills training, Process training, Written communication training, Employee training & development plan, Project management training plan, Train the trainer, Leadership Training Plan, Quality training, Lean training, SIX sigma training, 5S Training plan, Cybersecurity Awareness Training Plan for Employees, Credit Analysis Training Plan, Out of box thinking training plan, AI awareness training, 'AI awareness training for Employee, Cyber security training, Cyber security course in pune, Training need analysis, Training need identification, Customized training plan for employees, Diversity Equity and Inclusion Training Plan, PoSH Training, Prevention of Sexual Harassment Training Program, 
We are training partner to train your employee for better productivity & quality, General insurance training, Life insurance training, Sales training" />
    <meta name="description" content="We are training partner to train your employee for better productivity & quality, Looking for expert corporate training solutions in Pune, Mumbai, or Navi Mumbai? We offer customized employee development programs including soft skills, leadership, IT, AI, PoSH, DEI, Six Sigma, safety, cybersecurity, and more to boost productivity, quality, and team performance." />
    <link rel="canonical" href="<?php echo $baseURL . basename($_SERVER["REQUEST_URI"]); ?>" />
  
    <title>Trainer Book</title>
    <link rel='shortcut icon' href='images/favicon.png' type='image/x-icon'>
    <!-- owl carousel Slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- Fancy Box Css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- REMOVED: duplicate FA v4, keeping v6 -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?php echo $baseURL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $baseURL ?>css/rs-spacing.css">
    <link rel="stylesheet" href="<?php echo $baseURL ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $baseURL ?>css/responsive.css">
</head>

<body class="">
    <?php include('includes/header.php'); ?>
    <main class="">
        <section class="hpmePageBannerSec" data-background="images/bg/home-bg1.jpg">
            <a href="<?php echo $baseURL ?>page.php/offer-zone"> <span class="offerBannerArea"><img data-src="images/special offer.avif" class="img-fluid lazyload" alt=""></span></a>
            <div class="container">
                <div class="homePageBannerSecinner">
                    <div class="homePageBannerWrapper">
                        <h3 class="title"><span></span>Smart Training Solutions for Smarter Teams – Connect with Verified Corporate Trainers Today.</h3>
                        <p class="para">Find Certified Industry Trainers for Employee Development and Skill Enhancement.
                        </p>
                        <div class="homePageBannerSearchArea">
                            <form id="searchForm" method="post" action="<?php echo $baseURL ?>course-list.php">
                                <div class="d-flex homePageBannerSearchAreainner">
                                    <input type="text" name="search_value" id="searchValue" class="form-control searchInput" placeholder="What do you want to learn today?">
                                    <button type="submit" class="btn btn-primary searchBtn"><i class="fa-solid fa-magnifying-glass"></i>
                                        <span class="txt">Search Now</span></button>
                                </div>
                            </form>
                        </div>
                        <p class="para"><br>Workforce Upskilling Made Easy – Hire Industry-Trained Corporate Trainers Today.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-80 pb-80 upcomingBatchSec">
            <div class="container">
                <div class="headingSec text-center mb-40">
                    <h2 class="secTitle"><span>Trainer </span> List</h2>
                </div>
            </div>
            <div class="container">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- CHANGED: removed text-nowrap for mobile readability -->
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr class="text-muted fw-semibold">
                                        <th scope="col" class="">Name</th>
                                        <th scope="col">Education</th>
                                        <th scope="col">Type of training</th>
                                        <th scope="col">Year of experince</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Pricing</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    <?php

                                    /* ORIGINAL: $result_value2 = mysqli_query($CONN, "SELECT * FROM `user_register` ..."); */
                                    $result_value2 = mysqli_query($CONN, "SELECT `fullname`, `education`, `experience`, `pricing`, `training_type`, `city` FROM `user_register` WHERE `status` = 'Y'" . (isset($_SESSION['city_id']) ? " AND `city` = '" . mysqli_real_escape_string($CONN, $_SESSION['city_id']) . "'" : ""));
                                    if ($result_value2 && $result_value2->num_rows > 0) {
                                        while ($getValue = mysqli_fetch_array($result_value2)) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <p class="mb-0 text-muted"><?php echo $getValue['fullname'] ?></p>
                                                </td>
                                                <td>
                                                    <h6 class="fw-semibold mb-0"><?php echo $getValue['education'] ?></h6>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-muted"><?php echo $getValue['training_type'] ?></p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-muted"><?php echo $getValue['experience'] ?></p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-muted">Pune</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 text-muted">₹ <?php echo $getValue['pricing'] ?></p>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    <?php } else { ?>
                                        <tr>
                                            <td>
                                                <p class="mb-0 text-muted">No Data Found</p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-80 pb-50 certificationSec" style="">
            <div class="container">
                <div class="headingSec text-center mb-40">
                    <h2 class="secTitle"><span>Our </span> Certification</h2>
                </div>
            </div>
            <div class="container">
                <div class="certificationSecinner">
                    <div class="row rowBox">
                        <?php
                        /* ORIGINAL: $result = mysqli_query($CONN, "SELECT * FROM `certification`"); */
                        $result = mysqli_query($CONN, "SELECT `title`, `image` FROM `certification`");
                        while ($getValue = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 columnBox certificationBox mb-30">
                                <div class="certificationBoxinner">
                                    <div class="thumnail">
                                        <img data-src="<?php echo $baseURL ?>upload/certification/<?php echo @$getValue['image']; ?>" class="img-fluid lazyload" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="title mb-0"><?= $getValue['title'] ?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php }  ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-80 pb-0 ourGallerySec" style="">
            <div class="container">
                <div class="headingSec text-center mb-40">
                    <h2 class="secTitle"><span>Our </span> Gallery</h2>
                </div>
            </div>
            <div class="container">
                <div class="ourGallerySecinner">
                    <div class="row rowBox">
                        <?php
                        /* ORIGINAL: $gallery_result = mysqli_query($CONN, "SELECT * FROM `gallery`"); */
                        $gallery_result = mysqli_query($CONN, "SELECT `image`, `video`, `video_thumbnail` FROM `gallery`");
                        while ($getValue = mysqli_fetch_array($gallery_result)) {
                            if (!empty($getValue['video'])) {
                        ?>

                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 columnBox ourGalleryBox mb-30">
                                    <div class="ourGalleryBoxinner">
                                        <div class="ourGalleryBoxThumnail">
                                            <a href="<?php echo $baseURL ?>upload/gallery/<?php echo $getValue['video']; ?>" data-fancybox="gallery">
                                                <img src="<?php echo $baseURL ?>upload/gallery/<?php echo $getValue['video_thumbnail']; ?>" class="img-fluid lazyload" alt="Video Testimonial">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 columnBox ourGalleryBox mb-30">
                                    <div class="ourGalleryBoxinner">
                                        <div class="ourGalleryBoxThumnail">
                                            <a href="<?php echo $baseURL ?>upload/gallery/<?php echo @$getValue['image']; ?>" data-fancybox="gallery">
                                                <img data-src="<?php echo $baseURL ?>upload/gallery/<?php echo @$getValue['image']; ?>" class="img-fluid lazyload" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-50 pb-80 dataTableSec">
            <div class="container">
                <div class="headingSec text-center mb-40">
                    <h2 class="secTitle"><span>Batch </span> Status</h2>
                </div>
            </div>
            <div class="container">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- CHANGED: removed text-nowrap for mobile readability -->
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr class="text-muted fw-semibold">
                                        <th scope="col" class="">Date</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Feees</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    <?php 
                                    /* ORIGINAL: N+1 query - 1 query per schedule row
                                    $result = mysqli_query($CONN, "SELECT * FROM `trainer_schedule`");
                                    while ($getValue = mysqli_fetch_array($result)) {
                                        $trainer_id = $getValue['trainer_name'];
                                        $query_val = "SELECT `fullname` FROM `user_register` WHERE `id` = '$trainer_id'";
                                        $result2 = mysqli_query($CONN, $query_val);
                                        $trainer_name = mysqli_fetch_array($result2);
                                    */
                                    $result = mysqli_query($CONN, "SELECT ts.date, ts.course, ts.duration, ts.fees, ts.trainer_name, ur.fullname FROM `trainer_schedule` ts LEFT JOIN `user_register` ur ON ur.id = ts.trainer_name");
                                    while ($getValue = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <p class="mb-0 text-muted"><?php echo (new DateTime($getValue['date']))->format('jS F Y'); ?></p>
                                            </td>
                                            <td>
                                                <h6 class="fw-semibold mb-0"><?php /* ORIGINAL: @$trainer_name["fullname"] */ echo @$getValue["fullname"] ?></h6>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-muted"><?php echo @$getValue['course'] ?></p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-muted"><?php echo @$getValue['duration'] ?></p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-muted">Pune</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-muted">₹ <?php echo @$getValue['fees'] ?></p>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="" style="">
            <div class="container">
                <div class="">
                </div>
            </div>
        </section>
    </main>
    <?php include('includes/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
    <script src="<?php echo $baseURL ?>js/sal.min.js"></script>
    <script src="<?php echo $baseURL ?>js/tilt.js"></script>
    <script src="<?php echo $baseURL ?>js/custom.js"></script>

    <script>
        $(document).ready(function() {
            $('#citySelect').change(function() {
                var cityId = $(this).val();
                $.ajax({
                    url: 'save_city_session.php',
                    method: 'POST',
                    data: {
                        cityId: cityId
                    },
                    success: function(response) {
                        window.location.reload();
                        console.log('City ID saved in session successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving city ID: ' + error);
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            var searchValue = document.getElementById('searchValue').value.trim();
            if (searchValue !== '') {
                window.location.href = 'https://trainerbook.in/course-list.php?text=' + encodeURIComponent(searchValue);
            } else {
                alert('Please enter something to search.');
            }
        });
    </script>
</body>

</html>