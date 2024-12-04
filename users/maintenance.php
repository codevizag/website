<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

//if (!securePage($_SERVER['PHP_SELF'])){die();}

$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();

?><style type="text/css" media="screen">
    body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
}
p{
	color: #000;
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
          align-self: center;
        }

    body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
}
</style><br><div id="page-wrapper">
<div class="container">
    <div class="jumbotron">
<div id="page-wrapper">
<div class="container">
<div class="row">
	<div class="col-sm-12">
				<h1 align="center" style="font-size: 140px; color: #FFD700; text-align:center"><i class="fa fa-frown-o fa-2x"></i></h1>
				    <h3 align="center"><?=lang("MAINT_HEAD");?></h3>
				        <p align="center"><?=lang("MAINT_MSG")?></p>
				        <p align="center">&mdash; <?=$settings->site_name?></p>
		</div>
	</div>
</div></div></div>
</div>

<?php require_once $abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/container_close.php'; //custom template container ?>
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/footer.php'; //custom template footer?>
