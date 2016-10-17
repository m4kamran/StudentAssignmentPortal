<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
<div  class="alert alert-success">Assignment Updated Successfully</div>
<?php endif; ?>
<div class="col-md-12">
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><?php echo $assignment->title ?></h3>
            <p><strong>Grade </strong>
                <?php echo $assignment->grade ?></p>
            
            <p><strong>Course </strong>
                <?php echo $course->title ?> (<?php echo $course->code ?>)</p>
            <p>
                <?php if($assignment->isDue()) :?>
                        <span class="label label-danger">Expired </span> 
                        <?php else :?> 
                            <span class="label label-success"> Active</span>
                        <?php endif; ?>
            </p>
            <p><strong>Deadline </strong>
                <?php echo $assignment->deadline ?></p>
            <p><strong>Attachment:</strong> <?php echo $assignment->attachment ?: "No attachment" ?> </p>
            <a class="btn btn-default " href="#answers-block">
                <i class="glyphicon glyphicon-arrow-down"></i>Answers 
            </a>
        </div>
        <div class="panel-body">
            <?php echo form_open_multipart() ?>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $assignment->title ?>" />
            </div>
            <div class="form-group">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control" value="<?php echo $assignment->grade ?>"/>
            </div>
            <div class="form-group">
                <label>Deadline (month-day-year)</label>
                <input type="date" name="deadline-period" class="form-control" value="<?php echo $assignment->getDuePeriod() ?>" />
            </div>
            <div class="form-group">
                <label>Deadline Time</label>
                <input type="time" name="deadline-time" class="form-control" value="<?php echo $assignment->getDueTime() ?>" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" cols="7" rows="7" class="form-control"><?php echo $assignment->description ?></textarea>
            </div>
            <div class="form-group">
                <label>Attachment</label>
                <input type="file" name="file"  />
            </div>
            <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </div>
</div>


<div class="col-md-12" id="answers-block">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Answers</h3>
        </div>
        <div class="panel-body">
           <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>id</th>
                <th>Date Submitted</th>
                <th>User</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($answers as $a): ?>
                <tr>
                    <td><?php echo $a->id ?></td>                    
                    <td><?php echo $a->submitted ?></td>                    
                    <td><?php echo $a->user_name ?></td>                    
                    <td><?php echo $a->score ?></td>                    
                    <td><a href="/lecturers/assignment_answer/<?php echo $a->id ?>" 
                           class="btn btn-default">View</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</div>