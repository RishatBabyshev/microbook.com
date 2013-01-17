   
    <div class="submenu">
    <ul>
    <li><a href="<?php echo site_url('admin/user_list');?>">list of users</a></li>
    <li><a href="<?php echo site_url('admin/user_add');?>" <?php if(($action=="user_addto")) echo 'class="selected"'; ?>>add new</a></li>
	<?php if(($action=="user_editto")) { ?>
		<li><a href="#" class="selected">edit</a></li>
	<?php } ?>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             
    
		<div id="tab1" class="tabcontent">
        <?php if($action=="user_addto") { ?>
			<h3>Add user</h3>
		<?php } else { ?>
			<h3>Edit user</h3>
		<?php } ?>	
        <div class="form">
            <form name="user_add" method="post" action="<?php echo site_url('admin/'.$action);?>">
			
            <?php if(ISSET($user)) { ?>
				<input type="hidden" class="form_input" name="id" value="<?php if(ISSET($user)) echo $user->id;?>"/>
			<?php } ?>
			
			<div class="form_row">
				<label id="login_label" <?php if($error=="login"){echo "style='color:red;'";}?>>Login:</label>
				<input type="text" class="form_input" name="login" value="<?php if(ISSET($user)) echo $user->login;?>"/>
			</div>
            
			<div class="form_row">
				<label id="password_label" <?php if($error=="password"){echo "style='color:red;'";}?>>Password:</label>
				<input type="password" class="form_input" name="password" value="<?php if(ISSET($user)) echo $user->password;?>"/>
			</div>
			
			<div class="form_row">
				<label id="password_conf_label" <?php if($error=="password_conf"){echo "style='color:red;'";}?>>Password(confirm):</label>
				<input type="password" class="form_input" name="password_conf" value="<?php if(ISSET($user)) echo $user->password;?>"/>
			</div>
			
            <div class="form_row">
				<label id="role_label" <?php if($error=="role"){echo "style='color:red;'";}?>>Role:</label>
				<select class="form_select" name="role" id="role">
					<?php foreach($roles as $role): ?>
						<option value="<?php echo $role->id;?>" 
							<?php if(ISSET($user) && $user->role_id==$role->id) echo "selected='selected'";?>>
							<?php echo $role->name;?>
						</option>
					<?php endforeach; ?>
				</select>
            </div>
			
			<div class="form_row">
				<label id="login_label" <?php if($error=="email"){echo "style='color:red;'";}?>>E-mail:</label>
				<input type="text" class="form_input" name="email" value="<?php if(ISSET($user)) echo $user->email;?>"/>
			</div>
			
            <div class="form_row">
				<input type="submit" class="form_submit" value="Submit" />
            </div>
			</form>
            <div class="clear"></div>
        </div>
    </div>
    
	
	</div>
	</div><!-- end of right content-->
                     
          
    <div class="clear"></div>
    </div> <!--end of center_content-->
    
    <div class="footer">
	</div>

</div>

    	
</body>
</html>