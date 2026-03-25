<footer class="footer">
	<div class="footer_top">
		<div class="container">
			<div class="row rowBox">
				<div class="col-xl-6 col-md-6 columnBox mb-20">
					<div class="mb-10 footerLogo">
						<img data-src="<?php echo $baseURL ?>images/logo.png" class="img-fluid lazyload" alt="">
					</div>
				</div>
				<div class="col-xl-6 col-md-6 columnBox mb-20">

					<div class="footerLinksArea">
						<ul class="footerLinks">
							<?php $result = mysqli_query($CONN, "SELECT * FROM `page_data` WHERE id IN (1, 3, 4);");
							while ($getValue = mysqli_fetch_array($result)) {
							?>
								<li><a href="<?php echo $baseURL . 'page.php/' . $getValue['page_slug'] ?>"><?= $getValue['page_title']; ?></a></li>
							<?php  } ?>
							<li><a href="<?php echo $baseURL . 'page.php/contact-us'?>">Contact Us</a></li>
							<li><a href="<?php echo $baseURL . 'page.php/sitemap'?>">Sitemap</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer_bottom">
		<div class="container">
			<div class="copyWriteArea">
				<p class="mb-0">Copyright © 2024 Trainer Book. All Rights Reserved.</p>
			</div>
		</div>
	</div>
</footer>