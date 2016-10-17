<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
    <div  class="alert alert-success">Level Created Successfully</div>
<?php endif; ?>
    <h1>Add Level</h1>
<?php echo form_open() ?>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" value="<?php set_value('name') ?>" >
  </div>
  
<input type="submit" class="btn btn-default" name="add" value="Add" />
<?php echo form_close() ?>