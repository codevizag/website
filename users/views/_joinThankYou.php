
<style type="text/css">
	  body{
	  	background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
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
</style><br><br><br><br>
<div id="page-wrapper">
<div class="container">
	<div class="jumbotron">
<div class="row">
  <div class="col-sm-12"><center>
    <h1><div class="text1">Welcome To</div><div class="text2">Codevizag Academy</div></h1>
    <p style="color: #fff">Thanks For Registering !</p>
    <a href="login.php" class="btn btn-primary"><?=lang("SIGNIN_TEXT")?></a></center>
    <br /><br />
  </div></div></div></div></div><br><br><br>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="<?=$us_url_root?>js/functions.js"></script>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>