<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assert/css/listevent.css" />
<div id="list">
<ul>
<?php
	if ($eventlist->num_rows() > 0)
	{
		foreach ($eventlist->result() as $row)
		{	
			echo '<li><a href="'.base_url().'index.php/show/index/'.$row->id.'">';
			echo $row->title;
			echo "</a></li>";
		}
	}
?>
</ul>
</div>