<?php
if($settings->navigation_type==0) {
$query = $db->query("SELECT * FROM email");
$results = $query->first();

//Value of email_act used to determine whether to display the Resend Verification link
$email_act=$results->email_act;

// Set up notifications button/modal
if ($user->isLoggedIn()) {
    if ($dayLimitQ = $db->query('SELECT notif_daylimit FROM settings', array())) $dayLimit = $dayLimitQ->results()[0]->notif_daylimit;
    else $dayLimit = 7;

    // 2nd parameter- true/false for all notifications or only current
	$notifications = new Notification($user->data()->id, false, $dayLimit);
}

?>
<!-- Navigation -->
<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header ">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-top-menu-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="" href="<?=$us_url_root?>"><img class="img-responsive" src="<?=$us_url_root?>users/images/logo.png" alt="Codevizag Academy" /></a>
		</div>
		<div class="collapse navbar-collapse navbar-top-menu-collapse navbar-right">
					<ul class="nav navbar-nav ">

				<?php if($user->isLoggedIn()){ //anyone is logged in?>
					<li><a href="<?=$us_url_root?>users/account"><i class="fa fa-fw fa-user"></i> <?php echo echousername($user->data()->id);?></a></li> <!-- Common for Hamburger and Regular menus link -->
					<?php if($settings->notifications==1) {?>
            <?php /*<li><a href="portal/'.PAGE_PATH.'#" id="notificationsTrigger" data-toggle="modal" data-target="#notificationsModal"><i class="fa fa-bell"></i> <span id="notifCount" class="badge" style="margin-top: -5px"><?= (($notifications->getUnreadCount() > 0) ? $notifications->getUnreadCount() : ''); ?></span></a></li>*/?>

			<li><a href="#" onclick="displayNotifications('new')" id="notificationsTrigger" data-toggle="modal" data-target="#notificationsModal"  ><i class="fa fa-bell"></i> <span id="notifCount" class="badge" style="margin-top: -5px"><?= (int)$notifications->getUnreadCount(); ?></span></a></li>
          <?php } ?>
					<?php if($settings->messaging == 1){ ?>
						<li><a href="<?=$us_url_root?>users/messages"><i class="fa fa-envelope"></i> <span id="msgCount" class="badge" style="margin-top: -5px"><?php if($msgC > 0){ echo $msgC;}?></span></a></li>
					<?php } ?>

<?php //require_once $abs_us_root.$us_url_root.'usersc/includes/navigation_right_side.php'; ?>

					 <!-- Hamburger menu link -->
					<?php if (checkMenu(2,$user->data()->id)){  //Links for permission level 2 (default admin) ?>
						<li class="hidden-sm hidden-md hidden-lg"><a href="<?=$us_url_root?>users/admin"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a></li> <!-- Hamburger menu link -->
						<li class="hidden-sm hidden-md hidden-lg"><a href="<?=$us_url_root?>users/admin?view=users"><i class="fa fa-user"></i> User Management</a></li> <!-- Hamburger menu link -->
						<li class="hidden-sm hidden-md hidden-lg"><a href="<?=$us_url_root?>users/admin?view=permissions"><i class="fa fa-lock"></i> User Permissions</a></li> <!-- Hamburger menu link -->
						<li class="hidden-sm hidden-md hidden-lg"><a href="<?=$us_url_root?>users/admin?view=pages"><i class="fa fa-wrench"></i> System Pages</a></li> <!-- Hamburger menu link -->
						<li class="hidden-sm hidden-md hidden-lg"><a href="<?=$us_url_root?>users/admin?view=messages"><i class="fa fa-envelope"></i> Messages Admin</a></li> <!-- Hamburger menu link -->
						<li class="hidden-sm hidden-md hidden-lg"><a href="<?=$us_url_root?>users/admin?view=logs"><i class="fa fa-search"></i> System Logs</a></li> <!-- Hamburger menu link -->
					<?php } // is user an admin ?>
					<li class="dropdown hidden-xs"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-fw fa-cog"></i><b class="caret"></b></a> <!-- regular user menu -->
						<ul class="dropdown-menu"> <!-- open tag for User dropdown menu -->
							<li><a href="<?=$us_url_root?>"><i class="fa fa-fw fa-home"></i> Home</a></li> <!-- regular user menu link -->
							<li><a href="<?=$us_url_root?>users/account"><i class="fa fa-fw fa-user"></i> Account</a></li>

<?php //require_once $abs_us_root.$us_url_root.'usersc/includes/navigation_dropdown.php'; ?>
							<!-- regular user menu link -->

							<?php if (checkMenu(2,$user->data()->id)){  //Links for permission level 2 (default admin) ?>
								<li class="divider"></li>
								<li><a href="<?=$us_url_root?>users/admin"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a></li> <!-- regular Admin menu link -->
								<li><a href="<?=$us_url_root?>users/admin?view=users"><i class="fa fa-user"></i> User Management</a></li>
								<li><a href="<?=$us_url_root?>users/admin?view=permissions"><i class="fa fa-lock"></i> Page Permissions</a></li>
								<li><a href="<?=$us_url_root?>users/admin?view=pages"><i class="fa fa-wrench"></i> Page Management</a></li>
								<li><a href="<?=$us_url_root?>users/admin?view=messages"><i class="fa fa-envelope"></i> Message System</a></li>
								<li><a href="<?=$us_url_root?>users/admin?view=logs"><i class="fa fa-search"></i> System Logs</a></li>
							<?php } // is user an admin ?>
							<li class="divider"></li>
							<li><a href="<?=$us_url_root?>users/logout"><i class="fa fa-fw fa-sign-out"></i> Logout</a></li> <!-- regular Logout menu link -->
						</ul> <!-- close tag for User dropdown menu -->
					</li>

					<li class="hidden-sm hidden-md hidden-lg"><a href="<?=$us_url_root?>users/logout"><i class="fa fa-fw fa-sign-out"></i> Logout</a></li> <!-- regular Hamburger logout menu link -->

				<?php }else{ // no one is logged in so display default items ?>
					<li><a href="<?=$us_url_root?>users/login" class=""><i class="fa fa-sign-in"></i> Login</a></li>
					<li><a href="<?=$us_url_root?>users/join" class=""><i class="fa fa-plus-square"></i> Register</a></li>
					<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-life-ring"></i> Help <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?=$us_url_root?>users/forgot_password"><i class="fa fa-wrench"></i> Forgot Password</a></li>
							<?php if ($email_act){ //Only display following menu item if activation is enabled ?>
								<li><a href="<?=$us_url_root?>users/verify_resend"><i class="fa fa-exclamation-triangle"></i> Resend Activation Email</a></li>
							<?php }?>
						</ul>
					</li>
				<?php } //end of conditional for menu display ?>
				</ul> <!-- End of UL for navigation link list -->
				</div> <!-- End of Div for right side navigation list -->

		<?php require_once $abs_us_root.$us_url_root.'usersc/includes/navigation.php';?>

	</div> <!-- End of Div for navigation bar -->
</nav> <!-- End of Div for navigation bar styling -->
<?php } if($settings->navigation_type==1) {?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/database-navigation.php'; ?>
<?php } ?>
