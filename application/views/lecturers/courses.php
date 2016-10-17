<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>My Courses </h1>
<div class="col-md-12">
     <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo $course->code ?></td>
                    <td><?php echo $course->title ?></td>
                    <td><a href="/lecturers/course_details/<?php echo $course->id ?>" class="btn btn-default">Details</a></td>
                    <td><a href="/lecturers/assignments/<?php echo $course->id ?>" class="btn btn-default">Assignments</a></td>
                    <td><a href="/lecturers/students/<?php echo $course->id ?>" class="btn btn-default">View Students</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
