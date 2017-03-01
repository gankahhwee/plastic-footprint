<!DOCTYPE html>
<!--[if IE 8 ]>
<html class="ie ie8" lang="en">
	<![endif]-->
	<!--[if IE 9 ]>
	<html class="ie ie9" lang="en">
		<![endif]-->
		<html lang="en">
			<!--<![endif]-->
			<head>
				<!-- Basic Page Needs -->
				<meta charset="utf-8">
				<title>Plastic Footprint Calculator</title>
				<meta name="description" content="Your first step to going plastic lite">
                <link rel="image_src" href="img/screenshot.png" />
                <meta property="og:title" content="Plastic Footprint Calculator" />
                <meta property="og:image" content="img/screenshot.png" />
                <meta property="og:description" content="Your first step to going plastic lite" />
                <meta name='author' content='Plastic Lite Singapore'/>
				<!-- Favicons-->
				<link rel="shortcut icon" href="img/plastic-lite-sg-logo.jpg" type="image/x-icon"/>
				<link rel="apple-touch-icon" type="image/x-icon" href="img/plastic-lite-sg-logo.jpg">
				<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/plastic-lite-sg-logo.jpg">
				<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/plastic-lite-sg-logo.jpg">
				<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/plastic-lite-sg-logo.jpg">
				<!-- Mobile Specific Metas -->
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<!-- CSS -->
				<link href="css/bootstrap.css" rel="stylesheet">
				<link href="css/style.css" rel="stylesheet">
				<link href="css/style-overwrite.css" rel="stylesheet">
				<link href="font-awesome/css/font-awesome.css" rel="stylesheet" >
				<link href="css/socialize-bookmarks.css" rel="stylesheet">
				<link href="js/fancybox/source/jquery.fancybox.css?v=2.1.4" rel="stylesheet">
				<link href="check_radio/skins/square/aero.css" rel="stylesheet">
				<!-- Toggle Switch -->
				<link rel="stylesheet" href="css/jquery.switch.css">
				<!-- Owl Carousel Assets -->
				<link href="css/owl.carousel.css" rel="stylesheet">
				<link href="css/owl.theme.css" rel="stylesheet">
				<!-- Google web font -->
				<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
				<link href="bootstrap-slider/highlightjs-github-theme.min.css" rel="stylesheet">
				<link href="bootstrap-slider/bootstrap-slider.min.css" rel="stylesheet">
				<!--[if lt IE 9]>
				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
				<![endif]-->
				<!-- Jquery -->
				<script src="js/jquery-1.10.2.min.js"></script>
				<script src="js/jquery-ui-1.8.22.min.js"></script>
				<!-- Wizard-->
				<script src="js/jquery.wizard.js"></script>
				<!-- Radio and checkbox styles -->
				<script src="check_radio/jquery.icheck.js"></script>
				<!-- HTML5 and CSS3-in older browsers-->
				<script src="js/modernizr.custom.17475.js"></script>
				<!-- Support media queries for IE8 -->
				<script src="js/respond.min.js"></script>
				<!-- Bootstrap slider -->
				<script src="bootstrap-slider/highlight.min.js"></script>
				<script src="bootstrap-slider/bootstrap-slider.min.js"></script>
                <!--<script src="http://www.w3schools.com/lib/w3data.js"></script>-->
			</head>
			<body>
				<header>
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-xs-12 main-title"><h1>What is Your Plastic Footprint?</h1></div>
							<!--<div class="btn-responsive-menu"> <span class="bar"></span> <span class="bar"></span> <span class="bar"></span> </div>
							<!--<nav class="col-md-7 col-xs-8" id="top-nav">
								<ul>
									<li><a href="#" data-toggle="modal" data-target="#myModal">About</a></li>
									<li><a href="#" id="purchase">Purchase this template</a></li>
								</ul>
							</nav>-->
						</div>
					</div>
				</header>
				<!-- End header -->
				<div class="container margin-top-lg">
					<div class="row">
						<div class="col-md-12 main-title">
                            <p class="lead">Welcome! This is your first step to going Plastic-Lite.</p>
						</div> 
                        <p class="text-center">
                            <a href="#" data-toggle="modal" data-target="#whyModal">WHY GO PLASTIC-LITE?</a>
                        </p>
					</div>
				</div>
				<section class="container" id="main">
					<!-- Start Survey container -->
					<div id="survey_container">
						<div id="top-wizard">
							<strong>Progress <span id="location"></span></strong>
							<div id="progressbar"></div>
							<div class="shadow"></div>
						</div>
						<!-- end top-wizard -->
						<form name="example-1" id="wrapped" action="" method="POST" >
							<div id="middle-wizard">
                                <div class="step row welcome"><?php include 'templates/step1.html'; ?></div>
                                <div class="step row hidden"><?php include 'templates/step2.html'; ?></div>
                                <div class="step row hidden"><?php include 'templates/step3.html'; ?></div>
                                <div class="step row hidden"><?php include 'templates/step4.html'; ?></div>
                                <div class="step row hidden"><?php include 'templates/step5.html'; ?></div>
                                <div class="step row hidden"><?php include 'templates/step6.html'; ?></div>
                                <div class="step row hidden"><?php include 'templates/step7.html'; ?></div>
                                <div class="step row hidden"><?php include 'templates/step8.html'; ?></div>
                                <div class="step submit hidden" id="complete"><?php include 'templates/results.html'; ?></div>
							</div>
							<!-- end middle-wizard -->
							<div id="bottom-wizard">
								<button type="button" name="backward" class="backward">Back</button>
								<button type="button" name="forward" class="forward">Next </button>
							</div>
							<!-- end bottom-wizard -->
						</form>
					</div>
					<!-- end Survey container -->
				</section>
				<!-- end section main container -->
                
				<footer>
					<section class="container">
						<div class="row">
							<div class="col-md-8"><?php include 'templates/disclaimer.html'; ?></div>
							<div class="col-md-4" id="contact"><?php include 'templates/about.html'; ?></div>
						</div>
					</section>
					<section id="footer_2">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<ul id="footer-nav">
										<li>Copyright© Plastic Lite Singapore</li>
										<!--<li><a href="#">Terms of Use</a></li>
										<li><a href="#">Privacy</a></li>-->
									</ul>
								</div>
								<!--<div class="col-md-6" style="text-align:center">
									<ul class="social-bookmarks clearfix">
										<li class="facebook"><a href="#">facebook</a></li>
										<li class="googleplus"><a href="#">googleplus</a></li>
										<li class="twitter"><a href="#">twitter</a></li>
										<li class="delicious"><a href="#">delicious</a></li>
										<li class="paypal"><a href="#">paypal</a></li>
									</ul>
								</div>-->
							</div>
						</div>
					</section>
				</footer>
				<div id="toTop">Back to Top</div>
                
				<div class="modal fade" id="whyModal" tabindex="-1" role="dialog" aria-labelledby="whyModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="whyModalLabel">Folks, time to go plastic-lite!</h4>
							</div>
							<div class="modal-body">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/FjT8GG0ETQg" frameborder="0" allowfullscreen></iframe>
                                <p>"So ubiquitous and inexpensive are plastics that we've become a single-use, throwaway society. Synthetic plastics <u>do not biodegrade</u>. At best, they break and break again into smaller and smaller pieces. The fact remains that, save those incinerated, every single molecule of synthetic plastic ever created is still on this planet and probably will be for centuries".<br/><span class="text-small">from Breaking the cycle of plastics in the ocean by Andrew Myers <i>Ocean Conservancy Magazine Autumn 2007</i></span></p>
                                <p>Even though waste in Singapore is incinerated, lots of single-use plastics end up as litter when they are not disposed of properly, or they fall onto the ground due to wind or other reasons, subsequently go into the drain, flush into the canal, then into the sea. Singapore is not a clean city, but a cleaned city. There is plenty of litter here that potentially pollutes the environment.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /.modal -->
				<!-- OTHER JS --> 
				<script src="js/jquery.validate.js"></script>
				<script src="js/jquery.placeholder.js"></script>
				<script src="js/jquery.tweet.min.js"></script>
				<script src="js/jquery.bxslider.min.js"></script>
				<script src="js/quantity-bt.js"></script>
				<script src="js/bootstrap.js"></script>
				<script src="js/retina.js"></script>
				<script src="js/functions.js"></script>
				<!-- FANCYBOX -->
				<script  src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.4" type="text/javascript"></script> 
				<script src="js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5" type="text/javascript"></script>
                
				<script src="js/scripts.js"></script>
			</body>
		</html>