<link href="css/mdb.min.css" rel="stylesheet">
<style type="text/css" media="screen">
    body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
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
          align-self: center;
        }

    body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
}
</style><br><br>
<div id="page-wrapper">
<div class="container">
    <div class="jumbotron">
<div class="row">
	<div class="col-sm-12">
		<h2 class="text-center"><?=$ruser->data()->fname;?>,</h2>
		<p class="text-center" style="color: #fff"><?=lang("VER_PLEASE");?></p>
		<form action="forgot_password_reset.php?reset=1" method="post">
			<?php if(!$errors=='') {?><div class="alert alert-danger"><?=display_errors($errors);?></div><?php } ?>

			<div class="md-form mb-0"><i class="fas fa-key prefix white-text"></i>
				<input type="password" name="password" value="" id="password" class="form-control" autocomplete="new-password" autofocus>
				<label for="orangeForm-name">Password</label></div>
			<div class="md-form mb-0"><i class="fas fa-key prefix white-text"></i>
				<input type="password" name="confirm" value="" id="confirm" class="form-control" autocomplete='new-password'>
				<label for="orangeForm-name">Confirm Password</label></div>
			<input type="hidden" name="csrf" value="<?=Token::generate();?>">
			<input type="hidden" name="email" value="<?=$email;?>">
			<input type="hidden" name="vericode" value="<?=$vericode;?>">
			<input type="submit" name="resetPassword" value="<?=lang("GEN_RESET");?>" class="btn btn-primary">
		</form>
		<br />
	</div><!-- /.col -->
</div><!-- /.row --></div></div></div>
