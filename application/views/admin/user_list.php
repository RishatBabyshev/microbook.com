  
    <div class="submenu">
    <ul>
    <li><a href="<?php echo site_url('admin/user_list');?>" class="selected">list of users</a></li>
    <li><a href="<?php echo site_url('admin/user_add');?>">add new</a></li>
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
            <th>Role</th>
            <th>E-mail</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="10">List of Users</td>
        </tr>
    </tfoot>
    <tbody>
	<?php if(ISSET($users)){?>
		<?php foreach($users as $user): ?>
			<tr class="odd">
				<td><!--<input type="checkbox" name="" />--></td>
				<td><?php echo $user->login;?></td>
				<td><?php echo $user->role;?></td>
				<td><?php echo $user->email;?></td>
				<td><a href="<?php echo site_url('admin/user_edit/'.$user->id);?>"><img src="<?php echo base_url();?>images/edit.png" alt="" title="" border="0" /></a></td>
				<td><a href="<?php echo site_url('admin/user_delete/'.$user->id);?>"><img src="<?php echo base_url();?>images/trash.gif" alt="" title="" border="0" /></a></td>
			</tr>
		<?php endforeach; ?>
	<?php } else {?>
		<tr><td colspan="6" style="padding:15px;">No user</td></tr>
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