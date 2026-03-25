<?php include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$review_rating = $_POST['review_rating'];
	$reviewer_name = $_POST['reviewer_name'];
	$reviewer_email = $_POST['reviewer_email'];
	$reviewer_review = $_POST['reviewer_review'];
	$fk_trainer_id = $_POST['fk_user_id'];

	$sql = "INSERT INTO trainer_review (rating, name, email, review, fk_trainer_id) 
            VALUES ('$review_rating', '$reviewer_name', '$reviewer_email', '$reviewer_review', '$fk_trainer_id')";

	if (mysqli_query($CONN, $sql)) {
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
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
		<section class="innerPageBannerSec" data-background="<?php echo $baseURL ?>images/bg/innerPages-bg1.jpg">
			<div class="container">
				<div class="innerPageBannerSecinner">
					<div class="row">
						<div class="col-md-12">
							<div class="innerPageBannerWrapper">
								<h1 class="title">Tainer Listing</h1>
								<ol class="breadcrumb innerPageBannerBreadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">Tainer Listing</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php if (@$_REQUEST['created_query'] == 'yes') { ?>
			<div class="alert alert-success dark alert-dismissable">
				Thank you for your enquiry! We will get back to you shortly.
			</div>
		<?php } ?>
		<section class="pt-80 pb-50 trainerListingSec" style="">
			<div class="container">
				<div class="trainerListingSecinner">
					<?php
					$user_result = mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `status` = 'Y'" . (isset($_SESSION['city_id']) ? " AND `city` = '" . mysqli_real_escape_string($CONN, $_SESSION['city_id']) . "'" : ""));
                    
					if ($user_result && $user_result->num_rows > 0) {
						while ($getValue = mysqli_fetch_array($user_result)) {
					?>
							<div class="mb-30 trainerListingItem">
								<div class="trainerListingIteminner">
									<div class="row rowBox">
										<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 columnBox trainerThumnailBox mb-30">
											<div class="trainerThumnail" style="cursor:pointer;" onClick="window.location='<?=$baseURL?>trainer-details.php?id=<?=$getValue['id']?>'">
												<img data-src="<?php echo $baseURL ?>upload/profile/<?php echo @$getValue['user_image']; ?>" class="img-fluid lazyload" alt="">
											</div>
											<!-- <div class="ratingArea">
											<span class="overall">4.0</span>
											<span class="fa-regular fa-star star"></span>
											<span class="fa-regular fa-star star"></span>
											<span class="fa-regular fa-star star"></span>
											<span class="fa-regular fa-star star"></span>
											<span class="fa-regular fa-star star"></span>
											<span class="total">(1,100)</span>
										</div> -->
										</div>
										<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 columnBox trainerDetailsBox">
											<div class="trainerDetails">
												<?php
												$user_id = $getValue['id'];
												$courseReviews = mysqli_query($CONN, "SELECT * FROM `trainer_review` WHERE `fk_trainer_id`= $user_id");

												// Calculate the average rating
											    $totalReviews = mysqli_num_rows($courseReviews);
                                                $totalRating = 0;
                                                
                                                while ($row = mysqli_fetch_assoc($courseReviews)) {
                                                    $totalRating += $row['rating'];
                                                }
                                                
                                                if ($totalReviews > 0) {
                                                    $averageRating = $totalRating / $totalReviews;
                                                } else {
                                                    $averageRating = 0;
                                                }
                                                												
											    if (!function_exists('ratingToStars')) {
                                                    function ratingToStars($rating)
                                                    {
                                                        $fullStars = floor($rating);
                                                        $halfStars = ceil($rating - $fullStars);
                                                        $emptyStars = 5 - ($fullStars + $halfStars);
                                                
                                                        $stars = "";
                                                
                                                        for ($i = 0; $i < $fullStars; $i++) {
                                                            $stars .= '<span class="fa-solid fa-star star"></span>';
                                                        }
                                                
                                                        if ($halfStars > 0) {
                                                            $stars .= '<span class="fa-solid fa-star-half-alt star"></span>';
                                                        }
                                                
                                                        for ($i = 0; $i < $emptyStars; $i++) {
                                                            $stars .= '<span class="fa-regular fa-star star"></span>';
                                                        }
                                                
                                                        return $stars;
                                                    }
                                                }
                                                ?>
                                                <div class="d-flex justify-content-between trainerDetailsTopArea">
                                                    <h2 class="title" style="cursor:pointer;" onClick="window.location='<?=$baseURL?>trainer-details.php?id=<?=$getValue['id']?>'"><?=$getValue['fullname']?></h2>
                                                    <div class="ratingArea">
                                                        <span class="overall"><?= number_format($averageRating, 1) ?></span>
                                                        <?= ratingToStars($averageRating) ?>
                                                        <span class="total">(<?= $totalReviews ?>)</span>
                                                        </br>Review Comments
                                                    </div>
                                                </div>

												<div class="address"><span class="ttl">Address :</span> <span class="txt"><?php echo $getValue['fullname'] ?></span></div>
												<ul class="trainerDetailsList">
													<!-- <li><span class="ttl">Trainer availblity for the Month :</span> <span class="txt"> <?php echo $getValue['fullname'] ?></span> </li> -->
													<!--<li><span class="ttl">Email ID :</span> <span class="txt"><?php echo $getValue['email'] ?></span></li>-->
													<!--<li><span class="ttl">Phone No :</span> <span class="txt"><?php echo $getValue['phone'] ?></span></li>-->
													<li><span class="ttl">Pricing :</span> <span class="txt">₹<?php echo $getValue['pricing'] ?>/hrs</span></li>
													<li><span class="ttl">Mode of the training :</span> <span class="txt"><?php echo $getValue['training_mode'] ?></span></li>
													<li><span class="ttl">Year of experince :</span> <span class="txt"><?php echo $getValue['experience'] ?> Years</span></li>
													<li><span class="ttl">No of train Batches :</span> <span class="txt"><?php echo $getValue['train_batches'] ?></span></li>
													<li><span class="ttl">Education :</span> <span class="txt"><?php echo $getValue['education'] ?></span></li>
													<li><span class="ttl">Type of training he/she conduct :</span> <span class="txt"><?php echo $getValue['training_type'] ?></li>
													
													<li><span class="ttl">CV -on request :</span> <span class="txt"></span></li>
												</ul>
											    <input class="form-control addReviewTrainer" type="hidden" id="trainer_id" value="<?php echo $getValue['id'] ?>" name="trainer_id">
                                                <div class="addratingBtnArea" style="padding-bottom:15px;">
                                                    <a href="#" class="explore-button addratingBtn" data-bs-toggle="modal" data-bs-target="#addReviewModal" id="addReviewTrainer">Add Review</a>
                                                </div>
											</div>
											<div class="modal addReviewModal" id="addReviewModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="leftPart">
                                                                <h4 class="modal-title">Add a Review</h4>
                                                                <p class="comment-notes mb-0">Your email address will not be published. Required fields are marked <span>*</span></p>
                                                            </div>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body" style="">
                                                            <div class="modal-courses-reviews">
                                                                <div class="review-form-wrapper">
                                                                    <form method="post">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <div class="rating">
                                                                                    <input type="radio" id="star5" name="review_rating" value="5" required>
                                                                                    <label for="star5"></label>
                                                                                    <input type="radio" id="star4" name="review_rating" value="4" required>
                                                                                    <label for="star4"></label>
                                                                                    <input type="radio" id="star3" name="review_rating" value="3" required>
                                                                                    <label for="star3"></label>
                                                                                    <input type="radio" id="star2" name="review_rating" value="2" required>
                                                                                    <label for="star2"></label>
                                                                                    <input type="radio" id="star1" name="review_rating" value="1" required>
                                                                                    <label for="star1"></label>
                                                                                </div>
                                                                            </div>
                                                                            <input class="form-control modal_trainer_id" type="hidden" value="" name="fk_user_id">
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
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="mb-30 trainerListingItem">
							<div class="trainerListingIteminner">
								<div>No Trainers found for this city</div>
							</div>
						</div>
					<?php } ?>
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
	<script src="<?php echo $baseURL ?>js/sal.min.js"></script>
	<script src="<?php echo $baseURL ?>js/tilt.js"></script>
	<script src="<?php echo $baseURL ?>js/custom.js"></script>
	<!-- .........script ended............. -->
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
           $(document).ready(function() {
            $(document).on('click', '.addratingBtn', function (e) {
                e.preventDefault();
                var trainerId = $(this).closest('.trainerListingItem').find('.addReviewTrainer').val();
                console.log(trainerId);
                $('.modal_trainer_id').val(trainerId);
            });
        });

    </script>
</body>

</html>