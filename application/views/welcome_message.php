<td>
<div id="body">
	<div style="float:left; margin:10px;">
		<?php foreach ($menus as $menu): ?>
			<h3><?php echo $menu->{"name_".$lang};?></h3>
			<ul>
				<?php foreach (${"article".$menu->id} as $sub_menu): ?>
					<li>
						<a href="<?php echo site_url(('article/id/'.$sub_menu->id.'/'.$lang)); ?>"><?php echo $sub_menu->name; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
	</div>
</div>
</td>