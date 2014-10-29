<form method="post" action="<?php echo base_url();?>index.php/admin/delevent">
<div id="list">
Event List
<table border = "2">
<tr>
	<th>ID</th>
	<th>Title</th>
	<th>Author</th>
	<th>Post date</th>
	<th>Due date</th>
	<th>Del</th>
</tr>
<?php
	if ($eventlist->num_rows() > 0)
	{
		foreach ($eventlist->result() as $row)
		{	
			echo '<tr><td>';
			echo $row->id;
			echo '<td width=50%><a href="'.base_url().'index.php/show/index/'.$row->id.'">';
			echo $row->title;
			echo "</a></td><td>";
			echo $row->author;
			echo "</td><td>";
			echo $row->postdate;
			echo "</td><td>";
			echo $row->duedate;
			echo "</td><td>";
			echo "<input type='radio' name='eventdelselect' value='".$row->id."'>";
			echo "</td></tr>";
		}
	}
?>
</table>
<input type="submit" value="Delete Event">
</div>
</form>


