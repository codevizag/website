<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '256684718065631',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<?php
$db=DB::getInstance();

$settingsQ=$db->query("SELECT * FROM settings");
$settings=$settingsQ->first();

$appID=$settings->fbid;
$secret=$settings->fbsecret;
$version=$settings->graph_ver;
$callback=$settings->fbcallback;

if(!isset($_SESSION)){session_start();}
require_once($abs_us_root.$us_url_root."usersc/plugins/facebook_login/assets/Facebook/autoload.php");
$fb = new Facebook\Facebook([
  'app_id' => $appID,
  'app_secret' => $secret,
  'default_graph_version' => $version,
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl($callback, $permissions);
?>
<a href="<?=htmlspecialchars($loginUrl)?>">
  <img class="img-responsive"  width="60%" src="<?=$us_url_root?>usersc/plugins/facebook_login/assets/facebook.png" alt="Sign-In With Facebook"/></a>
