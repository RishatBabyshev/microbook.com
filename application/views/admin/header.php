<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panelo - Free Admin Template</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stylesheet/admin-style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
<!-- jQuery file -->
<script src="<?php echo base_url();?>js/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas",
        theme_advanced_buttons3_add : "fullpage",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
		
		// Theme options
		theme_advanced_buttons1 : ",bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		skin : "o2k7",
		skin_variant : "silver",

});



</script>

</head>
<body>
<div id="panelwrap">
  	
	<div class="header">
    <div class="title"><a href="#">Adminka</a></div>
    
    <div class="header_right">Welcome Admin, 
		<a href="#" class="settings">Settings</a> 
		<a href="<?php echo site_url('admin/logout');?>" class="logout">Logout</a> 
	</div>
    
    <div class="menu">
    <ul>
    <li><a href="<?php echo site_url('admin/main');?>" <?php if($menu=="main") echo 'class="selected"';?>>Main page</a></li>
    <li><a href="#" <?php if($menu=="category") echo 'class="selected"';?>>Categories</a></li>
    <li><a href="<?php echo site_url('admin/article_list');?>" <?php if($menu=="article") echo 'class="selected"';?>>Articles</a></li>
    <li><a href="#" <?php if($menu=="user") echo 'class="selected"';?>>Users</a></li>
    <li><a href="#" <?php if($menu=="settings") echo 'class="selected"';?>>Admin settings</a></li>
    <li><a href="#" <?php if($menu=="help") echo 'class="selected"';?>>Help</a></li>
    </ul>
    </div>
    
    </div>