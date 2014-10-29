</br><center>
<form method="GET" action="<?php echo base_url()?>index.php/fulllist">
	<input type="search" name="keyword">
	<input type="submit" value="Search">
</form></center>

<div id="list">
<table>
<tr>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/title">Title</a></th>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/author">Author</a></th>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/postdate">Post Date</a></th>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/duedate">Due Date</a></th>
	
</tr>

<?php
	if ($eventlist->num_rows() > 0)
	{
		foreach ($eventlist->result() as $row)
		{	
			echo '<tr><td><a href="'.base_url().'index.php/show/index/'.$row->id.'">';
			echo $row->title;
			echo "</a></td><td>";
			echo $row->author;
			echo "</td><td>";
			echo $row->postdate;
			echo "</td><td>";
			echo $row->duedate;
			echo "</td></tr>";
		}
	}
?>
</table>
</div>