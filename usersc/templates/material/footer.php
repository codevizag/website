<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/font-awesome.min.css">
<?php
require_once $abs_us_root . $us_url_root . 'users/includes/page_footer.php';
?><script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});</script><script>
  var $hamburger = $(".hamburger");
  $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
    // Do something else, like open/close menu
  });</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162012271-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-162012271-2');
</script>

<div style="background-color: #f95169;">
            <div class="container">

                <!--Grid row-->
                <div class="row py-4 d-flex align-items-center">

                    <!--Grid column-->
                    <div class="col-md-6 col-lg-5 text-center text-md-left mb-md-0">
                        <h6 class="mb-0 white-text"><font color="#fff">Get Connected With Us On Social Networks !</font></h6>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6 col-lg-7 text-center text-md-right">
                        <!--Facebook-->
                        <a class="p-2 m-2 fa-lg fb-ic ml-0" href="https://facebook.com/subhadeepdps">
                            <i class="fab fa-facebook-f white-text mr-lg-4"> </i>
                        </a>
                        <!--Twitter-->
                        <a class="p-2 m-2 fa-lg tw-ic" href="#">
                            <i class="fab fa-twitter white-text mr-lg-4"> </i>
                        </a>
                        <!--Google +-->
                        <a class="p-2 m-2 fa-lg gplus-ic" href="#">
                            <i class="fab fa-google-plus-g white-text mr-lg-4"> </i>
                        </a>
                        <!--Linkedin-->
                        <a class="p-2 m-2 fa-lg li-ic" href="#">
                            <i class="fab fa-linkedin-in white-text mr-lg-4"> </i>
                        </a>
                        <!--Instagram-->
                        <a class="p-2 m-2 fa-lg ins-ic" href="#">
                            <i class="fab fa-instagram white-text mr-lg-4"> </i>
                        </a>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->
            </div>
        </div>




<section id="contact-us">
<footer class="footer-area ">
  <div class="footer-big">
    <!-- start .container -->
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="footer-widget">
            <div class="widget-about">
              <img src="<?=$us_url_root?>users/images/logo.png" alt="Codevizag Academy" class="img-fluid">
              <p>Codevizag Academy Is A Excellent Choice For Students Who Wants To Learn Coding <b>Free</b>. We Teach Coding For Free & We Have Better Documentation Of Coding.</p>
              <ul class="contact-details">
                <li>
                <span class="icon-earphones"></span> Call Us : 
                  <a href="tel:+91-9493202447">+91-9493202447</a>
                </li>
                <li>
                  <span class="icon-envelope-open"></span>
                  E-Mail : <a href="mailto:admin@codevizag.com">admin@codevizag.com</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- end /.col-md-4 -->
        <div class="col-md-3 col-sm-4">
          <div class="footer-widget">
            <div class="footer-menu footer-menu--1">
              <h4 class="footer-widget-title">Helpful & Useful Links</h4>
                                <?php 
        if($user->isLoggedIn()){?>
          <ul>
                <li>
                  <a href="<?=$us_url_root?>users/account">Account Dashboard</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>users/user_settings">Edit Your Profile</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>users/messages">Messages</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>users/logout">Logout</a>
                </li>
              </ul>
        <?php }else{?>
          <ul>
                <li>
                  <a href="<?=$us_url_root?>users/login">Sign-In</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>users/join">Sign-Up</a>
                </li>
                <li>
                  <a href="https://reset.codevizag.com">Reset Password</a>
                </li>
                <li>
                  <a href="https://verify.codevizag.com">Resend Activation Link</a>
                </li>
              </ul>
        <?php } ?>
              

              </ul>
            </div>
            <!-- end /.footer-menu -->
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- end /.col-md-3 -->

        <div class="col-md-3 col-sm-4">
          <div class="footer-widget">
            <div class="footer-menu">
              <h4 class="footer-widget-title">Our Company</h4>
              <ul>
                <li>
                  <a class="pagescroll" href="<?=$us_url_root?>#ourhome">Home</a>
                </li>
                <li>
                  <a class="pagescroll" href="<?=$us_url_root?>#aboutus">About Us</a>
                </li>
                <li>
                  <a class="pagescroll" href="<?=$us_url_root?>#our-team">Team</a>
                </li>
                <li>
                  <a class="pagescroll" href="<?=$us_url_root?>#our-features">Features</a>
                </li>
                <li>
                  <a class="pagescroll" href="<?=$us_url_root?>#our-pricings">Plans &amp; Pricing</a>
                </li>
                <li>
                  <a class="pagescroll" href="<?=$us_url_root?>#contact-us">Contact Us</a>
                </li>
              </ul>
            </div>
            <!-- end /.footer-menu -->
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- end /.col-lg-3 -->

        <div class="col-md-3 col-sm-4">
          <div class="footer-widget">
            <div class="footer-menu no-padding">
              <h4 class="footer-widget-title">Help & Support</h4>
              <ul>
                <li>
                  <a href="<?=$us_url_root?>users/Support">Support Forums</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>users/T&Cs">Terms &amp; Conditions</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>users/PrivacyPolicy">Privacy Policy</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>users/ReturnPolicy">Return Policy</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>robots.txt">Robots</a>
                </li>
                <li>
                  <a href="<?=$us_url_root?>sitemap.xml">Sitemap</a>
                </li>
              </ul>
            </div>
            <!-- end /.footer-menu -->
          </div>
          <!-- Ends: .footer-widget -->
        </div>
        <!-- Ends: .col-lg-3 -->

      </div>
      <!-- end /.row -->
    </div>
    <!-- end /.container -->
  </div>
  <!-- end /.footer-big -->

  <div class="mini-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright-text">

          <font color="white">
    &copy;
      2017-<?php echo date("Y"); ?>
       <?=$settings->copyright; ?><br>
    
    <!-- RDP Data Center Acquisition Notice -->
        <a href="https://rdpdatacenter.in" target="_blank" style="color: #f95169; text-decoration: none;" title="RDP Data Center - Web Hosting & Cloud Services">RDP Data Center</a> has acquired Codevizag Academy
    
        <?php 
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    $user_ip = getUserIpAddr();
    
    // Use freeipapi.com for ISP information
    $api_url = 'https://free.freeipapi.com/api/json/' . $user_ip;
    
    // Use cURL for better error handling
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 5 second timeout
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS compatibility
    
    $json_data = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($json_data && $http_code == 200) {
        $data_object = json_decode($json_data);
        
        if ($data_object && isset($data_object->asn) && isset($data_object->asnOrganization)) {
            echo "<br><b>For Security Purposes We Store Your Internet Protocol Address: " . $user_ip . "<br>";
            echo "Your ISP is " . $data_object->asnOrganization . " (AS" . $data_object->asn . ").</b>";
        } else {
            // Fallback if API response is incomplete
            echo "<br><b>For Security Purposes We Store Your Internet Protocol Address: " . $user_ip . "<br>";
            echo "ISP information temporarily unavailable.</b>";
        }
    } else {
        // Fallback if API fails
        echo "<br><b>For Security Purposes We Store Your Internet Protocol Address: " . $user_ip . "<br>";
        echo "ISP information temporarily unavailable.</b>";
    }
    ?>
</font>
  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer></section>
<?php require_once($abs_us_root.$us_url_root.'users/includes/html_footer.php');?>
