<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
    <div  class="alert alert-success">Course Created Successfully</div>
<?php endif; ?>
<h1>Add Course </h1>

<?php echo form_open() ?>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" value="<?php set_value('title') ?>" >
  </div>
  <div class="form-group">
    <label for="code">Code</label>
    <input type="text" class="form-control" name="code" value="<?php set_value('code') ?>" >
  </div>
  <div class="form-group">
    <label for="code">Units</label>
    <input type="text" class="form-control" name="units" value="<?php echo set_value('units') ?>">
  </div>
 <div class="checkbox ">
    <label for="is_core">
        <input type="checkbox" value="1"  name="is_core" <?php echo set_checkbox( 'is_core' , 1 ) ?> />Core Course 
    </label>
  </div>
  <div class="form-group">
    <label for="description">Description:</label>
    <textarea name="description" cols="5" rows="5"class="form-control" ><?php echo set_value('description') ?></textarea>
  </div>
  <div class="form-group">
    <label for="lecturer_id">Lecturer</label>
    <select name="lecturer_id" class="form-control">
        <option value="0">Select</option>
        <?php foreach ($lecturers as $l) :?>
        <option <?php echo set_select('lecturer_id' , $l->id ); ?> 
            value="<?php echo $l->id ;?>"><?php echo $l->name ;?></option>
        <?php endforeach;?>
    </select>
  </div>
   <div class="form-group">
    <label for="department_id">Department</label>
    <select name="department_id" class="form-control">
        <option value="0">Select</option>
        <?php foreach ($departments as $department) :?>
        <option <?php echo set_select('department_id' , $department->id ); ?> 
            value="<?php echo $department->id ;?>"><?php echo $department->name ;?></option>
        <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="level_id">Level</label>
    <select name="level_id" class="form-control ">
        <option value="0">Select</option>
        <?php foreach ($levels as $level) :?>
        <option <?php echo set_select('level_id' , $level->id  ); ?> 
            value="<?php echo $level->id ;?>"><?php echo $level->name ;?></option>
        <?php endforeach;?>
    </select>
  </div>
<input type="submit" class="btn btn-default" name="add" value="Add" />
<?php echo form_close() ?>
