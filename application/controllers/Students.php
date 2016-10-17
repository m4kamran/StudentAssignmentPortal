<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Students
 *
 * @author Mario
 */
class Students extends My_Controller{
    
    public $login_title = "Student Login";
    
    
    public function __construct() {
        parent::__construct();
        $this->_studentOnly();
    }

    public function home()
    {
        $this->_secure();
        
    }
    
   
    
     
    public function courses()
    {
        $this->_secure();
        $this->load->model('course');
        $this->load->model('student_course');
        $message = '' ;
        $error = '';
        $courses = $this->course->getAll([
            //'level_id' => $this->current_user->level_id,
            'department_id' => $this->current_user->department_id
        ]);
        
        
        if($this->input->post('register'))
        {
            $submited = $this->input->post('courses');
            
            if(!count($submited))
            {
                $error = 'No course selected';
            }
            else
            {
             $this->student_course->register($this->current_user->id ,$submited);
             $message = 'Courses registerd!';
            }
             
        }
        if($this->input->post('unregister'))
        {
            $submited = $this->input->post('courses');
            
            if(!count($submited))
            {
                $error = 'No course selected';
            }
            else
            {
             $this->student_course->unregister($this->current_user->id ,$submited);
             $message = 'Courses unregisterd!';
            }
             
        }
        
        $student_courses = $this->student_course->getStudentCourseIds($this->current_user->id);
        
        $this->_view('students/courses' , [
            'courses' => $courses ,
            'student_courses' => $student_courses,
            'message' => $message,
            'error' => $error
        ]);
    }
    
    public function assignments($course_id = '')
    {
        $this->_secure();
        $this->load->model('assignment');
        $this->load->model('course');
        $this->load->model('student_course');
        $success = FALSE;
        $error = '';
        $course  = '' ;
        
        if($course_id)
        {
            $course  = $this->course->getOne(['id' => $course_id]);
            if(!$course->id  || !$this->student_course->isRegistered($this->current_user->id , $course_id))
            {
                show_error("Course not Found or You do not have permission");
            }
        }
        
      
        
        $where = $course_id? ['course_id' => $course_id ] : '';
        $assignments = $this->assignment->getAll($where);
        
        $this->_view('students/assignments' , [
            'assignments' => $assignments,
            'course' => $course,
            'error' => $error ,
            'success' => $success
        ]);
    }
    
    
    public function assignment_details($ass_id = '')
    {
        $this->_secure();
        $this->load->model('assignment');
        $this->load->model('student_assignment');
        $this->load->model('course');
        $success = FALSE;
        $error = '';
        $course  = '' ;
        $assignment_answer = '' ;
        
        $assignment = $this->assignment->getOne([
            'id' => $ass_id
        ]);
        
        if(!$assignment->id)
        {
            show_error('Invalid assignmet or you do not have permission');
            
        }
        
        $course = $this->course->getOne(['id' => $assignment->course_id]);
        
        $assignment_answer = $this->student_assignment->getOne([
               'assignment_id' => $assignment->id
           ]);
        
        if(!$course->id)
        {
            show_error('Invalid course for assignment');
            
        }
        
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['max_size']             = 1000;
        
        if(!$assignment->isDue() && $this->input->post('submit'))
        {
           
            $assignment_answer->answer = $this->input->post('answer');
            $assignment_answer->assignment_id = $assignment->id;
            $assignment_answer->user_id = $this->current_user->id;
            $assignment_answer->submitted = date('Y-m-d H:i:s');
           
            
            $config['upload_path']   =  dirname(BASEPATH).'/uploads/answers/';
            $config['file_name']   =  'assignment-'.$assignment->id.-'user-'.$this->current_user->id.'-'.time();
            
            
            $this->load->library('upload', $config);

            if ( !empty($_FILES['file']['name']))
            {
                if(!$this->upload->do_upload('file'))
                {
                    
                    $error = $this->upload->display_errors();
                    
                }
                else
                {
                    $data = $this->upload->data();
                    $assignment_answer->attachment =  $data['full_path'];
                }
            }
            if(!$error)
            {
                $assignment_answer->save();
                $success = true ;
            }
            
        }
        
        $this->_view('students/assignment_details' , [
            'assignment' => $assignment,
            'assignment_answer' => $assignment_answer,
            'course' => $course,
            'error' => $error ,
            'success' => $success
        ]);
    }
    
    
    
    
    
}
