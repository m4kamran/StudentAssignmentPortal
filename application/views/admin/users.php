<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>All Users </h1>
<a href="/admin/add_user" class="btn btn-default">Add New</a>
<div class="col-md-12">
     <table class="table table-responsive table-condensed">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user->id ?></td>
                    <td><?php echo $user->name ?></td>
                    <td><?php echo $user->email?></td>
                    <td><?php echo $user->department_name ?></td>
                     <td><?php echo $user->level_name?></td>
                    <td><a href="/admin/edit_user/<?php echo $user->id ?>" class="btn btn-default">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
