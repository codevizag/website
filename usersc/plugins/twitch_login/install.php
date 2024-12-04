<?php
require_once("init.php");
//For security purposes, it is MANDATORY that this page be wrapped in the following
//if statement. This prevents remote execution of this code.
if (in_array($user->data()->id, $master_account)){


$db = DB::getInstance();
include "plugin_info.php";



//all actions should be performed here.
$check = $db->query("SELECT * FROM us_plugins WHERE plugin = ?",array($plugin_name))->count();
if($check > 0){
	err($plugin_name.' has already been installed!');
}else{
	$db->query("ALTER TABLE settings ADD twlogin BOOLEAN");
	$db->query("ALTER TABLE settings ADD twclientid varchar(255)");
	$db->query("ALTER TABLE settings ADD twclientsecret varchar(255)");
	$db->query("ALTER TABLE settings ADD twcallback varchar(255)");
	$db->query("ALTER TABLE settings ADD twredirect varchar(255)");
	$db->query("ALTER TABLE users ADD tw_uid varchar(255)");
	$db->query("ALTER TABLE users ADD tw_uname varchar(255)");
	
	$full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$path = explode("users/", $full_url);
	$url_path = $path[0] . "usersc/plugins/twitch_login/assets/oauth_success.php";
	
	$db->update('settings', 1, ["twcallback"=>$url_path,"twlogin"=>0]);
	
 $fields = array(
	 'plugin'=>$plugin_name,
	 'status'=>'installed',
 );
 $db->insert('us_plugins',$fields);
 if(!$db->error()) {
	 	err($plugin_name.' installed');
		logger($user->data()->id,"USPlugins",$plugin_name." installed");
 } else {
	 	err($plugin_name.' was not installed');
		logger($user->data()->id,"USPlugins","Failed to to install plugin, Error: ".$db->errorString());
 }
}

//do you want to inject your plugin in the middle of core UserSpice pages?
$hooks = [];

//The format is $hooks['userspicepage.php']['position'] = path to filename to include
//Note you can include the same filename on multiple pages if that makes sense;
//postion options are post,body,form,bottom
//See documentation for more information
$hooks['login.php']['bottom'] = 'hooks/loginbody.php';
$hooks['join.php']['body'] = 'hooks/loginbody.php';

registerHooks($hooks,$plugin_name);

} //do not perform actions outside of this statement
