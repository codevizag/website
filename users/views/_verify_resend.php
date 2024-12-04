
<div class="row">
  <div class="col-sm-12">
    <h2>Verify Your E-Mail</h2><br>
    <font color="#000">
      &#9673; Enter your email address and try again<br>
      &#9673; Check your email and click the link that is sent to you<br>
      &#9673; Done<br></font><font color="#fff">
    <form class="form" action="verify_resend" method="post">
      <?php if(!$errors=='') {?><div class="alert alert-danger"><?=display_errors($errors);?></div><?php } ?>
      <div class="md-form mb-0"><i class="fas fa-envelope prefix white-text"></i>
        <input class="form-control" type="text" id="email" name="email" autocomplete="email">
        <label for="orangeForm-name">Your E-Mail</label></div>
      <input type="hidden" name="csrf" value="<?=Token::generate();?>">
      <input type="submit" value="<?=lang("VER_RESEND");?>" class="btn btn-primary">
    </form><br />
  </div>
</div>
