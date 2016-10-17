<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($message): ?>
        <div  class="alert alert-success"><?php echo $message ?></div>
<?php endif; ?>
<h1>My Courses </h1>
<div class="col-md-12">
    <?php echo form_open() ?>
     <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Register</th>
                <th>Core Course</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo $course->code ?></td>
                    <td><?php echo $course->title ?></td>
                    <td><input name="courses[]" value="<?php echo $course->id ?>" 
                               <?php if(in_array($course->id, $student_courses) ): ?>
                                    checked="checked"
                               <?php endif; ?>
                               
                               type="checkbox" /></td>
                    <td><?php if($course->is_core ): ?>
                        <i class="glyphicon glyphicon-check" />
                        <?php endif; ?></td>
                    <td><a href="/students/assignments/<?php echo $course->id ?>" class="btn btn-default">Assignments</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <input type="submit" name="register" class="btn btn-success pull-left" value="Register"  />
    <input type="submit" name="unregister" class="btn btn-warning pull-right" value="Un Register"  />
    <?php echo form_close() ?>
</div>
