<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panelo - Free Admin Template</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stylesheet/admin-style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="loginpanelwrap">
  	
	<div class="loginheader">
    <div class="logintitle"><a href="#">Admin Panel</a></div>
    </div>

     
    <div class="loginform">
        <form name="register" method="post" action="<?php echo site_url('admin/login');?>">
        <div class="loginform_row">
        <label>Username:</label>
        <input type="text" class="loginform_input" name="login" />
        </div>
        <div class="loginform_row">
        <label>Password:</label>
        <input type="password" class="loginform_input" name="password" />
        </div>
        <div class="loginform_row">
		<?php if($error) {?>
			<b class="error" style="color:red;" >Wrong login or password</b>
        <?php } ?>
		<input type="submit" class="loginform_submit" value="Login" />
		</div> 
		</form>
        <div class="clear"></div>
    </div>
 

</div>

    	
</body>
</html>