<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
<div  class="alert alert-success">Assignment Created Successfully</div>
<?php endif; ?>

<?php if($course) : ?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Add Assignment</h3>
            <a class="btn btn-default " href="#assignent-list-block">
                <i class="glyphicon glyphicon-arrow-down"></i>View Assignments 
            </a>
        </div>
        <div class="panel-body">
           <?php echo form_open_multipart() ?>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control" />
            </div>
            <div class="form-group">
                <label>Deadline (month-day-year)</label>
                <input type="date" name="deadline-period" class="form-control" />
            </div>
            <div class="form-group">
                <label>Deadline Time (01:00:PM</label>
                <input type="time" name="deadline-time" class="form-control" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" cols="7" rows="7" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="file"  />
            </div>
            <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </div>
</div>

<?php endif; ?>
<div class="col-md-12" id="assignent-list-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Assignments</h3>
        </div>
        <div class="panel-body">
           <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>Title</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $a): ?>
                <tr>
                    <td><?php echo $a->title ?></td>                    
                    <td><?php echo $a->deadline ?></td>  
                    <td><?php if($a->isDue()) :?>
                        <span class="label label-danger">Expired </span> 
                        <?php else :?> 
                            <span class="label label-success"> Active</span>
                        <?php endif; ?></td>  
                    <td><?php echo $a->grade ?></td>  
                    <td><a href="/lecturers/assignment_details/<?php echo $a->id ?>" class="btn btn-default">Details</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</div>

