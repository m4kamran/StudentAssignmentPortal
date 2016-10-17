<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>All Courses </h1>
<a href="/admin/add_course" class="btn btn-default">Add New</a>
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
                    <td><a href="/admin/edit_course/<?php echo $course->id ?>" class="btn btn-default">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
