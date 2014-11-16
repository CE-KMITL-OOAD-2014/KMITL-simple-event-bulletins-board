<form method="post" action="<?php echo base_url();?>index.php/admin/deluser">
<div id="list">
User List
<table border = "2">
<tr>
	<th>Username</th>
	<th>Email</th>
	<th>Del</th>
</tr>
<?php
	if ($userlist->num_rows() > 0)
	{
		foreach ($userlist->result() as $row)
		{	
			echo '<tr><td>';
			echo $row->username;
			echo "</td><td>";
			echo $row->email;
			echo "</td><td>";
			echo "<input type='radio' name='userdelselect' value='".$row->username."'>";
			echo "</td></tr>";
		}
	}
?>
</table>
<input type="submit" value="Delete User">
</div>
</form>
