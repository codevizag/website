<?php require_once($abs_us_root.$us_url_root.'users/includes/template/header1_must_include.php'); ?>


<style media="screen">
html,
body {
  margin: 0;
  height: 100%;
}

.wrapper {
  box-sizing: border-box;
  position: relative;
  padding-bottom: 1em; /* Height of footer */
  min-height: 100%;
}



footer {
  bottom: 0;
  width: 100%;
}
</style>
<?php include "color_override.php";?>

<script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>


<?php
//optional
if(file_exists($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'.css')){?> <link href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>.css" rel="stylesheet"> <?php } ?>

</head>
<?php require_once($abs_us_root.$us_url_root.'users/includes/template/header3_must_include.php'); ?>
