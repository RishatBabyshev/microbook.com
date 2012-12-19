  
    <div class="submenu">
    <ul>
    <li><a href="<?php echo site_url('admin/article_list');?>" class="selected">list of articles</a></li>
    <li><a href="<?php echo site_url('admin/article_add');?>">add new</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             
    <h2>Tables section</h2> 
                    
                    
<table id="rounded-corner">
    <thead>
    	<tr>
        	<th></th>
            <th>Name</th>
            <th>Category</th>
            <th>Order</th>
            <th>Edit</th>
            <th>Translations</th>
            <th>Delete</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="10">List of Articles</td>
        </tr>
    </tfoot>
    <tbody>
	<?php if(ISSET($articles)){?>
		<?php foreach($articles as $article): ?>
			<tr class="odd">
				<td><!--<input type="checkbox" name="" />--></td>
				<td><?php echo $article->name;?></td>
				<td><?php echo $article->name_en;?></td>
				<td>( <?php echo $article->my_order;?> )  
					<a href="<?php echo site_url('admin/article_down/'.$article->id);?>"><img src="<?php echo base_url();?>images/up.gif" width="15" height="15"/></a>  
					<a href="<?php echo site_url('admin/article_up/'.$article->id);?>"><img src="<?php echo base_url();?>images/down.gif" width="15" height="15"/></a>
				</td>
				<td><a href="<?php echo site_url('admin/article_edit/'.$article->id.'/en');?>"><img src="<?php echo base_url();?>images/edit.png" alt="" title="" border="0" />(en)</a></td>
				<td>
					<a href="<?php echo site_url('admin/article_edit/'.$article->id.'/ru');?>"><img src="<?php echo base_url();?>images/edit.png" alt="" title="" border="0" />(ru)</a>
					<a href="<?php echo site_url('admin/article_edit/'.$article->id.'/kz');?>"><img src="<?php echo base_url();?>images/edit.png" alt="" title="" border="0" />(kz)</a>
				</td>
				<td><a href="<?php echo site_url('admin/article_delete/'.$article->id);?>"><img src="<?php echo base_url();?>images/trash.gif" alt="" title="" border="0" /></a></td>
			</tr>
		<?php endforeach; ?>
	<?php } else {?>
		<tr><td colspan="6" style="padding:15px;">No articles</td></tr>
	<?php }?>
    </tbody>
</table>
<!--
	<div class="form_sub_buttons">
	<a href="#" class="button green">Edit selected</a>
    <a href="#" class="button red">Delete selected</a>
    </div>
-->  
     </div>
     </div><!-- end of right content-->
                     
                    
    
    
    <div class="clear"></div>
    </div> <!--end of center_content-->
    
    <div class="footer">
	</div>

</div>

    	
</body>
</html>