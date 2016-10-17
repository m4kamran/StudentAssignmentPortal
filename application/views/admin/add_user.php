
<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
    <div  class="alert alert-success">User Created Successfully</div>
<?php endif; ?>

<?php echo form_open() ?>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" value="">
  </div>
  <div class="form-group">
    <label for="address">Address:</label>
    <textarea cols="5" rows="5"class="form-control" name="address"></textarea>
  </div>
  <div class="form-group">
    <label for="address">Sex:</label>
    <select class="form-control " name="sex">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
  </div>
  <div class="form-group">
    <label for="type">Role:</label>
    <select class="form-control " name="role">
        <option value="student">Student</option>
        <option value="lecturer">lecturer</option>
    </select>
  </div>
  <div class="form-group">
    <label for="department_id">Department</label>
    <select name="department_id" class="form-control">
        <option value="0">Select</option>
        <?php foreach ($departments as $department) :?>
            <option value="<?php echo $department->id ;?>"><?php echo $department->name ;?></option>
        <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="level_id">Level</label>
    <select name="level_id" class="form-control ">
        <option value="0">Select</option>
        <?php foreach ($levels as $level) :?>
            <option value="<?php echo $level->id ;?>"><?php echo $level->name ;?></option>
        <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="pwd">Password:</label>
    <input name="password" type="password" class="form-control" id="password-confirm">
  </div>
  
  <input type="submit"  name="add" value="Add" class="btn btn-default" />
<?php echo form_close() ?>