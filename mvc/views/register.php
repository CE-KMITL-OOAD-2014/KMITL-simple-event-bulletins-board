<script src="<?php echo base_url(); ?>assert/js/jquery.js"></script>

<section class="box">
<div class="row">
	<center><h3>สมัครสมาชิก</h3>
	กรุณากรอกข้อมูลของท่านให้ครบทุกช่อง</center><br><br>
	<form method="post" name="reg" action="<?php echo base_url(); ?>index.php/register/submit" class="vform centered ">
		<label style="width:25%;float:left" >Username</label>
		<div style="width:75%;float:left;margin-bottom:25px" class="row">
			<input name="username" id="username" type="text" onkeyup=resetUsername()>
			<input type="button" value="check" onClick=checkUsername()><span id="chkUsername"> กรุณากรอก username </span>
		</div>	
		<label style="width:25%;float:left">Password</label>
		<div style="width:75%;float:left">
			<input type="password" name="password" id="password"></div>
		<label style="width:25%;float:left">Confirm Password</label>
		<div style="width:75%;float:left;margin-bottom:25px">
			<input type="password" id="repassword" onkeyup=checkPass()><span id="chkPass"></span></div>
		<label style="width:25%;float:left">E-mail Address</label>	
		<div style="width:75%;float:left;margin-bottom:30px">
			<input type="email" name="email" id="email"  onkeyup=resetEmail()>
			<input type="button" value="check" onClick=checkEmail()><span id="chkEmail"> กรุณากรอก Email</span>
		</div>
		<br><br>
		<input type="hidden" id="gColor">
		<input name="register" type="submit" value="Submit" id="submit" disabled="true">
	</form>
</div>

<script>
goodColor = "#66cc66";
badColor = "#ff6666";
resetColor = "#ffffff";
document.getElementById('gColor').style.backgroundColor = goodColor

function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('repassword');
    //Store the Confimation Message Object ...
    var message = document.getElementById('chkPass');
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
		pass1.style.backgroundColor = goodColor;
        pass2.style.backgroundColor = goodColor;
        message.innerHTML = " password นี้สามารถใช้งานได้"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
		pass1.style.backgroundColor = badColor;
        pass2.style.backgroundColor = badColor;
        message.innerHTML = " password ไม่ตรงกัน"
    }
	isCorrectForm()
}  

function checkUsername(){
	var username = document.getElementById('username').value;
	if(username.length > 0){
		$.post('<?php echo base_url()?>index.php/register/tryUsername',{username :username},function(response){
			$('#chkUsername').html(response);
			if (document.getElementById('chkUsername').innerHTML== 'pass') {
				document.getElementById('username').style.backgroundColor = goodColor;
				document.getElementById('chkUsername').innerHTML = ' username นี้สามารถใช้งานได้'; 
			}
			else {
				document.getElementById('username').style.backgroundColor = badColor;
				document.getElementById('chkUsername').innerHTML = ' มี username ในระบบแล้ว'; 
			}
			isCorrectForm()
	});
   }
}

function checkEmail(){
	var email = document.getElementById('email').value;
	if(email.length > 0){
		$.post('<?php echo base_url()?>index.php/register/tryEmail',{email :email},function(response){
			$('#chkEmail').html(response);
			if (document.getElementById('chkEmail').innerHTML == 'pass') {
				document.getElementById('email').style.backgroundColor = goodColor;
				document.getElementById('chkEmail').innerHTML = ' Email นี้สามารถใช้งานได้';
			}
			else {
				document.getElementById('email').style.backgroundColor = badColor;
				document.getElementById('chkEmail').innerHTML = ' มี Email ในระบบแล้ว';
			}
			isCorrectForm()
		});
   }
}

function isCorrectForm(){
	if(document.getElementById('username').style.backgroundColor == document.getElementById('gColor').style.backgroundColor && document.getElementById('email').style.backgroundColor == document.getElementById('gColor').style.backgroundColor && document.getElementById('password').style.backgroundColor == document.getElementById('gColor').style.backgroundColor)
				document.getElementById('submit').disabled = false;
	else document.getElementById('submit').disabled = true;
}

function resetUsername(){
	document.getElementById('username').style.backgroundColor = resetColor;
	document.getElementById('chkUsername').innerHTML = ' กรุณาตรวจสอบ username '; 
	document.getElementById('submit').disabled = true;
}

function resetEmail(){
	document.getElementById('email').style.backgroundColor = resetColor;
	document.getElementById('chkEmail').innerHTML = ' กรุณาตรวจสอบ Email';
	document.getElementById('submit').disabled = true;
}
</script>
    </section>