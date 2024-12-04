<?php

$db=DB::getInstance();

$settingsQ=$db->query("SELECT * FROM settings");
$settings=$settingsQ->first();

$clientId=$settings->twclientid;
$secret=$settings->twclientsecret;
$callback=$settings->twcallback;

if(!isset($_SESSION)){session_start();}
require_once($abs_us_root.$us_url_root."usersc/plugins/twitch_login/assets/twitch.php");

  
$provider = new TwitchProvider([
    'clientId'                => $clientId,     // The client ID assigned when you created your application
    'clientSecret'            => $secret, // The client secret assigned when you created your application
    'redirectUri'             => $callback,  // Your redirect URL you specified when you created your application
    'scopes'                  => ['user:read:email']  // The scopes you would like to request
]);

$loginUrl = $provider->getAuthorizationUrl();
$_SESSION['oauth2state'] = $provider->getState();

?>
<a href="<?=htmlspecialchars($loginUrl)?>">
  <img class="img-responsive" src="<?=$us_url_root?>usersc/plugins/twitch_login/assets/twitch.png" alt="Twitch Login"/></a>
