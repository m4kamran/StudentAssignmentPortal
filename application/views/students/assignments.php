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
            <h3>Course</h3>
        </div>
        <div class="panel-body">
           <?php echo $course->title ?>
        </div>
    </div>
</div>

<?php endif; ?>
<div class="col-md-12">
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
                    <td><a href="/students/assignment_details/<?php echo $a->id ?>" class="btn btn-default">Details</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</div>

