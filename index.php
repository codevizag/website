<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/1.php';
if(isset($user) && $user->isLoggedIn()){
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="images/code.png" type="image/x-icon"/>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Codevizag Academy</title>
<link rel="stylesheet" href="css/plugins.css">
<link rel="stylesheet" href="css/style.css">
<link rel="canonical" href="https://codevizag.com/" />
</head>

<!--PreLoader-->
<div class="loader">
   <div class="loader-inner">
      <div class="loader-blocks">
         <span class="block-1"></span>
         <span class="block-2"></span>
         <span class="block-3"></span>
         <span class="block-4"></span>
         <span class="block-5"></span>
         <span class="block-6"></span>
         <span class="block-7"></span>
         <span class="block-8"></span>
         <span class="block-9"></span>
         <span class="block-10"></span>
         <span class="block-11"></span>
         <span class="block-12"></span>
         <span class="block-13"></span>
         <span class="block-14"></span>
         <span class="block-15"></span>
         <span class="block-16"></span>
      </div>
   </div>
</div>
<!--PreLoader Ends-->

<body  data-spy="scroll" data-target=".navbar" data-offset="90">
<!-- header -->
<header class="site-header">
   <nav class="navbar navbar-expand-lg fixed-bottom gradient_bg">
      <div class="container">
         <a class="navbar-brand" href="https://codevizag.com"> 
         	<img src="images/logo.png" alt="logo"></a>

         <div class="collapse navbar-collapse" id="xenav">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item active">
                  <a class="nav-link pagescroll" href="#ourhome">Home</a> 
               </li>
               <li class="nav-item">
                  <a class="nav-link pagescroll" href="#aboutus">About Us</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link pagescroll" href="#our-team">Team</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link pagescroll" href="#our-features">Features</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link pagescroll" href="#our-pricings">Pricing</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link pagescroll" href="#contact-us">Contact Us</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
</header>
<!-- header -->

<!--Ful Screen Section Video with caption-->
<section class="full-screen parallax-video parallaxie center-block bg-video-container" id="ourhome">
   <div class="container">
      <div class="row">
         <div class="col-md-2 col-sm-1"></div>
         <div class="col-md-8 col-sm-10">
               <div class="center-item text-center video-content">
                  <h2 class="text-capitalize top50 bottom35  whitecolor">
                     <div class="text1"><span class="font-xlight block wow fadeIn" data-wow-delay="400ms">Welcome To
                     </span></div><div class="text2"><span class="font-xlight fontbold wow fadeIn" data-wow-delay="500ms"><b>  Codevizag Academy</b></span></div>
                  </h2>
                  <?php 
				if($user->isLoggedIn()){?>
					<a class="button btnwhite wow fadeInUp" href="users/account" role="button" >Your Account &raquo;</a>
				<?php }else{?>
					<a class="button btnwhite wow fadeInUp" href="users/login" role="button" data-wow-delay="600ms" data-wow-delay="600ms">Log In &raquo;</a>
					<a class="button btnwhite wow fadeInUp" href="users/join" role="button" data-wow-delay="600ms">Sign Up &raquo;</a>
				<?php }	?>
               </div>
         </div>
         <div class="col-md-2 col-sm-1"></div>
      </div>
   </div> 
   <video class="my-background-video jquery-background-video" loop="true" autoplay="true" poster="video/video.png">
		<source src="video/cv.mp4" type="video/mp4">
		<source src="video/cv.ogv" type="video/ogg">
		<source src="video/cv.webm" type="video/webm">
	</video>
		<audio autoplay="true" src="video/sound.mp3" loop hidden>
</section>

<style type="text/css">
	audio { 
   display:none;
}


.text1 {
	background: -webkit-linear-gradient(#40E0D0, #FF8C00, #FF0080);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.text2 {
	background: -webkit-linear-gradient(#bc4e9c, #f80759);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>


<!--half img section-->  
<section class="half-section" id="aboutus">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-6 nopadding">
            <div class="image img-container">
               <img alt="About Us" src="images/about.jpg" class="equalheight">
            </div>
         </div>
         <div class="col-lg-6 nopadding">
            <div class="split-box text-center center-block container-padding equalheight" id="btn-feature">
               <div class="heading-title padding">
               <span class=" wow fadeIn" data-wow-delay="300ms">About Our</span>
               <h2 class="darkcolor bottom20 wow fadeIn" data-wow-delay="350ms">Creative Company</h2>
               <p class="heading_space wow fadeIn" data-wow-delay="400ms"><b>Codevizag Academy is a excellent choice for students who wants to learn coding . We teach coding for free and we have a better documentation of coding examples . We have documentaion so that students can download and try any examples of their choice . </b></p>
               <a href="#" class="button btnprimary pagescroll wow fadeInUp" data-wow-delay="500ms">Design Works</a>  
            </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--half img section ends-->     
   
<!-- WOrk Process-->  
<section id="our-process" class="padding gradient_bg_default">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 text-center">
            <div class="heading-title wow fadeInUp" data-wow-delay="300ms">
               <h2 class="whitecolor">Work <span class="fontregular">Process</span> </h2>
            </div>
         </div>
      </div>
      <div class="row">
         <ul class="process-wrapp">
            <li class="whitecolor wow fadeIn" data-wow-delay="350ms">
               <span class="pro-step bottom20">01</span>
               <p class="fontbold bottom25">Concept</p>
               <p>We Follow Unique & Adequate Concept Before Coding.</p>
            </li>
            <li class="whitecolor wow fadeIn" data-wow-delay="400ms">
               <span class="pro-step bottom20">02</span>
               <p class="fontbold bottom25">Plan</p>
               <p>Essential Plans Are Required For Coding.</p>
            </li>
            <li class="whitecolor wow fadeIn" data-wow-delay="500ms">
               <span class="pro-step bottom20">03</span>
               <p class="fontbold bottom25">Design</p>
               <p>Unique & Elegant Ideas Make Design More Beautiful.</p>
            </li>
            <li class="whitecolor wow fadeIn" data-wow-delay="600ms">
               <span class="pro-step bottom20">04</span>
               <p class="fontbold bottom25">Development</p>
               <p>Development Of Any Website Requires Special Thinking Ability.</p>
            </li>
            <li class="whitecolor wow fadeIn" data-wow-delay="700ms">
               <span class="pro-step bottom20">05</span>
               <p class="fontbold bottom25">Quality Check</p>
               <p>Our Websites Are Checked By Our I.T Tech For Quality Resource.</p>
            </li>
         </ul>
      </div>
   </div>
</section>
<!--WOrk Process ends-->


<!-- Our Team-->    
<section id="our-team" class="padding bglight">
   <div class="container">
      <div class="row">
         <div class="col-md-8 offset-md-2 col-sm-12 text-center">
            <div class="heading-title wow fadeInUp" data-wow-delay="300ms">
               <span>Heros Behind the Company</span>
               <h2 class="darkcolor bottom20">Creative Team</h2>
               <p class="bottom10">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus. </p>
            </div>
         </div>
      </div>
      <div class="row">
           <div class="col-md-6 col-xs-12">
              <div class="team-box top60 wow fadeIn" data-wow-delay="350ms">
               <div class="image">
                  <img src="images/p1.jpg" alt="Subhadeep Pramanik" height="450">
               </div>
               <div class="team-content gradient_bg whitecolor">
                  <h3>Subhadeep Pramanik</h3>
                  <p class="bottom40">CEO, Codevizag Academy</p>
                  <div class="progress-bars">
                     <div class="progress">
                        <p>Web Designing</p>
                        <div class="progress-bar" data-value="95"><span>95%</span></div>
                     </div>
                     <div class="progress">
                        <p>Management</p>
                        <div class="progress-bar" data-value="80"><span>75%</span></div>
                     </div>
                  </div>
               </div>
            </div>
           </div>
           <div class="col-md-6 col-xs-12">
              <div class="team-box top60 wow fadeIn" data-wow-delay="400ms">
               <div class="image">
                  <img src="images/p2.jpg" alt="Reetam Dey" height="450">
               </div>
               <div class="team-content gradient_bg_default whitecolor">
                  <h3>Reetam Dey</h3>
                  <p class="bottom40">Designer, Codevizag Academy</p>
                  <div class="progress-bars">
                     <div class="progress">
                        <p>Web Designing</p>
                        <div class="progress-bar" data-value="75"><span>75%</span></div>
                     </div>
                     <div class="progress">
                        <p>Management</p>
                        <div class="progress-bar" data-value="90"><span>90%</span></div>
                     </div>
                  </div>
               </div>
            </div>
           </div>
      </div>
   </div>
</section>
<!-- Our Team ends--> 
     
<!--Some Feature -->  
<section id="our-features" class="padding single-feature">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-sm-7 text-md-left text-center wow fadeInLeft" data-wow-delay="300ms">
            <div class="heading-title heading_space">
               <span>Service We Offer</span>  
               <h2 class="darkcolor bottom30">Awesome Feature</h2>
            </div>
            <p class="bottom35">If You Register In Our Website You Get Free Office 365 Subscription From Microsoft By Us According To Your Account Plan. </p>
            <a href="https://codevizag.com/users/join" class="button btnsecondary">Register Now</a>
         </div>
         <div class="col-md-6 col-sm-5 wow fadeInRight" data-wow-delay="350ms">
            <div class="image top50"><img alt="SEO" src="images/tab.jpg"></div>
         </div>
      </div>
   </div>
</section>
<!--Some Feature ends--> 


    
<!-- Mobile Apps -->  
<section id="our-apps" class="padding">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 text-center">
            <div class="heading-title wow fadeInUp" data-wow-delay="300ms">
               <span>Yes We Provide Mobile Apps</span>
               <h2 class="darkcolor heading_space">Mobile Applications</h2>
            </div>
         </div>
      </div>
      <div class="row" id="app-feature">
         <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="content-left clearfix">
               <div class="feature-item left top30 bottom30 wow fadeInUp" data-wow-delay="300ms">
                  <span class="icon"><i class="fa fa-mobile-phone"></i></span>
                  <div class="text">
                     <h4>Responsive Design</h4>
                     <p>Our Team Has Created A Responsive Website So That You Can Explore Our Website Without Any Hesitation.</p>
                  </div>
               </div>
               <div class="feature-item left top30 bottom30 wow fadeInUp" data-wow-delay="350ms">
                  <span class="icon"><i class="fa fa-cog"></i></span>
                  <div class="text">
                     <h4>Amazing Theme Options</h4>
                     <p>We Change Our Website's Theme Regularly.</p>
                  </div>
               </div>
               <div class="feature-item left top30 bottom30 wow fadeInUp" data-wow-delay="400ms">
                  <span class="icon"><i class="fa fa-edit"></i></span>
                  <div class="text">
                     <h4>Easy to Customize</h4>
                     <p>It's Very Simple To Customize Text According To Your Style.</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="image feature-item text-center wow fadeIn" data-wow-delay="500ms">
               <img src="images/mobile.png" alt="iPhoneCodevizag">
            </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="content-right clearfix">
               <div class="feature-item right top30 bottom30 wow fadeInUp" data-wow-delay="300ms">
                  <span class="icon"><i class="fa fa-code"></i></span>
                  <div class="text">
                     <h4>Powerful BackEnd</h4>
                     <p>We Have Strong SSD Servers By Viewen Team & 256-Bit SSL Certificate.</p>
                  </div>
               </div>
               <div class="feature-item right top30 bottom30 wow fadeInUp" data-wow-delay="350ms">
                  <span class="icon"><i class="fa fa-folder-o"></i></span>
                  <div class="text">
                     <h4>Well Documented</h4>
                     <p>We Provide Clean & Best Documentation For Students.</p>
                  </div>
               </div>
               <div class="feature-item right top30 bottom30 wow fadeInUp" data-wow-delay="400ms">
                  <span class="icon"><i class="fa fa-support"></i></span>
                  <div class="text">
                     <h4>24/7 Support</h4>
                     <p>Our Team Always Work On Bugs, Support, Chat, Development.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>                                                                                 
<!--Mobile Apps ends-->  

<!-- Counters -->  
<section id="funfacts" class="padding_top fact-iconic gradient_bg">
   <div class="container">
      <div class="row">
         <div class="col-md-5 col-sm-12 margin_bottom whitecolor text-md-left text-center wow fadeInLeft" data-wow-delay="300ms">
            <h3 class="bottom25">Our many years of experience in numbers</h3>
            <p class="title">We show you our professional achievements in numbers, which show the acquired skills and trust of many clients.</p>
         </div>
         <div class="col-md-7 col-sm-12 text-center">
            <div class="row">
               <div class="col-md-4 col-sm-4 icon-counters whitecolor margin_bottom  wow fadeInRight" data-wow-delay="400ms">
                  <div class="img-icon bottom15">
                     <i class="fa fa-smile-o"></i>
                  </div>
                  <div class="counters">
                     <span class="count_nums" data-to="2500" data-speed="2500"> </span> <i class="fa fa-plus"></i>
                  </div>
                  <p class="title">Satisfied customers</p>
               </div>
               <div class="col-md-4 col-sm-4 icon-counters whitecolor margin_bottom wow fadeInRight" data-wow-delay="350ms">
                  <div class="img-icon bottom15">
                     <i class="fa fa-language"> </i>
                  </div>
                  <div class="counters">
                     <span class="count_nums" data-to="9500" data-speed="2500"> </span> <i class="fa fa-plus"></i>
                  </div>
                  <p class="title">Completed consultations</p>
               </div>
               <div class="col-md-4 col-sm-4 icon-counters whitecolor margin_bottom wow fadeInRight" data-wow-delay="300ms">
                  <div class="img-icon bottom15">
                     <i class="fa fa-desktop"></i>
                  </div>
                  <div class="counters">
                     <span class="count_nums" data-to="6000" data-speed="2500"> </span> <i class="fa fa-plus"></i>
                  </div>
                  <p class="title">Carried out training</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--Counters ends--> 
  
<!-- Pricing Tables -->
<section id="our-pricings" class="padding pricing-bg">
   <div class="container">
      <div class="row">
         <div class="col-md-8 offset-md-2 col-sm-12 text-center">
            <div class="heading-title  wow fadeInUp" data-wow-delay="300ms">
               <span>Choose The Best Plan</span>
               <h2 class="darkcolor">Our Pricing</h2>
            </div>
         </div>
      </div>
      <div class="row centered-table">
         <div class="col-md-4 col-sm-12">
            <div class="price-table top60 wow fadeIn" data-wow-delay="300ms">
               <h3 class="bottom20 darkcolor">Free Plan</h3>
               <ul class="top20">
                  <li><span>Free Account</span></li>
                  <li><span>No Account Backup</span></li>
                  <li><span>99.9% Security & Uptime</span></li>
                  <li><span>Free Office 365 Home Subscription</span></li>
                  <li><span>Free Limited Suppport</span></li>
               </ul>
               <div class="clearfix"></div>
               <div class="ammount top50">
                  <h2 class="defaultcolor"><i class="fa fa-rupee"></i> 0.00</h2>
               </div>
               <a href="users/join" class="button btnprimary top50">Get Started </a>
            </div>
         </div>
         <div class="col-md-4 col-sm-12">
            <div class="price-table active top60 wow fadeIn" data-wow-delay="350ms">
               <h3 class="bottom20 darkcolor">Business Plan</h3>
               <ul class="top20">
                  <li><span>Business Account</span></li>
                  <li><span>Account Backup Weekly</span></li>
                  <li><span>99.9% Security & Uptime</span></li>
                  <li><span>Free Office 365 ProPlus E1 Subscription</span></li>
                  <li><span>Business Class Support</span></li>
               </ul>
               <div class="clearfix"></div>
               <div class="ammount top50">
                  <h2 class="defaultcolor"><i class="fa fa-rupee"></i> 999.00</h2>
               </div>
               <a href="pay/plan1" class="button btnsecondary top50">Get Started </a>
            </div>
         </div>
         <div class="col-md-4 col-sm-12">
            <div class="price-table top60 wow fadeInUp" data-wow-delay="400ms">
               <h3 class="bottom20 darkcolor">Premium Plan</h3>
               <ul class="top20">
                  <li><span>Premium Account</span></li>
                  <li><span>Account Backup Everyday</span></li>
                  <li><span>99.9% Security & Uptime</span></li>
                  <li><span>Free Office 365 Premium E3 Subscription</span></li>
                  <li><span>Premium Class Support</span></li>
               </ul>
               <div class="clearfix"></div>
               <div class="ammount top50">
                  <h2 class="defaultcolor"><i class="fa fa-rupee"></i> 1999.00 </h2>
               </div>
               <a href="pay/plan2" class="button btnprimary top50">Get Started </a>
            </div>
         </div>
      </div>
   </div>
</section>
<!--Pricing Tables ends-->
 

<br><br><br><br>

<!-- Partners -->  
<section id="logos" class="padding_bottom">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div id="partners-slider" class="owl-carousel">
               <div class="item">
                  <div class="logo-item"> <img alt="Codevizag Academy" src="images/logo_dark.png"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="Amazon AWS" src="images/aws.svg"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="Viewen" src="images/viewen.png"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="GoDaddy" src="images/godaddy.png"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="MailJet" src="images/mailjet.png"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="cPanel" src="images/cpanel.png"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="Office 365" src="images/365.jpg"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="Google API" src="images/api.png"></div>
               </div>
               <div class="item">
                  <div class="logo-item"><img alt="Facebook API" src="images/api2.jpg"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--Partners Ends-->



<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.1.1.min.js"></script>

<!--Bootstrap Core-->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!--to view items on reach-->
<script src="js/jquery.appear.js"></script>

<!--Equal-Heights-->
<script src="js/jquery.matchHeight-min.js"></script>

<!--Owl Slider-->
<script src="js/owl.carousel.min.js"></script>

<!--number counters-->
<script src="js/jquery-countTo.js"></script>
 
<!--Parallax Background-->
<script src="js/parallaxie.js"></script>
  
<!--Cubefolio Gallery-->
<script src="js/jquery.cubeportfolio.min.js"></script>

<!--FancyBox popup-->
<script src="js/jquery.fancybox.min.js"></script>         

<!-- Video Background-->
<script src="js/jquery.background-video.js"></script>

<!--TypeWriter-->
<script src="js/typewriter.js"></script> 
      
<!--Particles-->
<script src="js/particles.min.js"></script>            
        
<!--WOw animations-->
<script src="js/wow.min.js"></script>
             
<!--Revolution SLider-->
<script src="js/revolution/jquery.themepunch.tools.min.js"></script>
<script src="js/revolution/jquery.themepunch.revolution.min.js"></script>
<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="js/revolution/extensions/revolution.extension.actions.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.carousel.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.kenburn.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.migration.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.navigation.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.parallax.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
<script src="js/revolution/extensions/revolution.extension.video.min.js"></script>  
<script src="js/functions.js"></script>	
<!-- footer -->
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>