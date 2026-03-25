<?php include('includes/config.php');

$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


$parsed_url = parse_url($url);
$path = $parsed_url['path'];


$segments = explode('/', $path);


$slug = end($segments);

if (isset($_GET['text'])) {
	$search_text = $_GET['text'];
}


$category_data = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `category` WHERE `status` = 'Y' "));

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Trainer Book</title>
	<link rel='shortcut icon' href='images/favicon.png' type='image/x-icon'>
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
		<section class="pt-80 pb-50 certificationSec" style="">
			<div class="container">
				<div class="headingSec text-center mb-40">
					<h2 class="secTitle"><span>Popular</span> Courses</h2>
				</div>
			</div>
			<div class="container">
				<div class="certificationSecinner">
					<div class="row rowBox">
						<?php
						$cat_id = $category_data['cat_id'];
						$session_city_id = isset($_SESSION['city_id']) ? $_SESSION['city_id'] : '';
						$courseList = mysqli_query($CONN, "SELECT * FROM `course_details` WHERE `status` = 'Y' " . (!empty($session_city_id) ? "AND `course_cities` = '$session_city_id' " : '') . (isset($_GET['text']) && !empty($_GET['text']) ? "AND `course_name` LIKE '%" . mysqli_real_escape_string($CONN, $_GET['text']) . "%'" : ''));


						if (mysqli_num_rows($courseList) > 0) {
							while ($getValue = mysqli_fetch_array($courseList)) {
						?>
								<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 columnBox certificationBox mb-30">
									<div class="certificationBoxinner">
										<div class="thumnail">
											<a href="<?php echo $baseURL . 'course-details.php/' . $getValue['course_slug'] ?>"><img data-src="<?php echo $baseURL ?>upload/course/<?php echo $getValue['course_image']; ?>" class="img-fluid lazyload" alt=""></a>
										</div>
										<div class="content">
											<h4 class="title mb-0"><a href="<?php echo $baseURL . 'course-details.php/' . $getValue['course_slug'] ?>"><?= $getValue['course_name'] ?></a></h4>
										</div>
									</div>
								</div>
							<?php
							}
						} else {
							?>
							<div class="col-12" style="text-align:center;">
								<p>No courses found.</p>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<section class="certificationSec" style="">
			<div class="container">
				<div class="headingSec text-center mb-40">
					<h2 class="secTitle">Trainers<span></span></h2>
				</div>
			</div>
			<div class="container">
				<div class="trainerListtingoverviewArea">
					<div class="trainerListtingSliderArea">
						<div class="trainerListtingSlider owl-carousel" style="padding-bottom:50px;">
							<?php $cat_id_val = $category_data['cat_id'];
							$trainerList = mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `status` = 'Y' AND `category` = $cat_id_val");
							// Check if there are trainers found
							if (mysqli_num_rows($trainerList) > 0) {
								while ($trainers = mysqli_fetch_array($trainerList)) { ?>
									<div class="ourTrainerBox">
										<div class="ourTrainerBoxinner">
											<div class="ourTrainerThumnail">
												<img data-src="<?php echo $baseURL ?>upload/profile/<?= $trainers['user_image'] ?>" class="img-fluid lazyload" alt="">
											</div>
											<div class="ourTrainerContent">
												<h3 class="title" style="color:#FFF;"><?= $trainers['fullname'] ?></h3>
												<span class="post">Trainer</span>
											</div>
										</div>
									</div>
							<?php }
							} else {
								// If no trainers found, display a message
								echo '<p>No trainers found.</p>';
							}
							?>
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
</body>

</html>