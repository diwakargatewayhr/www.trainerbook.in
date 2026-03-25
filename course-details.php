<?php include('includes/config.php');

$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

$parsed_url = parse_url($url);

if (isset($parsed_url['path'])) {
	$path = $parsed_url['path'];

	$path_parts = explode('/', $path);

	$course_slug = end($path_parts);
} else {
	echo "Invalid URL";
}

$result = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `course_details` WHERE `status` = 'Y' AND `course_slug`= '$course_slug'"));

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_query'])) {


	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$review = $_POST['review'];
	$fk_course_id = $result['id'];

	$name = mysqli_real_escape_string($CONN, $name);
	$email = mysqli_real_escape_string($CONN, $email);
	$phone = mysqli_real_escape_string($CONN, $phone);
	$review = mysqli_real_escape_string($CONN, $review);
	$fk_course_id = mysqli_real_escape_string($CONN, $fk_course_id);

	$query = "INSERT INTO enquiry_data (name, email, phone, review, fk_course_id)
              VALUES ('$name', '$email', '$phone', '$review', $fk_course_id)";

	if (mysqli_query($CONN, $query)) {
		// Success message
		header("location:".$baseURL."course-details.php/$course_slug?created=yes");
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($CONN);
	}
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review_submit'])) {

	$total_rating = 0;

	if (isset($_POST['review_rating'])) {
		$total_rating = intval($_POST['review_rating']);
	}
	$fk_course_id = $result['id'];
	$name = $_POST['reviewer_name'];
	$email = $_POST['reviewer_email'];
	$review = $_POST['reviewer_review'];

	$total_rating = mysqli_real_escape_string($CONN, $total_rating);
	$name = mysqli_real_escape_string($CONN, $name);
	$email = mysqli_real_escape_string($CONN, $email);
	$review = mysqli_real_escape_string($CONN, $review);

	$query = "INSERT INTO review (rating, name, email, review,fk_course_id)
            VALUES ('$total_rating', '$name', '$email', '$review','$fk_course_id')";

	if (mysqli_query($CONN, $query)) {
		header("location:".$baseURL."course-details.php/$course_slug?created_query=yes");
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($CONN);
	}

	mysqli_close($CONN);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Trainer Book</title>
	<link rel='shortcut icon' href='<?php echo $baseURL ?>images/favicon.png' type='image/x-icon'>
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
	
	<style>
        .custom-button {
            background-color: #12c5ed; /* Green background */
            border: none; /* Remove border */
            color: white; /* White text */
            padding: 15px 32px; /* Some padding */
            text-align: center; /* Centered text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Get it to line up properly */
            font-size: 16px; /* Increase font size */
            margin: 4px 2px; /* Some margin */
            cursor: pointer; /* Pointer/hand icon */
            border-radius: 8px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        .custom-button:hover {
            background-color: #12c5ed; /* Darker green on hover */
        }
        .ourTrainerBox {
            width: 100% !important;
            height: 100%;
            padding: 0 15px;
        }
        
        .ourTrainerThumnail img {
              height: 250px !important;
            object-fit: cover !important;
        }
    </style>
	
</head>

<body class="">
	<?php include('includes/header.php'); ?>
	<main class="">
		<section class="singleCourseBannerSec" data-background="<?php echo $baseURL ?>images/bg/innerPages-bg2.jpg">
			<div class="container">
				<div class="singleCourseBannerSecinner">
					<div class="row rowBox">
						<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 columnBox singleCourseBannerContentBox">
							<div class="singleCourseBannerContent">
								<div class="ratingArea">
									<span class="overall">4.0</span>
									<span class="fa-regular fa-star star"></span>
									<span class="fa-regular fa-star star"></span>
									<span class="fa-regular fa-star star"></span>
									<span class="fa-regular fa-star star"></span>
									<span class="fa-regular fa-star star"></span>
									<span class="total">(1,100)</span>
								</div>
								<h2 class="title"><?php echo $result['course_name'] ?></h2>
								<p class="duration"><strong>Duration :</strong> <?php echo $result['course_duration'] ?> </p>
								<p class=""><?php echo $result['course_outline'] ?> </p>
								<p class="location mb-0"><strong>Location :</strong> <?php echo $result['course_location'] ?> (<?php echo $result['course_type'] ?>)</p>
								<ul class="courses-meta">
									<!-- <li><span class="txt"><strong>Category :</strong> Category 1</span></li> -->
									<li><span class="txt"><strong>Students Enrolled :</strong> 541</span></li>
								</ul>
								<div class="enrollBtnArea">
									<a href="#" class="explore-button enrollBtn">Enroll Now</a>
								</div>
							</div>
						</div>
						<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 columnBox singleCourseBannerVideoBox">
							<div class="singleCourseBannerVideo">
								<img data-src="<?php echo $baseURL ?>upload/course/<?php echo $result['video_thumbnail']; ?>" class="img-fluid singleCourseBannerVideoThumnail lazyload" alt="image">
								<div class="content">
									<button type="button" class="popup-video" data-bs-toggle="modal" data-bs-target="#courseVideoModal"><i class="fa-solid fa-play"></i></button>
									<span class="text">Course Preview</span>
								</div>
							</div>
							<!-- Course Video Modal -->
							<div class="modal courseVideoModal" id="courseVideoModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa-regular fa-xmark"></i></button>
										<div class="courseVideo">
											<video width="100%" height="100%" controls autoplay loop muted playsinline>
												<source src="<?php echo $baseURL; ?>upload/course/<?php echo $result['course_video']; ?>" type="video/mp4">
											</video>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="pt-80 pb-80 singleCourseDetailsSec">
			<div class="container">
				<div class="singleCourseDetailsSecinner">
					<div class="row rowBox">
						<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 columnBox mb-30">
							<div class="">
								<div class="singleCourseDetailsTabNav">
									<ul class="nav nav-pills" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-bs-toggle="pill" href="#overview">Overview</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="pill" href="#curriculum">Curriculum</a>
										</li>
										<!-- <li class="nav-item">
											<a class="nav-link" data-bs-toggle="pill" href="#courses">Courses</a>
										</li> -->
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="pill" href="#reviews">Reviews</a>
										</li>
									</ul>
								</div>
								<div class="singleCourseDetailsTabContent">
									<div class="tab-content">
										<div id="overview" class="tab-pane active">
											<div class="courses-overview">
												<?php echo $result['requirements'] ?>
												<?php echo $result['course_content'] ?>

												<div class="trainerListtingoverviewArea">
													<h3>Trainers</h3>
													<div class="trainerListtingSliderArea">
														<div class="trainerListtingSlider owl-carousel">
															<?php $trainerList = mysqli_query($CONN, "SELECT * FROM `user_register` Where `status` = 'Y' ");
															while ($trainers = mysqli_fetch_array($trainerList)) { ?>
																<div class="ourTrainerBox" style="cursor:pointer;" onClick="window.location='<?php echo $baseURL ?>trainer-details.php?id=<?= $trainers['id'] ?>'">
																	<div class="ourTrainerBoxinner">
																		<div class="ourTrainerThumnail">
																			<img data-src="<?php echo $baseURL ?>upload/profile/<?= $trainers['user_image'] ?>" class="img-fluid lazyload" alt="">
																		</div>
																		<!-- <ul class="social">
																			<li><a href="#" class="fab fa-facebook"></a></li>
																			<li><a href="#" class="fab fa-instagram"></a></li>
																			<li><a href="#" class="fab fa-google-plus"></a></li>
																			<li><a href="#" class="fab fa-linkedin"></a></li>
																			<li><a href="#" class="fab fa-twitter"></a></li>
																		</ul> -->
																		<div class="ourTrainerContent">
																			<h3 class="title"><?= $trainers['fullname'] ?></h3>
																			<span class="post">Trainer</span>
																		</div>
																	</div>
																</div>
															<?php } ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div id="curriculum" class="tab-pane fade">
											<div class="courses-curriculum">
										<?php
                                                $courseData = $result['course_topic_details']; 
                                                $decodedData = json_decode($courseData, true);
                                                
                                                echo '<ul>';
                                                foreach ($decodedData as $data) {
                                                    $courseName = $data['name'];
                                                    $duration = $data['duration'];
                                                    $pdf = $data['pdf'];
                                                    
                                                    // Constructing the URL for Google Docs Viewer
                                                    $pdfUrl = $baseURL . '/upload/course/' . htmlspecialchars($pdf);
                                                    $pdfViewerUrl = 'https://docs.google.com/viewer?url=' . urlencode($pdfUrl) . '&embedded=true';
                                                
                                                    echo '<li>';
                                                    echo '<a class="d-flex justify-content-between align-items-center" href="' . $pdfViewerUrl . '" target="_blank">';
                                                    echo '<span class="courses-name">' . htmlspecialchars($courseName) . '</span>';
                                                    echo '<div class="courses-meta">';
                                                    echo '<span class="duration">' . htmlspecialchars($duration) . ' min</span>'; 
                                                    echo '</div>';
                                                    echo '</a>';
                                                    echo '</li>';
                                                }
                                                echo '</ul>';
                                                ?>
											</div>
										</div>
										<div id="courses" class="tab-pane fade">
											<div class="courses-listing">
												<div class="row rowBox2">
													<?php
													$courseList = mysqli_query($CONN, "SELECT * FROM `course_details` WHERE `status` = 'Y'");

													while ($row = mysqli_fetch_array($courseList)) {
														// Check if 'course_topic_details' key exists in the row
														if (isset($row['course_topic_details'])) {
															$courseData = $row['course_topic_details'];
															$courseId = $row['id'];
															$enquiryList = mysqli_query($CONN, "SELECT * FROM `enquiry_data` WHERE `fk_course_id`= $courseId");
															$totalStudents = mysqli_num_rows($enquiryList);

															$decodedData = json_decode($courseData, true);
															// Count the number of lessons
															$totalCount = count($decodedData);
														} else {
															// Handle the case where 'course_topic_details' key is not present
															$totalCount = 0;
															$totalStudents = 0;
														}
													?>
														<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 columnBox2 single-courses-box">
															<div class="single-courses-boxinner">
																<div class="courses-thumnail">
																	<a href="<?php echo $baseURL . 'course-details.php/' . $row['course_slug'] ?>"><img data-src="<?php echo $baseURL ?>upload/course/<?php echo $row['course_image']; ?>" class="img-fluid lazyload" alt=""></a>
																</div>
																<div class="courses-content">
																	<ul class="rbt-meta">
																		<li><i class="fa-regular fa-book"></i><?php echo $totalCount . ($totalCount === 1 ? ' Lesson' : ' Lessons') ?></li>
																		<li><i class="fa-regular fa-user-group"></i><?php echo $totalStudents . ($totalStudents === 1 ? ' Student' : ' Students') ?></li>
																	</ul>
																	<h3 class="title"><a href="<?php echo $baseURL . 'course-details.php/' . $row['course_slug'] ?>"><?php echo @$row['course_name'] ?></a></h3>
																	<!-- <div class="rating">
																		<div class="d-flex align-items center">
																			<span class="overall">5.0</span>
																			<div class="star">
																				<i class="fa-regular fa-star star"></i>
																				<i class="fa-regular fa-star star"></i>
																				<i class="fa-regular fa-star star"></i>
																				<i class="fa-regular fa-star star"></i>
																				<i class="fa-regular fa-star star"></i>
																			</div>
																			<span class="total">(1,600)</span>
																		</div>
																	</div> -->
																	<p class="mb-0">
																		<?php echo @$row['course_outline'] ?>
																	</p>
																</div>
															</div>
														</div>
													<?php } ?>

												</div>
											</div>
										</div>
										<div id="reviews" class="tab-pane fade">
											<div class="courses-reviews">
												<?php
												$course_id = $result['id']; 
                                                $courseReviews = mysqli_query($CONN, "SELECT * FROM `review` WHERE `fk_course_id` = '$course_id'");

												$totalReviews = mysqli_num_rows($courseReviews);
												function generateStars($rating)
												{
													$stars = '';
													for ($i = 1; $i <= 5; $i++) {
														if ($i <= $rating) {
															$stars .= '<i class="fa fa-star" aria-hidden="true"></i>'; // Full star
														} else {
															$stars .= '<i class="far fa-star star"></i>';
														}
													}
													return $stars;
												}
												?>
												<div class="mt-25 courses-review-comments">
													<h3><?php echo $totalReviews ?> Review<?php echo ($totalReviews != 1) ? 's' : ''; ?></h3><?php echo ($totalReviews > 0) ? 'Show review' . (($totalReviews > 1) ? 's' : '') : 'No reviews yet'; ?>
													<?php foreach ($courseReviews as $courseReview) : ?>
														<div class="user-review">
															<img data-src="<?php echo $baseURL ?>images/user.png ?>" class="img-fluid lazyload" alt="">
															<div class="review-rating">
																<div class="starArea">
																	<?php echo generateStars($courseReview['rating']); ?>
																</div>
															</div>
															<span class="d-block sub-comment"><?php echo $courseReview['name']; ?></span>
															<p class="mb-0"><?php echo $courseReview['review']; ?></p>
														</div>
													<?php endforeach; ?>
												</div>
												<div class="mt-25 review-form-wrapper">
													<h3>Add a review</h3>
													<p class="comment-notes">Your email address will not be published. Required fields are marked <span>*</span></p>

													<?php if (@$_REQUEST['created_query'] == 'yes') { ?>
														<div class="alert alert-success dark alert-dismissable">
															We've received your inquiry.
														</div>
													<?php } ?>

													<form method="post">
														<div class="row">
															<div class="col-lg-12 col-md-12">
																<div class="rating">
																	<input type="radio" id="star5" name="review_rating" value="5" required>
																	<label for="star5"></label>
																	<input type="radio" id="star4" name="review_rating" value="4">
																	<label for="star4"></label>
																	<input type="radio" id="star3" name="review_rating" value="3">
																	<label for="star3"></label>
																	<input type="radio" id="star2" name="review_rating" value="2">
																	<label for="star2"></label>
																	<input type="radio" id="star1" name="review_rating" value="1">
																	<label for="star1"></label>
																</div>
															</div>
															<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
																<div class="form-group">
																	<input type="text" name="reviewer_name" placeholder="Name *" class="form-control" required>
																</div>
															</div>
															<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
																<div class="form-group">
																	<input type="email" name="reviewer_email" placeholder="Email *" class="form-control" required>
																</div>
															</div>
															<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
																<div class="form-group">
																	<textarea placeholder="Your review" name="reviewer_review" cols="30" rows="6" class="form-control" required></textarea>
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<button type="submit" name="review_submit" class="explore-button commentSubmitBtn">Submit</button>
															</div>
														</div>
													</form>
												</div>
												<div class="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 columnBox">
							  <?php if (!empty($result) && isset($result['training_plan']) && $result['training_plan'] != '') { ?>
                                <div style="padding:0 0 15px 0; text-align:center;">
                                    <a href="https://docs.google.com/viewer?url=<?php echo $baseURL ?>/upload/course/<?= $result['training_plan'] ?>&embedded=true" target="_blank" class="custom-button" style="color:#FFF;">
                                        <i class="fa fa-file-text" aria-hidden="true"></i> View Training plan </a>
                                </div>
                              <?php } ?>
							<div class="singleCourseSidebar">
								<div class="singleCourseEnquiryArea">
									<h3>Course Enquiry</h3>
									<?php if (@$_REQUEST['created'] == 'yes') { ?>
										<div class="alert alert-success dark alert-dismissable">
											We've received your inquiry.
										</div>
									<?php } ?>
									<form method="post">
										<div class="row">
											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<input type="text" placeholder="Name *" name="name" class="form-control" required>
												</div>
											</div>
											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<input type="email" placeholder="Email *" name="email" class="form-control" required>
												</div>
											</div>
											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<input type="number" placeholder="Phone *" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" class="form-control" required>
												</div>
											</div>
											<!-- <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<select class="form-select">
														<option>Select Category*</option>
														<option>Category 1</option>
													</select>
												</div>
											</div> -->
											<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<textarea placeholder="Your review" name="review" cols="30" rows="6" class="form-control" required></textarea>
													<input type="hidden" name="slug" value="<?=$course_slug?>" />
												</div>
											</div>
											<div class="col-lg-12 col-md-12">
												<button type="submit" name="submit_query" class="explore-button commentSubmitBtn">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</main>

<?php include('includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<script src="<?php echo $baseURL ?>js/sal.min.js"></script>
<script src="<?php echo $baseURL ?>js/tilt.js"></script>
<script src="<?php echo $baseURL ?>js/custom.js"></script>

<script>
    function removeQueryParameter() {
    	var url = window.location.href;
    
    	url = url.replace('?created=yes', '');
    	url = url.replace('?created_query=yes', '');
    
    	history.replaceState(null, null, url);
    }
    window.onload = function() {
    	removeQueryParameter();
    };
</script>


</body>
</html>