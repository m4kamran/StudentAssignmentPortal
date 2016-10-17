<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_course
 *
 * @author Mario
 */
class Student_Course extends My_Model{
    
    public $id;
    
    public $user_id;
    
    public $course_id;
    
    // join
    public $user_department;
    public $user_level;
    
    protected $table = 'student_course';
    
   


    protected $columns = [
        'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'user_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'course_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
    ];
    
    
    public function getStudents($course_id = '')
    {
        $objects = [];
       
        $this->db->select(['student_course.*',
            'user.name as user_name',
            'user.department_id as user_department_id',
            'user.level_id as user_level_id',
            'user.matric as user_matric',
            'level.name as user_level',
            'department.name as user_department',
        ]);  
        $this->db->where(['course_id' => $course_id]);  
       
        $this->db->join('user' , 'user.id = student_course.user_id');
         $this->db->join('department' , 'user.department_id = department.id');
        $this->db->join('level' , 'user.level_id = level.id');
        
        $query = $this->db->get( $this->getTable() );
        
        // is  table created
        foreach ( $query->result_array() as $row ) 
        {
            $objects[] = new self($row);
        }
        
	return $objects;
    }
    
    
    public function getStudentCourseIds($user_id = '')
    {
        $objects = [];
       
        $this->db->where(['user_id' => $user_id]);  
       
        $query = $this->db->get( $this->getTable() );
        // is  table created
        foreach ( $query->result_array() as $row ) 
        {
            $objects[] = $row['course_id'];
        }
        
	return $objects;
    }
    
    
    public function isRegistered($student_id , $course_id)
    {
        $student_course = $this->getOne([
            'user_id' => $student_id,
            'course_id' => $course_id
        ]);
        
        return ($student_course && $student_course->id);
    }

    

    /**
     * 
     * @param int $user_id
     * @param array $course_ids
     * @param array $current_course_ids Optional
     */
    public function register(int $user_id , $course_ids = array(), $current_course_ids = null)
    {
        
        if(!is_array($course_ids))
        {
            return;
        }
        $registered = $current_course_ids ?:  $this->getStudentCourseIds($user_id);
        
        // get new
        $filtered = array_diff($course_ids, $registered);
        
        if(count($filtered))
        {
            $batch = [];
            foreach ($filtered as $cid)
            {
                $obj = new stdClass();
                $obj->user_id = $user_id;
                $obj->course_id = $cid;
                $batch[] = $obj;
            }
            
            $this->db->insert_batch( $this->getTable() , $batch );
        }
        
    }
    /**
     * 
     * @param int $user_id
     * @param array $course_ids
     * @param array $current_course_ids
     */
    public function unregister(int $user_id , $course_ids = array())
    {
       if(!is_array($course_ids))
        {
            return;
        }
        $this->db->where(['user_id' => $user_id]);  
        //$this->db->where_in(['course_id' => $course_ids]);  
        
        $this->db->delete( $this->getTable() ,"course_id IN (". join(',', $course_ids).")" , count($course_ids));
        
    }
}
