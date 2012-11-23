<td width="80%">
<div id="right_panel">
	<div style="width:100%; margin:10px;">
		<h2><?php echo $article->name; ?></h2><br />
		<?php echo $article->definition; ?><br /><br />
		<?php echo $article->example; ?><br /><br />
		<?php echo $article->task; ?><br /><br />
	</div>
	<div style="width:100%; margin:10px">
		
		<?php if($prev!=null) { ?>
			<a href="<?php echo $prev; ?>">prev</a>
		<?php } ?>
		
		<?php if($next!=null) { ?>
			<a href="<?php echo $next; ?>">next</a>
		<?php } ?>
		
	</div>
</div>
</td>