
<section>
<center class="row space-bot">
<form method="GET" action="<?php echo base_url()?>index.php/fulllist" class="vform c4 centered" name="Search2">
	<input type="search" name="keyword" class="post">
     <span type="submit" class="post c3" id="search" onclick="Search2.submit()">Search</span>
</form></center>

<div id="list" class="grid space-bot">
<table style="background:white;">
<tr>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/title">Title</a></th>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/author">Author</a></th>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/postdate">Post Date</a></th>
	<th><a href="<?php echo base_url(); ?>index.php/fulllist/sortby/duedate">Due Date</a></th>
	
</tr>

<?php
	if(count($eventlist) === 0) echo '<br><br> <center>ไม่พบคำค้นที่ต้องการ</center> <br><br>';
	else{
	foreach ($eventlist as $row)
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

</div>    </section>