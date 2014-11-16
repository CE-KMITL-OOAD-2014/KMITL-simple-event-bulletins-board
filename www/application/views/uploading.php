<div style="margin-left: 40px;margin-top: 60px" >
	<p><?php echo $error; ?></p>
	<p>
		<?php if($image==='') echo '<img src="'.base_url().'assert/noimg.jpg" width="350" height="500"></img>';
			else echo '<img src="'.$image.'" width="350" height="500"></img>';
		?>
	</p>
    <?php echo form_open_multipart('post/upload2');?>
    <br>
	<input type="file" name="userfile" accept="image/*">
    <br>
    <br>
	<input name="submit" type="Submit" value="Upload"> 
	</form>
	<br><br>
	<form action="<?php echo base_url(); ?>index.php/post/finish">
	<input name="submit" type="Submit" value="POST"> 
	</form>
</div>
