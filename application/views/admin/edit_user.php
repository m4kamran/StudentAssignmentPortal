
<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
    <div  class="alert alert-success">User Updated Successfully</div>
<?php endif; ?>

<?php echo form_open() ?>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $user_to_edit->name ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" value="<?php echo $user_to_edit->email ?>">
  </div>
  <div class="form-group">
    <label for="address">Address:</label>
    <textarea cols="5" rows="5"class="form-control" name="address"><?php echo $user_to_edit->address ?></textarea>
  </div>
  <div class="form-group">
    <label for="sex">Sex:</label>
    <select class="form-control " name="sex">
        <option <?php echo set_select('sex' , 'male' , ($user_to_edit->address ==  'male') ); ?> 
            value="male">Male</option>
        <option <?php echo set_select('sex' , 'female' , ($user_to_edit->address ==  'female') ); ?> 
            value="female">Female</option>
    </select>
  </div>
  <div class="form-group">
    <label for="type">Role:</label>
    <select class="form-control " name="role">
         <option <?php echo set_select('role' , 'student' , ($user_to_edit->isStudent()) ); ?> 
            value="student">Student</option>
        <option <?php echo set_select('role' , 'lecturer' , ($user_to_edit->isLecturer()) ); ?> 
            value="lecturer">Lecturer</option>
    </select>
  </div>
  <div class="form-group">
    <label for="department_id">Department</label>
    <select name="department_id" class="form-control">
        <option value="0">Select</option>
        <?php foreach ($departments as $department) :?>
        <option <?php echo set_select('department_id' , $department->id , ($user_to_edit->department_id ==  $department->id) ); ?> 
            value="<?php echo $department->id ;?>"><?php echo $department->name ;?></option>
        <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="level_id">Level</label>
    <select name="level_id" class="form-control ">
        <option value="0">Select</option>
        <?php foreach ($levels as $level) :?>
        <option <?php echo set_select('level_id' , $level->id , ($user_to_edit->level_id ==  $level->id) ); ?> 
            value="<?php echo $level->id ;?>"><?php echo $level->name ;?></option>
        <?php endforeach;?>
    </select>
  </div>

  <div class="form-group">
    <label for="pwd">Password:</label>
    <input name="password" type="password" class="form-control" value="">
  </div>
  
  <input type="submit"  name="update" value="Update" class="btn btn-default" />
<?php echo form_close() ?>