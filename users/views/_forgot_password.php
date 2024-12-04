
<div class="row">
	<div class="col-sm-12">
		<h1><?=lang("PW_RESET");?></h1><br>
		<font color="#000">
			&#9673; Enter Your E-Mail Address & Click Reset.<br>
			&#9673; Check Your E-Mail & Click The Link That Is Sent To You.<br>
			&#9673; Follow The On Screen Instructions !<br></font><br>
		
		<?php if(!$errors=='') {?><div class="alert alert-danger"><?=display_errors($errors);?></div><?php } ?>
		<form action="forgot_password.php" method="post" class="form ">

			<div class="md-form mb-0"><i class="fas fa-envelope prefix white-text"></i>
				<input type="text" name="email" class="form-control" autofocus autocomplete='email'>
			<label for="orangeForm-name">Your E-Mail</label></div>

			<input type="hidden" name="csrf" value="<?=Token::generate();?>">
			<p><input type="submit" name="forgotten_password" value="<?=lang("GEN_RESET");?>" class="btn btn-primary"></p>
		</form>

	</div><!-- /.col -->
</div><!-- /.row -->
