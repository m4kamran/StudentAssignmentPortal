
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Students for course :: <?php echo $course->title ?> (<?php echo $course->code ?>)</h3>
        </div>
        <div class="panel-body">
           <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Department</th>
                <th>Level</th>
                <th>Matric</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td><?php echo $s->user_name ?></td>                    
                    <td><?php echo $s->user_department?></td>                    
                    <td><?php echo $s->user_level?></td>                    
                    <td><?php echo $s->user_matric?></td>                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</div>