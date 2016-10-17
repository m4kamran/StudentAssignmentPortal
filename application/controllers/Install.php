<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Install
 *
 * @author Mario
 */
class Install  extends CI_Controller{
    
    
    public function index()
    {
        
        $this->load->model('user');
        $this->load->model('course');
        $this->load->model('assignment');
        $this->load->model('course_material');
        $this->load->model('student_course');
        $this->load->model('student_assignment');
        $this->load->model('level');
        $this->load->model('department');
        
        $this->assignment->createTable();

        $this->user->createTable();
        $this->course->createTable();
        $this->course_material->createTable();
        $this->student_course->createTable();
        $this->student_assignment->createTable();
        $this->level->createTable();
        $this->department->createTable();
        
        $this->_create_users();
        $this->_create_levels();
        $this->_create_departments();
        $this->_create_courses();
        
        
        echo 'Insalled Successfully';
    }
   
    
    protected function _create_users()
    {
        // super admin first
        $admin = $this->user->getOne(['email' => 'admin@example.com']);
        
        if(!$admin->id)
        {
            $admin->name = 'Super Admin';
            $admin->password = 'admin' ;
            $admin->email = 'admin@example.com' ;
            $admin->sex = 'male';
            $admin->level_id = 0;
            $admin->is_admin = 1;
            $admin->save();
        }
        
        
        // add teacher , note the role
        $student = $this->user->getOne(['email' => 'studentone@example.com']);
        if(!$student->id)
        {
            $student->name = 'Student One';
            $student->password = 'one' ;
            $student->email = 'studentone@example.com' ;
            $student->sex = 'male';
            $student->level_id = 1;
            $student->role = 'student';
            $student->save();
        }
        $student2 = $this->user->getOne(['email' => 'studenttwo@example.com']);
        
        if(!$student2->id)
        {
            $student2->name = 'Student Two';
            $student2->password = 'two' ;
            $student2->email = 'studenttwo@example.com' ;
            $student2->sex = 'male';
            $student2->role = 'student';
            $student2->level_id = 1;
            $student2->save();
        }

        
        
        // add teacher , note the role
        $lecturer = $this->user->getOne(['email' => 'lecturer1@example.com' ]);
        if(!$lecturer->id)
        {
            $lecturer->setProperties([
                'name' => 'Lecturer One' ,
                'password' => 'tone' ,
                'email' => 'lecturer1@example.com',
                'sex' => 'male' ,
                'role' => 'lecturer' ,
                'level_id' => 0
            ]);
            $lecturer->save();
        }
        
    }
    
    protected function _create_levels()
    {
        $level = new Level([
            'name' => 'OND 1'
        ]);
        $level->save();
    
        $level2 = new Level([
            'name' => 'OND 2' ,
        ]);
        $level2->save();
        
        $level3 = new Level([
            'name' => 'HND 1'
        ]);
        $level3->save();
    
        $level4 = new Level([
            'name' => 'HND 2' ,
        ]);
        $level4->save();
        
    }
    protected function _create_departments()
    {
        $dept = new Department([
            'name' => 'Computer Science' 
        ]);
        $dept->save();
        
        $dept2 = new Department([
            'name' => 'Business Administration' 
        ]);
        $dept2->save();
    }
    protected function _create_courses()
    {
        $course = new Course([
            'title' => 'Intro To Computer Science' ,
            'code' => 'COM 101' ,
            'description' => 'Introduction to computer science course',
            'department_id' => 1
        ]);
        $course->save();
        
        $course2 = new Course([
            'title' => 'Intro To Computer Programming' ,
            'code' => 'COM 121' ,
            'description' => 'Introduction to computer programming course',
            'department_id' => 1
        ]);
        $course2->save();
    }
}
