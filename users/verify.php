<?php


require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if(ipCheckBan()){Redirect::to($us_url_root.'usersc/scripts/banned.php');die();}
$new=Input::get('new');
if($new!=1) if($user->isLoggedIn()) $user->logout();

$verify_success=FALSE;

$errors = array();
if(Input::exists('get')){

	$email = Input::get('email');
	$vericode = Input::get('vericode');

	$validate = new Validate();
	$validation = $validate->check($_GET,array(
	'email' => array(
	  'display' => lang("GEN_EMAIL"),
	  'valid_email' => true,
	  'required' => true,
	),
	));
	if($validation->passed()){ //if email is valid, do this
		//get the user info based on the email
		$verify = new User(Input::get('email'));
		if($verify->data()->email_verified == 1 && $verify->data()->vericode == $vericode){
			//email is already verified - Basically if the system already shows the email as verified and they click the link again, we're going to pass it regardless of the expiry because
			//the hassle of telling people verification failed (after previously successful is worse than what could go wrong)
			require $abs_us_root.$us_url_root.'users/views/_verify_success.php';


		}elseif($verify->data()->email_verified != 1 && $verify->data()->vericode_expiry == "0000-00-00 00:00:00"){
			//in the unlikely event someone has a blank vericode expiry, we're going to generate a new one
			$vericode_expiry=date("Y-m-d H:i:s",strtotime("+$settings->join_vericode_expiry hours",strtotime(date("Y-m-d H:i:s"))));

			echo lang("ERR_EMAIL_STR");
			$verify->update(array('email_verified' => 0,'vericode' => randomstring(15),'vericode_expiry' => $vericode_expiry),$verify->data()->id);
			require $abs_us_root.$us_url_root.'users/views/_verify_resend.php';
		}else{
		if ($verify->exists() && $verify->data()->vericode == $vericode && (strtotime($verify->data()->vericode_expiry) - strtotime(date("Y-m-d H:i:s")) > 0)){
			//check if this email account exists in the DB
			if($new==1 && !$verify->data()->email_new == NULL)	$verify->update(array('email_verified' => 1,'vericode' => randomstring(15),'vericode_expiry' => date("Y-m-d H:i:s"),'email' => $verify->data()->email_new,'email_new' => NULL),$verify->data()->id);
			else $verify->update(array('email_verified' => 1,'vericode' => randomstring(15),'vericode_expiry' => date("Y-m-d H:i:s")),$verify->data()->id);
			$verify_success=TRUE;
			logger($verify->data()->id,"User","Verification completed via vericode.");
			$msg = lang("REDIR_EM_SUCC");
			if($new==1){Redirect::to($us_url_root.'users/user_settings.php?msg=Email Updated Successfully');}
		}
	}
	}else{
		$errors = $validation->errors();
	}
}

?>

<div id="page-wrapper">
<div class="container">

<?php

if ($verify_success){
	require $abs_us_root.$us_url_root.'users/views/_verify_success.php';
}else{
	require $abs_us_root.$us_url_root.'users/views/_verify_error.php';
}

?><br />
</div>
</div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

  <!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
