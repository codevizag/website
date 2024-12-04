<?php require_once($abs_us_root.$us_url_root.'users/includes/template/header1_must_include.php'); ?>
<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Material Design -->
<link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/css/mdb.min.css">
<!-- Custom Extra Styling -->
<link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/css/style.min.css">
<!-- Table Sorting and Such -->
<link href="<?=$us_url_root?>users/css/datatables.css" rel="stylesheet">

<!-- Custom Fonts/Animation/Styling-->
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/font-awesome.min.css">

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
<script src="<?=$us_url_root?>js/jquery.appear.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/css/hamburgers.min.css" rel="stylesheet">
<script type="text/javascript" src="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/js/mdb.min.js"></script>
<?php
//optional
if(file_exists($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'.css')){?> <link href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>.css" rel="stylesheet"> <?php } ?>

</head>
<?php require_once($abs_us_root.$us_url_root.'users/includes/template/header3_must_include.php'); ?>
