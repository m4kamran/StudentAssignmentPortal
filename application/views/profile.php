<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
    <div  class="alert alert-success">Profile Update Successfully</div>
<?php endif; ?>


<p><i class="glyphicon glyphicon-user"></i><strong><?php echo $user->name ?></strong></p>
<p>Email : <?php echo $user->email ?></p>
<p>Department : 
    <?php if($department->id) : ?>
        <?php $department->name ?>
    <?php endif; ?>
</p>
<p><?php if($user->matric) : ?>
    Department : 
        <?php $user->matric ?>
    <?php endif; ?>
</p>
<p>Level : 
    <?php if($level->id) : ?>
        <?php $level->name ?>
    <?php endif; ?>
</p>
<?php echo form_open() ?>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" id="email" value="<?php echo $user->name ?>">
  </div>
  <div class="form-group">
    <label for="address">Address:</label>
    <textarea cols="5" rows="5"class="form-control" name="address"><?php echo $user->address ?></textarea>
  </div>
  <div class="form-group">
    <label for="address" name="sex">Sex:</label>
    <select class="form-control ">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
  </div>

  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="form-group">
    <label for="pwd">Password Confirm:</label>
    <input type="password" class="form-control" name="password-confirm" id="password-confirm">
  </div>
  
<input type="submit" name="update" class="btn btn-default" value="Update" />
<?php echo form_close() ?>