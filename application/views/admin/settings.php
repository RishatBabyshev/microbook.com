  
    <div class="submenu">
    <ul>
    <li><a href="<?php echo site_url('admin/settings');?>" class="selected">Settings</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
		<div id="right_content">             
			<h2>Settings</h2>
			<br />
			<form name="article_add" method="post" action="<?php echo site_url('admin/save_settings'); ?>">				
				<table class="settings-table">
					<tr>
						<td <?php if($error=="site_name"){echo "style='color:red;'";}?>>Site Name:</td>
						<td><input type="text" id="site_name" name="site_name" value="<?php echo $site_name;?>"></td>
					</tr>
					<tr>
						<td>Site Offline:</td>
						<td>
							<input type="radio" id="form_offline1" name="offline" value="1" <?php if($offline) echo 'checked="checked"' ?> >
							<label for="jform_offline0">Yes</label>
							<input type="radio" id="form_offline0" name="offline" value="0" <?php if(!$offline) echo 'checked="checked"' ?>>
							<label for="jform_offline1">No</label>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="form_submit" value="Submit" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div><!-- end of right content-->
                     
                    
    
    
    <div class="clear"></div>
    </div> <!--end of center_content-->
    
    <div class="footer">
	</div>

</div>

    	
</body>
</html>