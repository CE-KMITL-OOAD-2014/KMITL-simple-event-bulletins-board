<script src="<?php echo base_url(); ?>assert/js/jquery.js"></script>

<div>
	<form method="post" name=""reg" action="<?php echo base_url(); ?>index.php/register/submit">
		<div style="width:20%;float:left" >Username</div>
		<div style="width:80%;float:left;margin-bottom:25px">
			<input name="username" id="username" type="text">
			<input type="button" value="check" onClick=checkUsername() onkeyup=resetUsername()><span id="chkUsername"></span>
		</div>	
		<div style="width:20%;float:left">Password</div>
		<div style="width:80%;float:left">
			<input type="password" name="password" id="password"></div>
		<div style="width:20%;float:left">Confirm Password</div>
		<div style="width:80%;float:left;margin-bottom:25px">
			<input type="password" id="repassword" onkeyup=checkPass()><span id="chkPass"></span></div>
		<div style="width:20%;float:left">E-mail Address</div>	
		<div style="width:80%;float:left;margin-bottom:30px">
			<input type="text" name="email" id="email">
			<input type="button" value="check" onClick=checkEmail() onkeyup=resetEmail()><span id="chkEmail"></span>
		</div>
		<br><br>
		<input name="register" type="submit" value="Submit" id="submit" disabled="true">
	</form>
</div>

<script>
function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('repassword');
    //Store the Confimation Message Object ...
    var message = document.getElementById('chkPass');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
		pass1.style.backgroundColor = goodColor;
        pass2.style.backgroundColor = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
		pass1.style.backgroundColor = badColor;
        pass2.style.backgroundColor = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
	isCorrectForm()
}  

function checkUsername(){
	var username = document.getElementById('username').value;
	$.post('<?php echo base_url()?>index.php/register/tryUsername',{username :username},function(response){
        $('#chkUsername').html(response);
		if (document.getElementById('chkUsername').innerHTML== 'pass') document.getElementById('username').style.backgroundColor = "#66cc66";
		else document.getElementById('username').style.backgroundColor = "#ff6666";
		isCorrectForm()
   });
	
}

function checkEmail(){
	var email = document.getElementById('email').value;
	$.post('<?php echo base_url()?>index.php/register/tryEmail',{email :email},function(response){
		$('#chkEmail').html(response);
		if (document.getElementById('chkEmail').innerHTML == 'pass') document.getElementById('email').style.backgroundColor = "#66cc66";
		else document.getElementById('email').style.backgroundColor = "#ff6666";
		isCorrectForm()
   });
}

function isCorrectForm(){
	if(document.getElementById('username').style.backgroundColor == document.getElementById('email').style.backgroundColor && document.getElementById('username').style.backgroundColor == document.getElementById('password').style.backgroundColor)
				document.getElementById('submit').disabled = false;
	else document.getElementById('submit').disabled = true;
}

function resetUsername(){
	document.getElementById('username').style.backgroundColor = "#ffffff";
	document.getElementById('chkUsername').innerHTML = ''; 
	document.getElementById('submit').disabled = true;
}

function resetEmail(){
	document.getElementById('email').style.backgroundColor = "#ffffff";
	document.getElementById('chkEmail').innerHTML = '';
	document.getElementById('submit').disabled = true;
}
</script>