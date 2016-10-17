<?php if($error): ?>
    <?php foreach ($error as $e) :?>
        <div  class="alert alert-danger"><?php echo $e ?></div>
    <?php endforeach; ?>
<?php endif; ?>
<?php if($success): ?>
<div  class="alert alert-success">Assignment Created Successfully</div>
<?php endif; ?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-danger"><?php echo  $course->code ?> :: <?php echo  $course->title ?></h3>
            
                <a href="/lecturers/assignments/<?php echo $course->id ?>" 
                   class="btn btn-default">Assignments</a>
                <a href="/lecturers/students/<?php echo $course->id ?>" 
                   class="btn btn-default">View Students</a>
            
            
        </div>
        <div class="panel-body">
            <p><strong>Units:</strong><?php echo $course->units ?></p>
            <p><strong>Department:</strong><?php echo $course->department_id ?></p>
            <p><strong>Level:</strong><?php echo $course->level_id ?></p>
            
            <p><strong>Description: </strong><?php echo $course->description ?></p>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Upload Material</h3>
        </div>
        <div class="panel-body">
           <?php echo form_open_multipart() ?>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" cols="7" rows="7" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="file"  />
            </div>
            <input type="submit" name="upload" value="Upload" />
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Materials</h3>
        </div>
        <div class="panel-body">
           <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $m): ?>
                <tr>
                    <td><?php echo $m->title ?></td>                    
                    <td><?php echo $m->description ?></td>                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</div>

