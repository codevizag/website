<?php

if(file_exists($abs_us_root.$us_url_root.'usersc/includes/footer.php')){
  require_once $abs_us_root.$us_url_root.'usersc/includes/footer.php';
}

//Plugin hooks
foreach($usplugins as $k=>$v){
  if($v == 1){
  if(file_exists($abs_us_root.$us_url_root."usersc/plugins/".$k."/footer.php")){
    include($abs_us_root.$us_url_root."usersc/plugins/".$k."/footer.php");
    }
  }
}

require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php';

?>


  </body>
</html>
