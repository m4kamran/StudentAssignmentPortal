<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
    <div  class="alert alert-success">Level Update Successfully</div>
<?php endif; ?>

<h1>Edit Level :: <?php echo $level->name ?> </h1>
    
<?php echo form_open() ?>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $level->name ?>" >
  </div>
<input type="submit" class="btn btn-default" name="update" value="Update" />
<?php echo form_close() ?>