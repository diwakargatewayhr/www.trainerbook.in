<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-34BG9YCMHE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-34BG9YCMHE');
</script>
<style>
.social-fixed {
    position: fixed;
    bottom: 15px;
    right: 15px;
    z-index: 10000;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.social-fixed a {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
    text-decoration: none;
    transition: transform 0.3s;
}
.social-fixed a:hover {
    transform: scale(1.1);
}
.social-fixed .whatsapp { background: #25D366; }
.social-fixed .linkedin { background: #0077B5; }
.social-fixed .facebook { background: #1877F2; }
.social-fixed .google-biz { background: #4285F4; }
.social-fixed .instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
</style>
<div class="social-fixed">
    <a href="https://wa.me/917507898325?text=Hello%20TrainerBook%2C%20I%20would%20like%20to%20inquire%20about%20trainings%20or%20offers." target="_blank" class="whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
    <a href="https://www.linkedin.com/company/trainerbook/posts/?feedView=all" target="_blank" class="linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
    <a href="https://www.facebook.com/people/Trainerbook/61575741770714/" target="_blank" class="facebook"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="https://www.instagram.com/trainerbook.in/" target="_blank" class="instagram"><i class="fa-brands fa-instagram"></i></a>
    <a href="https://share.google/NTmD96ktbuQruIOLJ" target="_blank" class="google-biz"><i class="fa-brands fa-google"></i></a>
</div>
<div class="homeHeader">
	<header class="header">
		<div class="navigationArea">
			<div class="container">
				<div class="navigationAreainner">
					<nav class="navbar navbar-expand-xl">
						<a class="navbar-brand" href="<?php echo $baseURL ?>">
							<img class="img-fluid lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $baseURL ?>images/logo.png" alt="logo">
						</a>
						<div class="menu_overlay"></div>
						<div class="collapse navbar-collapse" id="mynavbar">
							<ul class="navbar-nav mx-auto1">

								<li class="nav-item">
									<a class="nav-link" href="<?php echo $baseURL ?>">Home</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo $baseURL ?>trainer-list.php">Trainer</a>
								</li>

								<?php $page_data_val = mysqli_query($CONN, "SELECT * FROM `page_data` WHERE id IN (1);");
								while ($getValue = mysqli_fetch_array($page_data_val)) {
								?>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo $baseURL . 'page.php/' . $getValue['page_slug'] ?>"><?= $getValue['page_title']; ?></a>
									</li>
								<?php } ?>
								<li class="nav-item">
									<a class="nav-link" href="#">Training Category</a>
									<ul class="sub-menu">
										<?php $getCategories = mysqli_query($CONN, "SELECT * FROM `category` Where `status` = 'Y' ");
										while ($categories = mysqli_fetch_array($getCategories)) { ?>
											<li><a href="<?php echo $baseURL ?>course-category.php/<?= $categories['category_slug'] ?>"><?= $categories['category'] ?></a></li>
										<?php } ?>
									</ul>
								</li>
								<?php $page_data2 = mysqli_query($CONN, "SELECT * FROM `page_data` WHERE id IN (2);");
								while ($getValue = mysqli_fetch_array($page_data2)) {
								?>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo $baseURL . 'page.php/' . $getValue['page_slug'] ?>"><?= $getValue['page_title']; ?></a>
									</li>
								<?php } ?>
								<li class="nav-item">
										<a class="nav-link" href="<?php echo $baseURL . 'page.php/contact-us'?>">Contact Us</a>
									</li>
							</ul>
						</div>
						<div class="rightSide">
							<select class="form-select stateDropdownSelect" id="citySelect">
								<?php
								$cityList = mysqli_query($CONN, "SELECT * FROM `city` WHERE `status` = 'Y'");
								while ($cities = mysqli_fetch_array($cityList)) {
								?>
									<option value="<?= $cities['id'] ?>" <?php if ($cities['id'] == @$_SESSION['city_id']) echo 'selected'; ?>><?= $cities['city'] ?></option>
								<?php } ?>
							</select>
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
								<i class="fas fa-bars"></i>
							</button>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
</div>