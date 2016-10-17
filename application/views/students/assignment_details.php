<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
<div  class="alert alert-success">Solution submitted Successfully</div>
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
            <p>Attachment: <?php echo $assignment->attachment ?> </p>
           
            <?php if(is_object($assignment_answer)) :?>
                <p><span class="label label-success">Answered </span> </p> 
                <p><span class="label label-primary">Score : <?php echo $assignment_answer->score ?> </span> </p> 
                <p><span class="label label-primary">Remarks : <?php echo $assignment_answer->remarks ?> </span> </p> 
            <?php else :?> 
                <p><span class="label label-danger"> Not Submitted</span> </p>
            <?php endif; ?>
        </div>
        <div class="panel-body">
            <?php echo form_open_multipart() ?>
            
            <div class="form-group">
                <label>Solution</label>
                <textarea name="answer" cols="7" rows="7" 
                          class="form-control"><?php echo is_object($assignment_answer)? $assignment_answer->answer : ''?></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="file"  />
            </div>
            <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </div>
</div>
