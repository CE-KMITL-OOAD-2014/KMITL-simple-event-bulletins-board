<div>
	<form method="post" name=""reg" action="<?php echo base_url(); ?>index.php/register/submit">
		<div style="width:20%;float:left" >Username</div>
		<div style="width:80%;float:left;margin-bottom:25px">
			<input name="username" type="text">
		</div>	
		<div style="width:20%;float:left">Password</div>
		<div style="width:80%;float:left">
			<input type="password" name="password" id="password"></div>
		<div style="width:20%;float:left">Confirm Password</div>
		<div style="width:80%;float:left;margin-bottom:25px">
			<input type="password" id="repassword" onkeyup="checkPass(); return false;"><span id="message"></span></div>
		<div style="width:20%;float:left">E-mail Address</div>	
		<div style="width:80%;float:left;margin-bottom:30px"><input type="text" name="email"></div>
		<br><br>
		<input name="register" type="submit" value="Submit">
	</form>
</div>

<script>
function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('repassword');
    //Store the Confimation Message Object ...
    var message = document.getElementById('message');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  
</script>