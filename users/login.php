<?php
ini_set("allow_url_fopen", 1);
if(isset($_SESSION)){session_destroy();}
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
$hooks =  getMyHooks();
includeHook($hooks,'pre');
?>
<?php
if(ipCheckBan()){Redirect::to($us_url_root.'users/banned');die();}
$errors = $successes = [];
if (Input::get('err') != '') {
    $errors[] = Input::get('err');
}
$reCaptchaValid=FALSE;
if($user->isLoggedIn()) Redirect::to($us_url_root.'users/account');

if (!empty($_POST['login_hook'])) {
  $token = Input::get('csrf');
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

  //Check to see if recaptcha is enabled
  if($settings->recaptcha == 1){
  if(!function_exists('post_captcha')){
    function post_captcha($user_response) {
    global $settings;
    $fields_string = '';
    $fields = array(
        'secret' => $settings->recap_private,
        'response' => $user_response
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}
}

// Call the function post_captcha
$res = post_captcha($_POST['g-recaptcha-response']);

if (!$res['success']) {
    // What happens when the reCAPTCHA is not properly set up
    echo 'reCAPTCHA error: Check to make sure your keys match the registered domain and are in the correct locations. You may also want to doublecheck your code for typos or syntax errors.';
}else{
 $reCaptchaValid=TRUE;
}
}
  if($reCaptchaValid || $settings->recaptcha == 0 || $settings->recaptcha == 2 ){ //if recaptcha valid or recaptcha disabled

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array('display' => 'Username','required' => true),
      'password' => array('display' => 'Password', 'required' => true)));
      //plugin goes here with the ability to kill validation
      includeHook($hooks,'post');
      if ($validation->passed()) {
        //Log user in
        $remember = false;
        $user = new User();
        $login = $user->loginEmail(Input::get('username'), trim(Input::get('password')), $remember);
        if ($login) {
          $hooks =  getMyHooks(['page'=>'loginSuccess']);
          includeHook($hooks,'body');
          $dest = sanitizedDest('dest');
              # if user was attempting to get to a page before login, go there
              $_SESSION['last_confirm']=date("Y-m-d H:i:s");

              if (!empty($dest)) {
                $redirect=html_entity_decode(Input::get('redirect'));
                if(!empty($redirect) || $redirect!=='') Redirect::to($redirect);
                else Redirect::to($dest);
              } elseif (file_exists($abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php')) {

                # if site has custom login script, use it
                # Note that the custom_login_script.php normally contains a Redirect::to() call
                require_once $abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php';
              } else {
                if (($dest = Config::get('homepage')) ||
                ($dest = 'account')) {
                  #echo "DEBUG: dest=$dest<br />\n";
                  #die;
                  Redirect::to($dest);
                }
              }

          } else {
            $eventhooks =  getMyHooks(['page'=>'loginFail']);
            includeHook($eventhooks,'body');
            logger("0","Login Fail","A failed login on login.php");
            $msg = lang("SIGNIN_FAIL");
            $msg2 = lang("SIGNIN_PLEASE_CHK");
            $errors[] = '<strong>'.$msg.'</strong>'.$msg2;
          }
        }
      }
    }
    if (empty($dest = sanitizedDest('dest'))) {
      $dest = '';
    }
    $token = Token::generate();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/font-awesome.min.css">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <style media="screen">



  body{background: url("images/404.jpg")no-repeat center center;
              -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;}

        

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
        
        
    </style>
  

</head>


<body class="creative-lp">

    <!--Main Navigation-->
    <header>

        


        <!--Intro Section--><form name="login" id="login-form" class="form-signin" action="login" method="post">
        <section class="view intro-3">
            <div class="mask h-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">

                            <!--Form with header-->
                            <div class="card wow fadeIn" data-wow-delay="0.3s">
                                <div class="card-body">

                                    <!--Header-->
                                    <div class="form-header pink-gradient">
                                        <h3>
                                            <i class="fas fa-user mt-2 mb-2"></i> Log in</h3>
                                    </div>

                                    <!--Body-->
                                    <?=resultBlock($errors,$successes);?>
                                    <br>

                                    <div class="md-form mb-0">
                                        <i class="fas fa-user prefix white-text"></i>
                                        <input type="text" name="username" id="username" class="form-control" required autofocus>
                                        <label for="orangeForm-name">Your Username</label>
                                    </div>


                                    <div class="md-form mb-0">
                                        <i class="fas fa-lock prefix white-text"></i>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                        <label for="orangeForm-pass">Your password</label>
                                    </div>
                <div class="md-form mb-0">
                <label for="remember">
                <input type="checkbox" name="remember" id="remember" > <?=lang("SIGNIN_REMEMBER")?></label>
                </div><br><br>

                <input type="hidden" name="login_hook" value="1">
                <input type="hidden" name="csrf" value="<?=$token?>">
                <input type="hidden" name="redirect" value="<?=Input::get('redirect')?>" />

                                    <div class="text-center">
                                        <button class="btn pink-gradient btn-lg" id="next_button" type="submit">Sign In</button>
                                        <br><br><font color="#fff"><h4>Or Sign-In With</h4></font>
                                        <center><?php
                                    includeHook($hooks,'body');
                                    ?><?php   includeHook($hooks,'bottom');?><?php languageSwitcher();?>
                                    </center><br>
                                        <a class="pull-left" href='../users/forgot_password'><i class="fa fa-wrench"></i> <?=lang("SIGNIN_FORGOTPASS","");?></a>
                                          <?php if($settings->registration==1) {?>
                                            <a class="pull-right" href='../users/join'><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_TEXT","");?></a><?php } ?>

                                        <?php
                if($settings->recaptcha == 1){
                  ?>
                  <div class="g-recaptcha" data-sitekey="<?=$settings->recap_public; ?>" data-bind="next_button" data-callback="submitForm">
                  </div>
                <?php } ?></div></div> </div><!--/Form with header--></div></div></div></div></section></form>

    </header>
    <!--Main Navigation-->
        <?php require_once $abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/container_close.php'; //custom template container ?>

        <!-- footers -->
        <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

        <!-- Place any per-page javascript here -->

        <?php   if($settings->recaptcha == 1){ ?>
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>
          <script>
          function submitForm() {
            document.getElementById("login-form").submit();
          }
          </script>
              <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script>
        new WOW().init();
    </script>
        <?php } ?>
        <?php require_once $abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/footer.php'; //custom template footer?>