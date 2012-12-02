   
    <div class="submenu">
    <ul>
    <li><a href="<?php echo site_url('admin/article_list');?>">list of articles</a></li>
    <li><a href="<?php echo site_url('admin/article_add');?>" <?php if(($action=="article_addto")) echo 'class="selected"'; ?>>add new</a></li>
	<?php if(($action=="article_editto")) { ?>
		<li><a href="#" class="selected">edit</a></li>
	<?php } ?>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             
    
		<div id="tab1" class="tabcontent">
        <?php if($action=="article_addto") { ?>
			<h3>Add article</h3>
		<?php } else { ?>
			<h3>Edit article</h3>
		<?php } ?>	
        <div class="form">
            <form name="article_add" method="post" action="
			<?php if($action=="article_addto") {
						echo site_url('admin/'.$action);
				  } else {
						echo site_url('admin/'.$action.'/'.$lang);
				  }
			?>">
			
            <?php if(ISSET($article)) { ?>
				<input type="hidden" class="form_input" name="id" value="<?php if(ISSET($article)) echo $article->id;?>"/>
			<?php } ?>
			
			<div class="form_row">
				<label id="name_label" <?php if($error=="name"){echo "style='color:red;'";}?>>Name:</label>
				<input type="text" class="form_input" name="name" value="<?php if(ISSET($article)) echo $article->name;?>"/>
			</div>
            
            <div class="form_row">
				<label id="category_label" <?php if($error=="category"){echo "style='color:red;'";}?>>Category:</label>
				<select class="form_select" name="category" id="category">
					<?php foreach($categories as $category): ?>
						<option value="<?php echo $category->id;?>" 
							<?php if(ISSET($article) && $article->category_id==$category->id) echo "selected='selected'";?>>
							<?php echo $category->name_en;?>
						</option>
					<?php endforeach; ?>
				</select>
            </div>
            
            <div class="form_row">
				<label id="definition_label">Definition:</label>
				<textarea class="form_textarea" id="definition" name="definition" >
					<?php if(ISSET($article)) echo $article->definition;?>
				</textarea>
            </div>
            <div class="form_row">
				<label id="example_label">Example:</label>
				<textarea class="form_textarea" id="example" name="example" >
					<?php if(ISSET($article)) echo $article->example;?>
				</textarea>
            </div>
            <div class="form_row">
				<label id="task_label">Task:</label>
				<textarea class="form_textarea" id="task" name="task" >
					<?php if(ISSET($article)) echo $article->task;?>
				</textarea>
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