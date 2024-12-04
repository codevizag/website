<?php
$db = DB::getInstance();
$settings = $db->query("SELECT * FROM settings")->first();

require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/custom.php'; //custom template header