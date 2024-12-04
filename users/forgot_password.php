<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!securePage($_SERVER['PHP_SELF'])){die();}

if(ipCheckBan()){Redirect::to($us_url_root.'usersc/scripts/banned.php');die();}
$error_message = null;
$errors = array();
$email_sent=FALSE;

$token = Input::get('csrf');
if(Input::exists()){
    if(!Token::check($token)){
        include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
    }
}

if (Input::get('forgotten_password')) {
    $email = Input::get('email');
    $fuser = new User($email);
    //validate the form
    $validate = new Validate();
    $msg1 = lang("GEN_EMAIL");
    $validation = $validate->check($_POST,array('email' => array('display' => $msg1,'valid_email' => true,'required' => true,),));

    if($validation->passed()){
        if($fuser->exists()){
          $vericode=randomstring(15);
          $vericode_expiry=date("Y-m-d H:i:s",strtotime("+$settings->reset_vericode_expiry minutes",strtotime(date("Y-m-d H:i:s"))));
          $db->update('users',$fuser->data()->id,['vericode' => $vericode,'vericode_expiry' => $vericode_expiry]);
            //send the email
            $options = array(
              'fname' => $fuser->data()->fname,
              'email' => rawurlencode($email),
              'vericode' => $vericode,
              'reset_vericode_expiry' => $settings->reset_vericode_expiry
            );
            $subject = lang("PW_RESET");
            $encoded_email=rawurlencode($email);
            $body =  email_body('_email_template_forgot_password.php',$options);
            $email_sent=email($email,$subject,$body);
            logger($fuser->data()->id,"User","Requested password reset.");
            if(!$email_sent){
                $errors[] = lang("ERR_EMAIL");
            }
        }else{
            $errors[] = lang("ERR_EM_DB");
        }
    }else{
        //display the errors
        $errors = $validation->errors();
    }
}
?>
<?php
if ($user->isLoggedIn()) $user->logout();
?>
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
</style>
<br>
<div id="page-wrapper">
<div class="container">
    <div class="jumbotron">
<?php

if($email_sent){
    require $abs_us_root.$us_url_root.'users/views/_forgot_password_sent.php';
}else{
    require $abs_us_root.$us_url_root.'users/views/_forgot_password.php';
}

?>
</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- footer -->
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
