<?php
require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if(isset($user) && $user->isLoggedIn()){
}
?><style type="text/css" media="screen">
    body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(<?=$us_url_root.'users/images/404.jpg'?>)no-repeat center center;
        background-size: cover;
}
        .card {
            background-color: rgba(229, 228, 255, 0.2);
        }
        .md-form label {
            color: #ffffff;
        }
        h6 {
            line-height: 1.7;
        }
        html,
        body,
        header,
        .view {
          height: 100vh;
        }
        @media (max-width: 740px) {
          html,
          body,
          header,
          .view {
            height: 700px;
          }
        }
        @media (min-width: 800px) and (max-width: 850px) {
          html,
          body,
          header,
          .view  {
            height: 650px;
          }
        }
        .card {
            margin-top: 30px;
            /*margin-bottom: -45px;*/
        }
        .md-form input[type=text]:focus:not([readonly]),
        .md-form input[type=email]:focus:not([readonly]),
        .md-form input[type=password]:focus:not([readonly]) {
            border-bottom: 1px solid #fb5364;
            box-shadow: 0 1px 0 0 #fb5364;
        }
        .md-form input[type=text]:focus:not([readonly])+label,
        .md-form input[type=password]:focus:not([readonly])+label {
            color: #fb5364;
        }
        .md-form .form-control {
            color: #fff;
        }
        .jumbotron{
          width: 90%;
          align-self: center;}
</style><br><div id="page-wrapper">
<div class="container">
    <div class="jumbotron"><center>
<h1>We Are Really Sorry <?=echousername($user->data()->id)?>,</h1><br><h2>You Have Been Banned Due To Violating Our <a href="<?=$us_url_root?>users/T&Cs">T&Cs</a>.</h2>
<h2>If You Feel This Is an Error, Contact The Administrator.</h2><h2>-The Codevizag Team</h2><br>
<div class="btn-group"><a href="<?=$us_url_root.'users/logout'?>"><button type="button" class="btn btn-info" ><i class="fa fa-sign-in"></i> Logout</button></a></div>
</center></div></div></div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- footer -->
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>