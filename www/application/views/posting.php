<div style="margin-left: 40px;margin-top: 60px" >
	<form method="post" class="vform" action="<?php echo base_url(); ?>index.php/post/upload">
	<label>Title</label><br/>
	<input name="title" type="text" required>
    <label>Description</label>
	<textarea rows="4" cols="50" name="des"></textarea>
    <label>Due Date</label>
	<input type="date" name="duedate" placeholder="yyyy/mm/dd" required>
    <input name="submit" type="Submit" value="Next">
	</form>
</div>