<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assert/css/header.css" />

<div id="topmenu">
	<form action="<?php echo base_url()?>index.php/fulllist" method="GET">
	<ul class="menubtn">
		
		<li><input type="search" name="keyword"></li>
		<li><input type="submit" value="Search"></li>
		
		<li><a class="button-link " href="<?php echo base_url()?>">Homepage</a></li>
		<li><a class="button-link " href="<?php echo base_url()?>index.php/post">POST</a></li>
	</ul>
	</form>
	
</div>