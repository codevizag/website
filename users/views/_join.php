<div class="row">
  <div class="col-sm-12">
    <?php
    if (!$form_valid && Input::exists()){?>
      <?php if(!$validation->errors()=='') {?><div class="alert alert-danger"><?=display_errors($validation->errors());?></div><?php } ?>
    <?php }
    ?>
    
    <form class="form-signup" action="<?=$form_action;?>" method="<?=$form_method;?>" id="payment-form">

      <h2 class="form-signin-heading"> <?=lang("SIGNUP_TEXT","");?></h2>


      <div class="md-form mb-0">
        <i class="fas fa-user prefix white-text"></i>
        <input type="text" style="width: 70%" class="form-control" id="username" name="username" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" required autofocus autocomplete="username"><label for="orangeForm-name">Your Username</label></div>



        <div class="md-form mb-0"><i class="fas fa-user-secret prefix white-text"></i>
        <input type="text" style="width: 70%" class="form-control" id="fname" name="fname"  value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required autocomplete="first-name"><label for="orangeForm-name">First Name</label></div>




        <div class="md-form mb-0"><i class="fas fa-user-secret prefix white-text"></i>
        <input type="text" style="width: 70%" class="form-control" id="lname" name="lname" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required autocomplete="family-name"><label for="orangeForm-name">Last Name</label></div>




        <div class="md-form mb-0"><i class="fas fa-envelope prefix white-text"></i>
        <input style="width: 70%" class="form-control" type="email" name="email" id="email"  value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required autocomplete="email"><label for="orangeForm-name">Your E-Mail</label></div>

        <?php

        $character_range = lang("GEN_MIN")." ".$settings->min_pw . " ". lang("GEN_AND") ." ". $settings->max_pw . " " .lang("GEN_MAX")." ".lang("GEN_CHAR");
        $character_statement = '<span id="character_range" class="gray_out_text">' . $character_range . ' </span>';

        if ($settings->req_cap == 1){
          $num_caps = '1'; //Password must have at least 1 capital
          if($num_caps != 1){
            $num_caps_s = 's';
          }
          $num_caps_statement = '<span id="caps" class="gray_out_text">'.lang("JOIN_HAVE") . $num_caps . lang("JOIN_CAP") .'</span>';
        }

        if ($settings->req_num == 1){
          $num_numbers = '1'; //Password must have at least 1 number
          if($num_numbers != 1){
            $num_numbers_s = 's';
          }

          $num_numbers_statement = '<span id="number" class="gray_out_text">'.lang("JOIN_HAVE") . $num_numbers . lang("GEN_NUMBER") .'</span>';
        }
        $password_match_statement = '<span id="password_match" class="gray_out_text">'.lang("JOIN_TWICE").'</span>';


        //2.) Apply default class to gray out green check icon
        echo '
        <style>
        .gray_out_icon{
          -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
          filter: grayscale(100%);
        }
        .gray_out_text{
          opacity: .5;
        }
        </style>
        ';

        //3.) Javascript to check to see if user has met conditions on keyup (NOTE: It seems like we shouldn't have to include jquery here because it's already included by UserSpice, but the code doesn't work without it.)
        echo '
        <script type="text/javascript">
        $(document).ready(function(){

          $( "#password" ).keyup(function() {
            var pswd = $("#password").val();

            //validate the length
            if ( pswd.length >= ' . $settings->min_pw . ' && pswd.length <= ' . $settings->max_pw . ' ) {
              $("#character_range_icon").removeClass("gray_out_icon");
              $("#character_range").removeClass("gray_out_text");
            } else {
              $("#character_range_icon").addClass("gray_out_icon");
              $("#character_range").addClass("gray_out_text");
            }

            //validate capital letter
            if ( pswd.match(/[A-Z]/) ) {
              $("#num_caps_icon").removeClass("gray_out_icon");
              $("#caps").removeClass("gray_out_text");
            } else {
              $("#num_caps_icon").addClass("gray_out_icon");
              $("#caps").addClass("gray_out_text");
            }

            //validate number
            if ( pswd.match(/\d/) ) {
              $("#num_numbers_icon").removeClass("gray_out_icon");
              $("#number").removeClass("gray_out_text");
            } else {
              $("#num_numbers_icon").addClass("gray_out_icon");
              $("#number").addClass("gray_out_text");
            }
          });

          $( "#confirm" ).keyup(function() {
            var pswd = $("#password").val();
            var confirm_pswd = $("#confirm").val();

            //validate password_match
            if (pswd == confirm_pswd) {
              $("#password_match_icon").removeClass("gray_out_icon");
              $("#password_match").removeClass("gray_out_text");
            } else {
              $("#password_match_icon").addClass("gray_out_icon");
              $("#password_match").addClass("gray_out_text");
            }

          });
        });
        </script>
        ';

        ?>

        <div style="display: inline-block">
          <div class="md-form mb-0"><i class="fas fa-key prefix white-text"></i>
          <input  class="form-control" type="password" name="password" id="password"  required autocomplete="password" aria-describedby="passwordhelp"><label for="orangeForm-name">Password</label></div>

          <div class="md-form mb-0"><i class="fas fa-key prefix white-text"></i>
          <input  type="password" id="confirm" name="confirm" class="form-control"  required autocomplete="password" >
          <label for="orangeForm-name">Con. Password</label></div>
        </div>
        <div style="display: inline-block; padding-left: 20px">
          <strong><?=lang("PW_SHOULD");?></strong><br>
          <span id="character_range_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $character_statement;?>
          <br>
          <?php
          if ($settings->req_cap == 1){ ?>
            <span id="num_caps_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_caps_statement;?>
            <br>
          <?php }

          if ($settings->req_num == 1){ ?>
            <span id="num_numbers_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_numbers_statement;?>
            <br>
          <?php } ?>
          <span id="password_match_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $password_match_statement;?>
          <br><br>
          <a class="nounderline" id="password_view_control"><span class="fa fa-eye"></span> <?=lang("PW_SHOWS");?></a>
        </div>
        <br>

        <?php
        includeHook($hooks,'form');
        include($abs_us_root.$us_url_root.'usersc/scripts/additional_join_form_fields.php'); ?>
        <?php if($settings->show_tos == 1){ ?><br>
          <label style="color: #fff"><input type="checkbox" id="agreement_checkbox" name="agreement_checkbox"> By Signing Up, I Accept The <a style="color: #fff" href="<?=$us_url_root?>users/T&Cs"><u>Terms & Conditions</u></a> Of This Website.</label>
        <?php } //if TOS enabled ?>
      <input type="hidden" value="<?=Token::generate();?>" name="csrf">
      <br><button class="submit btn btn-primary " type="submit" id="next_button"><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_TEXT");?></button>
      
      <?php if($settings->recaptcha == 1|| $settings->recaptcha == 2){ ?>
        <div class="g-recaptcha" data-sitekey="<?=$settings->recap_public; ?>" data-bind="next_button" data-callback="submitForm"></div>
      <?php } ?>
    </div>
    </form>

  </div>
</div>
