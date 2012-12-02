<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stylesheet/style.css" />
	
</head>

<body>
<?php 
	$url_full =  site_url(uri_string());
	$l = substr($url_full, -2);
	$url = NULL;
	
	if($l=="en" || $l=="ru" || $l=="kz") {
		$url = substr($url_full, 0, strlen($url_full)-2);
	}
	else {
		$url = site_url('welcome/lang')."/";
	}
?>
				
<div id="container">
	<div id="header">
		<div id="logo"> <img src="<?php echo base_url(); ?>images/sdufull.png" /> </div>
		<div id="header-text"><h1>Welcome to C++</h1>
			<span style="float:right;">
				<a href="<?php echo $url."en";?>">en</a>
				<a href="<?php echo $url."ru";?>">ru</a>
				<a href="<?php echo $url."kz";?>">kz</a>
			</span>
		</div>
	</div>
	
	<div id="content">
		<table>
			<tr>
