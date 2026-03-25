<?php
include('includes/config.php');

$currentURL = $_SERVER['REQUEST_URI'];
$parts = explode('/', $currentURL);
$page_slug = end($parts);

// Defaults
$page_title = "";
$page_description = "";

// reCAPTCHA keys
$siteKey = '6Lf7hL0qAAAAAPo5yiQ4iYqnLvDaSc1ePAgaTvvL';
$secretKey = '6Lf7hL0qAAAAAFY5Cez5Yjz9HuI-F-U3AidqcCfz';

// Contact form messages
$successMsg = "";
$errorMsg = "";

if ($page_slug == 'contact-us') {
    $page_title = "Contact Us";

    // Handle form submit
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
        $name     = htmlspecialchars(trim($_POST['name']));
        $email    = htmlspecialchars(trim($_POST['email']));
        $mobile   = htmlspecialchars(trim($_POST['mobile']));
        $message  = htmlspecialchars(trim($_POST['message']));
        $recaptcha = $_POST['g-recaptcha-response'];

        if (!empty($recaptcha)) {
            $verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptcha";
            $verifyResponse = file_get_contents($verifyURL);
            $responseData = json_decode($verifyResponse);

            if ($responseData->success) {
                $to = "diwakar.m@trainerbook.in";
                $subject = "New Contact Form Submission";
                $body = "Name: $name\nEmail: $email\nMobile: $mobile\nMessage:\n$message";
                $headers = "From: $email";

                if (mail($to, $subject, $body, $headers)) {
                    $successMsg = "Your message has been sent successfully!";
                     $_POST = [];
                } else {
                    $errorMsg = "Failed to send your message. Please try again.";
                }
            } else {
                $errorMsg = "reCAPTCHA verification failed. Please try again.";
            }
        } else {
            $errorMsg = "Please confirm you're not a robot.";
        }
    }

    ob_start();
    ?>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?php if ($successMsg): ?>
                <div class="alert alert-success"><?= $successMsg ?></div>
            <?php elseif ($errorMsg): ?>
                <div class="alert alert-danger"><?= $errorMsg ?></div>
            <?php endif; ?>

            <form method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    <div class="invalid-feedback">Please enter your name.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <div class="invalid-feedback">Please enter a valid email.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="text" class="form-control" name="mobile" required pattern="[0-9]{10}" value="<?= htmlspecialchars($_POST['mobile'] ?? '') ?>">
                    <div class="invalid-feedback">Please enter a 10-digit mobile number.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" name="message" rows="4" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    <div class="invalid-feedback">Please enter your message.</div>
                </div>
                <div class="mb-3">
                    <div class="g-recaptcha" data-sitekey="<?= $siteKey ?>"></div>
                </div>
                <button type="submit" name="submit_contact" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
    <?php
    $page_description = ob_get_clean();
} else {
    // Fetch page from database
    $query = "SELECT * FROM `page_data` WHERE `status` = 'Y' AND `page_slug`= '$page_slug'";
    $result = mysqli_query($CONN, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $page_data = mysqli_fetch_assoc($result);
        $page_title = $page_data['page_title'];
        $page_description = $page_data['page_description'];
    } else {
        $page_title = "Page Not Found";
        $page_description = "Sorry, the page you are looking for is not available.";
    }
}
?>
<?php 
if ($page_slug == 'sitemap') {
    $page_title = "Sitemap";
    ob_start();
?>    
<h1>Sitemap</h1>
<ul class="level-0">

<li class="lpage"><a href="https://trainerbook.in/" title="Trainer Book">Home</a></li>

<li class="lpage"><a href="https://trainerbook.in/page.php/about-us" title="About Us">About Us</a></li>
<li class="lpage"><a href="https://trainerbook.in/page.php/offer-zone" title="Offer Zone">Offer Zone</a></li>
<li class="lpage"><a href="https://trainerbook.in/page.php/contact-us" title="Contact Us">Contact Us</a></li>
<li class="lpage"><a href="https://trainerbook.in/page.php/it-trainings" title="IT Trainings">IT Trainings</a></li>
<li class="lpage last-page"><a href="https://trainerbook.in/page.php/corporate-trainings" title="Corporate Trainings">Corporate Trainings</a></li>


<li class="lpage last-page"><a href="https://trainerbook.in/trainer-list.php" title="Trainer Book">Trainer List</a></li>

<li class="lpage"><a href="https://trainerbook.in/course-category.php/communication-training" title="Trainer Book">Communication Training</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-category.php/behavioral-training" title="Trainer Book">Behavioral Training</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-category.php/itsoftware-traning" title="Trainer Book">IT software Traning</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-category.php/safety-traning" title="Trainer Book">Safety Traning</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-category.php/banking-traning" title="Trainer Book">Banking Traning</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-category.php/manufacturing-industry-traning" title="Trainer Book">Manufacturing Industry Traning</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-category.php/hr-traning" title="Trainer Book">HR- Traning</a></li>
<li class="lpage last-page"><a href="https://trainerbook.in/course-category.php/quality-traning-six-sigma" title="Trainer Book">Quality Traning Six Sigma</a></li>

<li class="lpage"><a href="https://trainerbook.in/course-details.php/communication-training" title="Trainer Book">Communication Training</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/corporate-customer-service-trainings" title="Trainer Book">Corporate Customer Service Trainings</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/effective-business-writing-skills" title="Trainer Book">Effective Business Writing Skills</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/leadership-training-plan" title="Trainer Book">Leadership Training Plank</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/cybersecurity-awareness-training-plan-for-employees" title="Trainer Book">Cybersecurity Awareness Training Plan for Employees</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/itil-foundation-course" title="Trainer Book">Itil Foundation Course</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/industrial-safety-training-plan" title="Trainer Book">Industrial Safety Training Plan</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/credit-analysis-training-plan" title="Trainer Book">Credit Analysis Training Plan</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/training-plan-5s-training-for-manufacturing" title="Trainer Book">Training Plan 5s Training for Manufacturing</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/posh-prevention-of-sexual-harassment-training-program" title="Trainer Book">Posh Prevention of Sexual Harassment Training Program</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/diversity-equity-and-inclusion-dei-training-plan" title="Trainer Book">Diversity Equity and Inclusion dei Training Plan</a></li>
<li class="lpage"><a href="https://trainerbook.in/course-details.php/training-needs-analysis-tna-training-needs-identification-tni" title="Trainer Book">Training Needs Analysis tna Training needs identification tni</a></li>
<li class="lpage last-page"><a href="https://trainerbook.in/course-details.php/lean-six-sigma-training-plan" title="Trainer Book">Lean Six Sigma Training Plan</a></li>

</ul>
<?php 
 $page_description = ob_get_clean();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel='shortcut icon' href='images/favicon.png' type='image/x-icon'>
    <meta name="author" content="Trainer book">
    <meta name="keywords" content="Hire trainer, Classroom training, Safety trainer, Corporate trainer, Soft skills trainer, Customer service trainer, Soft skill trainer, SIX sigma trainers, Behavioural trainer, Leadership trainer, IT trainer, ITIL trainer, AI & chat GPT trainer, POSH trainer, Diversity, Equity, and Inclusion trainer, Sales trainer, Customer service trainer, V&A Trainer Voice & accent trainer, Soft Skills & Corporate Training Company in Pune, Customer handling skills training, Corporate training companies in Pune, Corporate training companies in Mumbai, Corporate training companies in Navi Mumbai, Corporate Training Solution, Customer experience optimisation training, Soft Skills Training Program, Leadership training, Team building activities, Team building training, Soft Skill Trainer, Facilitation training plan, Corporate Training, Safety training, ITIL Training, Time management training plan, Communication skills training, Process training, Written communication training, Employee training & development plan, Project management training plan, Train the trainer, Leadership Training Plan, Quality training, Lean training, SIX sigma training, 5S Training plan, Cybersecurity Awareness Training Plan for Employees, Credit Analysis Training Plan, Out of box thinking training plan, AI awareness training, 'AI awareness training for Employee, Cyber security training, Cyber security course in pune, Training need analysis, Training need identification, Customized training plan for employees, Diversity Equity and Inclusion Training Plan, PoSH Training, Prevention of Sexual Harassment Training Program, 
We are training partner to train your employee for better productivity & quality, General insurance training, Life insurance training, Sales training" />
    <meta name="description" content="We are training partner to train your employee for better productivity & quality, Looking for expert corporate training solutions in Pune, Mumbai, or Navi Mumbai? We offer customized employee development programs including soft skills, leadership, IT, AI, PoSH, DEI, Six Sigma, safety, cybersecurity, and more to boost productivity, quality, and team performance." />
    <link rel="canonical" href="<?php echo $baseURL . basename($_SERVER["REQUEST_URI"]); ?>" />
  
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- REMOVED: duplicate FA v4, keeping v6 -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?= $baseURL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $baseURL ?>css/rs-spacing.css">
    <link rel="stylesheet" href="<?= $baseURL ?>css/style.css">
    <link rel="stylesheet" href="<?= $baseURL ?>css/responsive.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <main>
        <section class="innerPageBannerSec" data-background="<?= $baseURL ?>images/bg/innerPages-bg1.jpg">
            <div class="container">
                <div class="innerPageBannerSecinner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="innerPageBannerWrapper">
                                <h1 class="title"><?= $page_title ?></h1>
                                <ol class="breadcrumb innerPageBannerBreadcrumb">
                                    <li><a href="<?= $baseURL ?>">Home</a></li>
                                    <li class="active"><?= $page_title ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="" style="padding-top:25px;">
            <div class="container">
                <?= $page_description ?>
            </div>
        </section>
    </main>
    <?php include('includes/footer.php'); ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
    <script src="<?= $baseURL ?>js/sal.min.js"></script>
    <script src="<?= $baseURL ?>js/tilt.js"></script>
    <script src="<?= $baseURL ?>js/custom.js"></script>
</body>
</html>
