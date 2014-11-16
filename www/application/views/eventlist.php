<section  id="list"  class="c9 first">
<ul  class="box" style="    list-style-type: none;">
    <h1>ข่าวใหม่</h1>
<?php
	if(count($eventlist) === 0) echo 'ไม่มีข่าวใหม่';
	else{
	foreach ($eventlist as $row)
	{
		echo '<li class="alist space-bot"><a href="'.base_url().'index.php/show/index/'.$row->id.'">';
		echo $row->title;
		echo "</a></li>";
	}
	}
?>
</ul>
</section>