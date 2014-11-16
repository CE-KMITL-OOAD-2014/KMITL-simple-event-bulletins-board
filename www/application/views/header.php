<html>
<head>
	<title><?php echo $title;?></title>
	<meta http-equiv="content-Type" content="text/html;" charset="UTF-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assert/css/ivory.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assert/css/header.css" />

		
</head>
<body class="row">

<header class="row space-bot" >
<div id="menu" class="box">
    
	<img src="<?php echo base_url(); ?>assert/logo.png" width="90" height="90"></img>
	
    <form method="get" action="<?php echo base_url(); ?>index.php/fulllist" class="vform " name="Search">
        <input type="text" name="keyword" class="post">
        <span type="submit" class="post c3" id="search" onclick="Search.submit()">Search</span>
		<ul class="pagin text-center row">
			<li><button type="submit" class="c6 " formaction="<?php echo base_url()?>">Homepage</button></li>
            <li><button type="submit" class="c6 " formaction="<?php echo base_url()?>index.php/post">POST</buttonr></li>
		</ul>
	</form>
    </div>
</header>

<article class="grid space-bot centered">