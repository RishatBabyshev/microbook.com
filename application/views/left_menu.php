<td width="20%">
<div id="left_panel">
	<div style="margin:10px;">
		<a href="<?php echo site_url("welcome/lang/".$lang);?>">Home page</a><br/>
		<h3><?php echo $menu_category; ?></h3>
		
		<div style="margin-left:15px;">
		<?php foreach ($menus as $menu): ?>
			<a href="<?php echo site_url(('article/id/'.$menu->id.'/'.$lang)); ?>"><?php echo $menu->name;?></a><br>
		<?php endforeach; ?>
		</div>
	</div>
</div>
</td>