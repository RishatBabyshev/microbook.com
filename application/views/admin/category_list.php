  
    <div class="submenu">
    <ul>
    <li><a href="<?php echo site_url('admin/category_list');?>" class="selected">list of categories</a></li>
    <li><a href="<?php echo site_url('admin/category_add');?>">add new</a></li>
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
            <th>Order</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="5">List of Categories</td>
        </tr>
    </tfoot>
    <tbody>
	<?php if(ISSET($categories)){?>
		<?php foreach($categories as $category): ?>
			<tr class="odd">
				<td><!--<input type="checkbox" name="" />--></td>
				<td><?php echo $category->name_en;?></td>
				<td>( <?php echo $category->my_order;?> )  
					<a href="<?php echo site_url('admin/category_down/'.$category->id);?>"><img src="<?php echo base_url();?>images/up.gif" width="15" height="15"/></a>  
					<a href="<?php echo site_url('admin/category_up/'.$category->id);?>"><img src="<?php echo base_url();?>images/down.gif" width="15" height="15"/></a>
				</td>
				<td><a href="<?php echo site_url('admin/category_edit/'.$category->id);?>"><img src="<?php echo base_url();?>images/edit.png" alt="" title="" border="0" /></a></td>
				<td><a href="<?php echo site_url('admin/category_delete/'.$category->id);?>"><img src="<?php echo base_url();?>images/trash.gif" alt="" title="" border="0" /></a></td>
			</tr>
		<?php endforeach; ?>
	<?php } else {?>
		<tr><td colspan="5" style="padding:15px;">No categories</td></tr>
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