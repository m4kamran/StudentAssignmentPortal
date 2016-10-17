<h3><?php echo $login_title ?></h3>
<?php if($error): ?>
<div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php echo form_open() ?>
    <div class="form-group">
        <label><i class="glyphicon glyphicon-user"></i>Email</label>
        <input type="text"class="form-control" name="email" />
    </div>
    <div class="form-group">
        <label> <i class="glyphicon glyphicon-lock"></i>Password</label>
        <input type="password" name="password" class="form-control" />
    </div>
<input type="submit" name="login" value="Login" class="btn btn-default" />
<?php echo form_close();?>