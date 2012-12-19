   
    <div class="submenu">
    <ul>
    <li><a href="<?php echo site_url('admin/category_list');?>">list of articles</a></li>
    <li><a href="<?php echo site_url('admin/category_add');?>" <?php if(($action=="category_addto")) echo 'class="selected"'; ?>>add new</a></li>
	<?php if(($action=="category_editto")) { ?>
		<li><a href="#" class="selected">edit</a></li>
	<?php } ?>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             
    
		<div id="tab1" class="tabcontent">
        <?php if($action=="category_addto") { ?>
			<h3>Add category</h3>
		<?php } else { ?>
			<h3>Edit category</h3>
		<?php } ?>	
        <div class="form">
            <form name="article_add" method="post" action="<?php echo site_url('admin/'.$action);?>">
			
            <?php if(ISSET($category)) { ?>
				<input type="hidden" class="form_input" name="id" value="<?php if(ISSET($category)) echo $category->id;?>"/>
			<?php } ?>
			
			<div class="form_row">
				<label id="name_label" <?php if($error=="name_en"){echo "style='color:red;'";}?>>*Name(en):</label>
				<input type="text" class="form_input" name="name_en" value="<?php if(ISSET($category)) echo $category->name_en;?>"/>
			</div>
            
			<div class="form_row">
				<label id="name_label" <?php if($error=="name_ru"){echo "style='color:red;'";}?>>Name(ru):</label>
				<input type="text" class="form_input" name="name_ru" value="<?php if(ISSET($category)) echo $category->name_ru;?>"/>
			</div>
            
			<div class="form_row">
				<label id="name_label" <?php if($error=="name_kz"){echo "style='color:red;'";}?>>Name(kz):</label>
				<input type="text" class="form_input" name="name_kz" value="<?php if(ISSET($category)) echo $category->name_kz;?>"/>
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