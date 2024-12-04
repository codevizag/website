<?php
require_once '../users/init.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
$hooks =  getMyHooks();
includeHook($hooks,'pre');

if(!empty($_POST['uncloak'])){
	logger($user->data()->id,"Cloaking","Attempting Uncloak");
	if(isset($_SESSION['cloak_to'])){
		$to = $_SESSION['cloak_to'];
		$from = $_SESSION['cloak_from'];
		unset($_SESSION['cloak_to']);
		$_SESSION['user'] = $_SESSION['cloak_from'];
		unset($_SESSION['cloak_from']);
		logger($from,"Cloaking","uncloaked from ".$to);
		Redirect::to($us_url_root.'users/admin.php?view=users&err=You+are+now+you!');
		}else{
			Redirect::to($us_url_root.'users/logout.php?err=Something+went+wrong.+Please+login+again');
		}
}


//dealing with if the user is logged in
if($user->isLoggedIn() || !$user->isLoggedIn() && !checkMenu(2,$user->data()->id)){
	if (($settings->site_offline==1) && (!in_array($user->data()->id, $master_account)) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')){
		$user->logout();
		logger($user->data()->id,"Errors","Sending to Maint");
		Redirect::to($us_url_root.'users/maintenance.php');
	}
}
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$get_info_id = $user->data()->id;
// $groupname = ucfirst($loggedInUser->title);
$raw = date_parse($user->data()->join_date);
$signupdate = $raw['month']."/".$raw['day']."/".$raw['year'];
$userdetails = fetchUserDetails(NULL, NULL, $get_info_id); //Fetch user details
?>
<br><br>


<style type="text/css">
	  body{
	  	background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
}
</style>
<div class="mask rgba-gradient-1">
<div id="page-wrapper">
<div class="container">
	<div class="jumbotron">
<div class="well">
<div class="row">
	<div class="col-sm-12 col-md-3">
		<p>
		</p>
		<p>
			<?php
			if(isset($user->data()->steam_avatar) && $user->data()->steam_avatar != ''){
				$grav = $user->data()->steam_avatar;
			}elseif(isset($user->data()->picture) && $user->data()->picture != ''){
				$grav = $user->data()->picture;
			}
			?>
			<img src="<?=$grav; ?>" class="img-thumbnail" alt="Generic placeholder thumbnail"></p>
		<p><a href="<?=$us_url_root.'users/user_settings'?>" class="btn btn-primary btn-block"><?=lang("ACCT_EDIT")?></a></p>
	<?php if(isset($_SESSION['cloak_to'])){ ?>
		<form class="" action="account" method="post">
			<input type="submit" name="uncloak" value="Uncloak!" class='btn btn-danger btn-block'>
		</form><br>
		<?php }
		?>
		<?php includeHook($hooks,'body');?>
	</div>
	<div class="col-sm-12 col-md-9"><font size="6.5" color="#000"><b><u>Your Profile Data</u></b></font><br>
		<ul><font color="#000">

 	<li><b>Username : <?=echousername($user->data()->id)?></b></li>
 	<li><b>Your ID Number : <?=ucfirst($user->data()->id) ?></b></li>
 	<li><b>Full Name : 
 		<?=ucfirst($user->data()->fname)." ".ucfirst($user->data()->lname) ?></b></li>
 	<li><b>First Name : <?=ucfirst($user->data()->fname) ?></b></li>
 	<li><b>Last Name : <?=ucfirst($user->data()->lname) ?></b></li>
	<li><b>E-Mail Address : <?=ucfirst($user->data()->email) ?></b></li>
	<li><b>Member Since : <?=$signupdate?></b></li>
	<li><b>Number Of Logins : <?=$user->data()->logins?></b></li>
	<li><b>Last Login : <?=$user->data()->last_login?></b></li>
	<?php if($settings->session_manager==1) {?>
	<li><b>Number of Active Sessions : <?=UserSessionCount()?></b></li> <?php } ?>
								</font></ul>
		<?php
		includeHook($hooks,'bottom');?>
	</div>

</div>

</div>
	<?php languageSwitcher(); ?><br><br><br><br>
</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->

<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
