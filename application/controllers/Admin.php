<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Mario
 */
class Admin extends My_Controller{
    
    
    
    public function __construct() {
        parent::__construct();
        
        $this->_adminOnly();
    }

    public function add_course()
    {
        $this->load->model('course');
        $this->load->model('department');
        $this->load->model('level');
        $this->load->model('user');
        
        $success = FALSE ;
        $error = '';
        
        $departments = $this->department->getAll();
        $levels = $this->level->getAll();
         $lecturers = $this->user->getAll([ 'role' => 'lecturer' ]);
        if($this->input->post('add'))
        {
            
            $course = $this->course->getOne([
                'code' => $this->input->post('code'),
            ]);
            
            if($course->id)
            { 
                $error = "course exists with code";
            }
            else
            {
                $course->setProperties($this->input->post());
                $course->is_core = (int)$this->input->post('is_core');
                $course->save();
                $success = true;
            }
        }
         $this->_view('admin/add_course', [
             'error' => $error,
             'success' => $success,
             'levels' => $levels,
             'lecturers' => $lecturers,
             'departments' => $departments,
        ]);
    }
    
    public function edit_course($id = '')
    {
        $this->load->model('course');
        $this->load->model('department');
        $this->load->model('level');
        $this->load->model('user');
        
        $success = FALSE ;
        $error = '';
        
        $course = $this->course->getOne([ 'id' => $id ]);
        $lecturers = $this->user->getAll([ 'role' => 'lecturer' ]);
        
        $departments = $this->department->getAll();
        $levels = $this->level->getAll();
        
        if(!$course->id)
        { 
            show_error("Course does not exist");
        }
        $departments = $this->department->getAll();
        $levels = $this->level->getAll();
        
        if($this->input->post('update'))
        {
            $course->setProperties($this->input->post());
            $course->is_core = (int)$this->input->post('is_core');
            $course->save();
            $success = true;
        }
        
         $this->_view('admin/edit_course', [
             'error' => $error,
             'success' => $success,
             'course' => $course,
             'levels' => $levels,
             'departments' => $departments,
             'lecturers' => $lecturers
        ]);
    }
    
    public function courses()
    {
        $this->load->model('course');
        
        $courses = $this->course->getAll();
        
        $this->_view('admin/courses', ['courses' => $courses]);
    }
    
    
    public function add_level()
    {
        $this->load->model('level');
        
        $success = FALSE ;
        $error = '';
        
        if($this->input->post('add'))
        {
            
            $level = $this->level->getOne([
                'name' => $this->input->post('name'),
            ]);
            
            if($level->id)
            { 
                $error = "Level exists with name";
            }
            else
            {
                $level->setProperties($this->input->post());
                $level->save();
                $success = true;
            }
        }
         $this->_view('admin/add_level', [
             'error' => $error,
             'success' => $success,
        ]);
    }
    
    public function edit_level($id = '')
    {
        $this->load->model('level');
        $success = FALSE ;
        $error = '';
        
        $level = $this->level->getOne([ 'id' => $id ]);
        
        
        if(!$level->id)
        { 
            show_error("Level does not exist");
        }
        
        
        if($this->input->post('update'))
        {
            $level->setProperties($this->input->post());
            $level->save();
            $success = true;
        }
        
         $this->_view('admin/edit_level', [
             'error' => $error,
             'success' => $success,
             'level' => $level
        ]);
    }
    
    public function levels()
    {
        $this->load->model('level');
        
        $levels = $this->level->getAll();
        
        $this->_view('admin/levels', ['levels' => $levels]);
    }
    
    public function add_department()
    {
        $this->load->model('department');
        
        $success = FALSE ;
        $error = '';
        
        if($this->input->post('add'))
        {
            
            $department = $this->department->getOne([
                'name' => $this->input->post('name'),
            ]);
            
            if($department->id)
            { 
                $error = "department exists with name";
            }
            else
            {
                $department->setProperties($this->input->post());
                $department->save();
                $success = true;
            }
        }
         $this->_view('admin/add_department', [
             'error' => $error,
             'success' => $success,
        ]);
    }
    
    public function edit_department($id = '')
    {
        $this->load->model('department');
        $success = FALSE ;
        $error = '';
        
        $department = $this->department->getOne([ 'id' => $id ]);
        
        
        if(!$department->id)
        { 
            show_error("department does not exist");
        }
        
        
        if($this->input->post('update'))
        {
            $department->setProperties($this->input->post());
            $department->save();
            $success = true;
        }
        
         $this->_view('admin/edit_department', [
             'error' => $error,
             'success' => $success,
             'department' => $department
        ]);
    }
    
    public function departments()
    {
        $this->load->model('department');
        
        $departments = $this->department->getAll();
        
        $this->_view('admin/departments', ['departments' => $departments]);
    }
    
    
    
    
    
    public function lecturer_courses($lecturer_id = '')
    {
        $this->load->model('course');
        $this->load->model('lecturer');
        $this->load->model('lecturer_course');
        
        $error = '' ;
        $success = false ;
        
        $lecturer = $this->lecturer->getOne(['id' => $id]);
        
        if(!$lecturer->id)
        { 
            show_error("Lecturer does not exist");
        }
        
        $departments = $this->department->getAll();
        $levels = $this->level->getAll();
        
        if($this->input->post('add'))
        {
            $cid = $this->input->post('course_id');
            
            $lecturer_course = $this->lecturer_course->getOne([
                'lecturer_id' => $lecturer_id ,
                'course_id' => $cid ,
            ]);
            
            if($lecturer_course->id)
            { 
                $error = "lecturer already taking course";
            }
            else
            {
                $lecturer_course->lecturer_id = $lecturer_id ;
                $lecturer_course->course_id = $cid ;
                $lecturer_course->save();
                $success = true;
            }
        }
        
        $courses = $this->course->getAll( ['lecturer_id' => $lecturer_id]);
        
        $this->_view('admin/lecturer_courses', [
            'lecturer' => $lecturer,
            'courses' => $courses,
            'error' => $error,
            'success' => $success
        ]);
    }

    
    public function add_user()
    {
        $this->load->model('user');
        $this->load->model('department');
        $this->load->model('level');
        
        $success = FALSE ;
        $error = '';
        
        $departments = $this->department->getAll();
        $levels = $this->level->getAll();
        
        if($this->input->post('add'))
        {
            
            $user = $this->user->getOne([
                'email' => $this->input->post('email'),
            ]);
            
            if($user->id)
            { 
                $error = "User exists with email";
            }
            else
            {
                $user->setProperties($this->input->post());
                $user->save();
                $success = true;
            }
        }
         $this->_view('admin/add_user', [
             'error' => $error,
             'success' => $success,
             'levels' => $levels,
             'departments' => $departments,
        ]);
    }
    
    public function edit_user($id = '')
    {
        $this->load->model('user');
        $this->load->model('department');
        $this->load->model('level');
        
        $success = FALSE ;
        $error = '';
        
        $user_to_edit = $this->user->getOne([ 'id' => $id]);
        
        $departments = $this->department->getAll();
        $levels = $this->level->getAll();
        
        if(!$user_to_edit->id)
        { 
            show_error("User exists with email");
        }
        
        $pswd = $user_to_edit->password;
        
        if($this->input->post('update'))
        {
            $user_to_edit->setProperties($this->input->post());
            
            if(!$this->input->post('password'))
            {
                $user_to_edit->password = $pswd;
            }
            $user_to_edit->save();
            $success = true;
        }
        
         $this->_view('admin/edit_user', [
             'error' => $error,
             'success' => $success,
             'user_to_edit' => $user_to_edit ,
             'levels' => $levels,
             'departments' => $departments,
        ]);
    }
    
    public function users()
    {
        
        $this->load->model('user');
        
        
        $users = $this->user->getUsers();
        
        $this->_view('admin/users', ['users' => $users]);
    }

}
