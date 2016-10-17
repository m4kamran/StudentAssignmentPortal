<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom styles for this template -->
    <title></title>  
    
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
  </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo site_url() ?>">Assignment Portal</a>
              </div>
              <ul class="nav navbar-nav">
                  <li  class="<?php echo set_active_class('') ?>">
                      <a href="<?php echo site_url() ?>">Home</a></li>
                    <?php // logged in user links ?>
                    <?php if($user) : ?>
                        <?php if($user->isStudent()): ?>
                            <li class="<?php set_active_class('students/assignments') ?>"

                            <a href="/students/assignments">Assignments</a></li>
                                  <?php endif; ?>
                    <?php endif; ?>
              </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if($user) : ?>
                    <li><a href="/users/profile">Profile</a></li>
                    <li >
                        <a href="/users/logout">Logout</a></li>
                 <?php else : ?>
                            <li  class="<?php set_active_class('users/login') ?>">
                                <a href="/users/login">Login</a></li>
                <?php endif; ?>
              </ul>
            </div>
          </nav>
              <div class="container">
                    <div class="row">
                      <div class="col-md-4">
                            <div class="list-group">
                            <?php if($user) : ?>
                                <?php if($user->isStudent()): ?>
                                        <a class="list-group-item <?php echo set_active_class('students/courses') ?>" 
                                           href="/students/courses">Courses</a>
                                        <a class="list-group-item <?php echo set_active_class('students/assignments') ?>" 
                                           href="/students/assignments">Assignments</a>
                                <?php elseif($user->isLecturer()) : ?>
                                     <a class="list-group-item <?php echo set_active_class('lecturers/courses') ?>"
                                        href="/lecturers/courses">Courses</a>
                                     <a class="list-group-item <?php echo set_active_class('lecturers/assignments') ?>"
                                        href="/lecturers/assignments">Assignments</a>
                                <?php endif; ?>
                                <?php if ($user->isSuperAdmin()): ?>
                                     <a class="list-group-item <?php echo set_active_class('admin/courses') ?>" 
                                        href="/admin/courses">Courses</a>
                                     <a class="list-group-item <?php echo set_active_class('admin/departments') ?>" 
                                        href="/admin/departments">Departments</a>
                                     <a class="list-group-item <?php echo set_active_class('admin/levels') ?>" 
                                        href="/admin/levels">Levels</a>
                                     <a class="list-group-item <?php echo set_active_class('admin/users') ?>" 
                                        href="/admin/users">Users</a>
                                <?php endif; ?>
                            <?php else : ?>
                                <a class="list-group-item <?php echo set_active_class('users/login') ?>" 
                                   href="/users/login">Login</a>
                            <?php endif; ?>
                            </div>
                    </div>
                    <div class="col-md-8">
                        <?php if(isset($main_view)) echo $main_view ;?>
                    </div>
                </div>
            </div>
        </div>
    </body>
  
</html>
    