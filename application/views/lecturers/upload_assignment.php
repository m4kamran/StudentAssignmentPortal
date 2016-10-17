<?php echo form_open_multipart() ?>

<?php if($error): ?>
    <?php foreach ($error as $e) :?>
        <div  class="alert alert-danger"><?php echo $e ?></div>
    <?php endforeach; ?>
<?php endif; ?>
<?php if($success): ?>
<div  class="alert alert-success">Assignment Created Successfully</div>
<?php endif; ?>
<div class="form-group">
    <label for="title">Title</label>
    <input type="title" name="title" class="form-control">
</div>
<div class="form-group">
  <label for="address">Description:</label>
  <textarea cols="5" rows="5" class="form-control" name="description" ></textarea>
</div>
  <div class="form-group">
    <label for="deadline">Deadline:</label>
    <select class="form-control" name="deadline">
        <option value="day">Day(3)</option>
        <option value="week">Week(s)</option>
        <option value="month">Month(s)</option>
    </select>
  </div>
   <div class="form-group">
        <label for="title">Deadline Period</label>
        <input type="text" class="form-control" name="period">
  </div>

  <div class="form-group">
    <label for="pwd">Attachment:</label>
    <input type="file" name="file" class="form-control">
  </div>
  
<input type="submit" name="submit" class="btn btn-default" />
<?php echo form_close() ?>