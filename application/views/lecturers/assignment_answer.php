<?php if($error): ?>
        <div  class="alert alert-danger"><?php echo $error ?></div>
<?php endif; ?>
<?php if($success): ?>
<div  class="alert alert-success">Assignment Updated Successfully</div>
<?php endif; ?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <p><strong>User </strong>
                <?php echo $answer->user_name ?></p>
            <p>
            <p><strong>Date Submitted </strong>
                <?php echo $answer->submitted ?>
            </p>
            <p><strong> Department </strong>
                <?php echo $answer->user_department ?></p>
            <p>
            <h3><?php echo $assignment->title ?></h3>
            <p><strong>Grade </strong>
                <?php echo $assignment->grade ?></p>
            
                <?php if($assignment->isDue()) :?>
                        <span class="label label-danger">Expired </span> 
                        <?php else :?> 
                            <span class="label label-success"> Active</span>
                        <?php endif; ?>
            </p>
            <p><strong>Deadline </strong>
                <?php echo $assignment->deadline ?>
            </p>
        </div>
        <div class="panel-body">
            <?php echo form_open_multipart() ?>
            <h3>Solution</h3>
            <pre><code><?php echo $answer->answer ?></code></pre>
            <div class="form-group">
                <label>Score</label>
                <input type="text" name="score" class="form-control" value="<?php echo $answer->score ?>" />
            </div>
            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" cols="7" rows="7" class="form-control"><?php echo $answer->remarks ?></textarea>
            </div>
            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes" cols="7" rows="7" class="form-control"><?php echo $answer->notes ?></textarea>
            </div>
            
            <input type="submit" name="submit" value="Update" />
            </form>
        </div>
    </div>
</div>

