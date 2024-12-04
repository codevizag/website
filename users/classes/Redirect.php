<?php
class Redirect {
  public static function to($location = null, $args=''){
    global $us_url_root;
    #die("Redirecting to $location<br />\n");
    if ($location) {
      if (!preg_match('/^https?:\/\//', $location) && !file_exists($location)) {
        foreach (array($us_url_root, '../', 'users/', substr($us_url_root, 1), '../../', '/', '/users/') as $prefix) {
          if (file_exists($prefix.$location)) {
            $location = $prefix.$location;
            $location = preg_replace('~/{2,}~', '/', $location);
            break;
          }
        }
      }
      if ($args) $location .= $args; // allows 'login.php?err=Error+Message' or the like
      if (!headers_sent()){
        header('Location: '.$location);
        exit();
      } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$location.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
        echo '</noscript>'; exit;
      }
    }
  }

}
