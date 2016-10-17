<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>All Levels </h1>
<a href="/admin/add_level" class="btn btn-default">Add New</a>
<div class="col-md-12">
     <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($levels as $level): ?>
                <tr>
                    <td><?php echo $level->id ?></td>
                    <td><?php echo $level->name ?></td>
                    <td><a href="/admin/edit_level/<?php echo $level->id ?>" class="btn btn-default">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
