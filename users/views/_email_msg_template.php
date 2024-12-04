<?php
$db = DB::getInstance();
$query = $db->query("SELECT * FROM email");
$results = $query->first();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#010e28" style="padding: 40px 0 30px 0; color: #010e28; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="https://codevizag.com/images/bg_logo.png" alt="Codevizag Academy" width="300" height="230" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Hello <?=$fname;?>,</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										  <p> <p><a href="<?=$results->verify_url?>users/message.php?id=<?=$msg_thread?>" class="nounderline"><?=lang("EML_REPLY")?></a> </p><?=lang("EML_WHY")?><?=html_entity_decode($body)?></p>
  <p><?=lang("EML_HOW")?></p>
  <p><a href="<?php echo $results->verify_url."users/forgot_password_reset.php?email=".$email."&vericode=$vericode&reset=1"; ?>" class="nounderline"><?=lang("PW_RESET");?></a></p>
  <sup><p><?=lang("EML_EXP")?> <?=$reset_vericode_expiry?> <?=lang("T_MINUTES")?>.</p></sup><br><b>
  Please Note: This E-Mail Was Sent From A Notification-Only Address That Cannot Accept Incoming E-Mail. Please Do Not Reply To This Message.</b>
  <br><br>
  <b>Thanking You,<br>The Codevizag Team</b>
									</td>
								</tr>
								
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&copy; 2017-20 Codevizag Academy<br/>

										<a href="#" style="color: #ffffff;"><font color="#ffffff">Unsubscribe</font></a> To This E-Mail Now.
									</td>
									<td align="right" width="25%">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="http://www.twitter.com/" style="color: #ffffff;">
														<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/tw.gif" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://facebook.com/subhadeepdps" style="color: #ffffff;">
														<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>

















