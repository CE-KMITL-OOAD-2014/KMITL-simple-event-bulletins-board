
<section class="box">
    <center> <h1 class="row centered"><?php echo $title; ?></h1></center>
<hr/>
<p>
	<?php if($image==='') echo '<img src="'.base_url().'assert/noimg.jpg" width="350" height="500"></img>';
		else echo '<img src="'.$image.'" width="350" height="500"></img>';
	?>
</p>
<p>
<?php echo $des; ?>
</p>
<br/><br/><br/>
<p>
By: <?php echo $author; ?>
</p><p>
Post Date:  <?php echo $postdate; ?>
</p>
<p>
Due Date:  <?php echo $duedate; ?>
</p>

</section>