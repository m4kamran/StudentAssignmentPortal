<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Lecturer
 *
 * @author Mario
 */
class Lecturers extends My_Controller{
    
    public $login_title = 'Staff Login';
    
    
    public function __construct() {
        parent::__construct();
        $this->_lecturerOnly();
    }

        public function home()
    {
        
        
        $this->_view('lecturers/home');
    }  


    
    public function students($course_id = '')
    {
        $this->_secure();
        $this->load->model('course');
        $this->load->model('student_course');
        
        
        $course = $this->course->getOne([
            'lecturer_id' => $this->current_user->id ,
        ]);
        if(!$course->id)
        {
            show_error("Invalid course or you dont have permission");
        }
        
        $students = $this->student_course->getStudents($course_id);
        
        $this->_view('lecturers/students' , [
            'course' => $course,
            'students' => $students
        ]);
    }
    
    public function courses()
    {
        $this->_secure();
        $this->load->model('course');
        
        $courses = $this->course->getAll(['lecturer_id' => $this->current_user->id ]);
        
        $this->_view('lecturers/courses' , [
            'courses' => $courses
        ]);
    }
    
      
    function course_details($course_id = '')
    {
        $this->_secure();
        $this->load->model('course');
        $this->load->model('course_material');
        $error = '' ;
        $success = FALSE ;
        
        $course = $this->course->getOne([
            'lecturer_id' => $this->current_user->id ,
            'id' => $course_id
        ]);
        
        if(!$course->id)
        {
            show_error("Invalid course or you dont have permission");
        }
        
        if($this->input->post('upload'))
        {
            
            $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
            $config['upload_path']   =  dirname(BASEPATH).'/uploads/';
            $config['file_name']   =  'course-'.$course->id.'-'.time();
            
            $this->load->library('upload', $config);

            if ( !empty($_FILES['file']['name']))
            {
                if(!$this->upload->do_upload('file'))
                {
                    $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $data = $this->upload->data();
                    $cm = new Course_Material();
                    $cm->course_id = $course->id ;
                    $cm->lecturer_id = $this->current_user->id ;
                    $cm->title = $this->input->post('title') ;
                    $cm->description = $this->input->post('description') ;
                    $cm->path =  $data['full_path'];
                    $cm->file_type =  $data['file_type'];
                    $success = true ;
                }
                if(!$error)
                {
                    $cm->save();
                }
            }
           
            
        }
        
        $materials = $this->course_material->getAll(['course_id' => $course_id ]);
        $this->_view('lecturers/course_details' , [
            'course' => $course , 
            'materials' => $materials,
            'error' => $error ,
            'success' => $success ,
        ]);
    }

    /**
     * 
     * @param type $course_id
     */
    public function course_materials($course_id ='')
    {
        $this->_secure();
        $this->load->model('course');
        $this->load->model('course_material');
        
        $course  = $this->course->getOne(['id' => $course_id]);
        
        if(!$course->id)
        {
            show_error("Course Not FOund");
        }
        
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['max_size']             = 1000;
        
        if($this->input->post('submit'))
        {
            $folder = '/uploads/materials/';
            $config['upload_path']   =  dirname(BASEPATH).$folder;
            $config['file_name']   =  'course-'.$course->id.'-'.time();
            
            $this->load->library('upload', $config);

            if ( !empty($_FILES['file']['name']))
            {
                if(!$this->upload->do_upload('file'))
                {
                    $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $course = new Course_Material();
                    $course->course_id = $course_id;
                    $course->filename = $this->upload->data('full_path');
                    $assignment->save();
                   // $data = array('upload_data' => $this->upload->data());
                    $success = true ;
                }
            }
            
        }
        
        $course_materials = $this->course_material->getOne(['course_id' => $course_id]);
        
        $this->_view('courses/materials' , [
            'success' => $success,
            'error' => $error,
            'course_materials' => $course_materials ,
            'course' => $course ,
        ]);
    }
    
    /**
     * View Assignements by lecturer 
     * @param int $course_id Optionally view for specific course
     */
    public function assignments($course_id = '')
    {
        $this->_secure();
        $this->load->model('assignment');
        $this->load->model('course');
        $success = FALSE;
        $error = '';
        $course  = '' ;
        
        if($course_id)
        {
            $course  = $this->course->getOne(['id' => $course_id]);

            if(!$course->id || $course->lecturer_id != $this->current_user->id)
            {
                show_error("Course Not FOund or You do not have permission");
            }
        }
        
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['max_size']             = 1000;
        
        if($this->input->post('submit'))
        {
            $assignment = new Assignment($this->input->post());
            $assignment->course_id = $course_id;
            $assignment->lecturer_id = $this->current_user->id;
            $assignment->deadline = $this->input->post('deadline-period'). ' ' .$this->input->post('deadline-time');
            
            $config['upload_path']   =  dirname(BASEPATH).'/uploads/assignments/';
            $config['file_name']   =  time();
            
            
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
                    $assignment->attachment =  url_title($this->input->post('title')).'-'.time();$data['full_path'];
                }
            }
            if(!$error)
            {
                $assignment->save();
                $success = true ;
            }
            
        }
        
        $where = $course_id? ['course_id' => $course_id ] : '';
        $assignments = $this->assignment->getAll($where);
        
        $this->_view('lecturers/assignments' , [
            'assignments' => $assignments,
            'course' => $course,
            'error' => $error ,
            'success' => $success
        ]);
    }
    
    
    public function assignment_details($id = '')
    {
        
        $this->_secure();
        $this->load->model('course');
        $this->load->model('assignment');
        $this->load->model('student_assignment');
        $error = '' ;
        $success = FALSE ;
        
        $assignment = $this->assignment->getOne([
            'lecturer_id' => $this->current_user->id ,
            'id' => $id
        ]);
        
        if(!$assignment->id)
        {
            show_error("Invalid assignment or you dont have permission");
        }
        
        $course = $this->course->getOne([
            'id' => $assignment->course_id
        ]);
        
        if($this->input->post('submit'))
        {
            $assignment->setProperties($this->input->post());
            $assignment->deadline = $this->input->post('deadline-period'). ' ' .$this->input->post('deadline-time');
            
            $config['allowed_types']        = 'pdf|doc|docx';
            $config['upload_path']   =  dirname(BASEPATH).'/uploads/assignments/';
            $config['file_name']   = url_title($assignment->title).'-'.time();
            
            
            $this->load->library('upload', $config);

            if ( !empty($_FILES['file']['name']))
            {
                if(!$this->upload->do_upload('file'))
                {
                    
                    $error = $this->upload->display_errors();
                }
                else
                {
                    $assignment->deleteAttachment();
                    $data = $this->upload->data();
                    $assignment->attachment = $data['full_path'];
                }
            }
            if(!$error)
            {
                $assignment->save();
                $success = true ;
            }
            
        }
        
    $answers =  $this->student_assignment->getAnswers(['assignment_id' => $assignment->id ]);
         
        
        $this->_view('lecturers/assignment_details' , [
            'course' => $course , 
            'assignment' => $assignment,
            'answers' => $answers,
            'error' => $error ,
            'success' => $success
        ]);
    }
    
    public function assignment_answer($answer_id = '')
    {
         
        $this->_secure();
        $this->load->model('assignment');
        $this->load->model('student_assignment');
        $error = '' ;
        $success = FALSE ;
        
        $answers =  $this->student_assignment->getAnswers(['student_assignment.id' => $answer_id ]);
        
        if(!count($answers))
        {
            show_error("Invalid solution record or you dont have permission");
        }
        
        $first_answer = array_shift($answers);
        
        $assignment = $this->assignment->getOne([ 'id' => $first_answer->assignment_id ]);
        
        if($this->input->post('submit'))
        {
            $first_answer->setProperties($this->input->post());
            $first_answer->save();
            $success = true ;
        }
                
        $this->_view('lecturers/assignment_answer' , [
           // 'course' => $course , 
            'assignment' => $assignment,
            'answer' => $first_answer,
            'error' => $error ,
            'success' => $success
        ]);
    }
    
}
