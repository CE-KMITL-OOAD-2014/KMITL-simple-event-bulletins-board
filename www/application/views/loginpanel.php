<section id="loginpanel" class="c3 last box ">

        <center><h3>เข้าสู่ระบบ</h3></center>
    <h6> เพื่อสร้างข่าวของคุณเอง<br></h6>
        
<form method="post" class="vform" action="<?php echo base_url(); ?>index.php/login/submit" style="width:90%">
Username <input type="text" name="username">
<br>
Password
<input type="password" name="password">
<br>
<font color="red">
<?php
	if($error === 'NOusername') echo 'username ไม่ถูกต้อง';
	else if($error === 'NOpassword') echo 'password ไม่ถูกต้อง';
	else if($error === 'NOcookie') echo 'กรุณาเข้าสู่ระบบก่อนโพสข้อความ';
?>
</font>
<br>
<br>
<button type="submit" class="c6 first" id="Login">Login</button>
			<button class="c6 first" type="submit" formaction="<?php echo base_url(); ?>index.php/register">Register</buttonr>
</form>

</section>