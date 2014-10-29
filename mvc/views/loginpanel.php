<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assert/css/userpanel.css" />

<div id="userpanel" >
<form method="post" action="<?php echo base_url(); ?>index.php/login/submit">
	Username  <input type="text" name="username">
	<br>
	Password
	<input type="text" name="password">
    <br>

	<br>
	<input name="login" type="submit" value="!!! LOGIN !!!">
	<input type="button" onClick="window.location.href='<?php echo base_url(); ?>index.php/register'" value="!!! REGISTER !!!">		
</form>

</div>