<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sudent_Assignment
 *
 * @author Mario
 */
class Student_Assignment extends My_Model {
    
    
    public $id;
    
    public $submitted;
    
    public $assignment_id;
    
    public $user_id;
    
    public $score;
    
    public $answer;
    
    public $attachment;
    
    public $remarks;
    
    public $notes;
    
    
     protected $table = 'student_assignment';
    
     // join 
     public $user_department ;
     public $user_level ;
     
    protected $columns = [
        'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'submitted' => array(
                'type' =>'datetime',
        ),
        'assignment_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'user_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'score' => array(
                'type' =>'VARCHAR',
                'constraint' => '500',
                'null' => true
        ),
        'answer' => array(
                'type' =>'TEXT',
                'null' => true
        ),
        'attachment' => array(
                'type' =>'VARCHAR',
                'constraint' => '500',
                 'null' => true
        ),
        'remarks' => array(
                'type' =>'VARCHAR',
                'constraint' => '500',
                'null' => true
        ),
        'notes' => array(
                'type' =>'VARCHAR',
                'constraint' => '500',
                'null' => true
        )
    ];
    
    
    
    public function getAnswers($where = '')
    {
        $objects = [];
       
        $this->db->select(['student_assignment.*',
            'user.name as user_name',
            'user.department_id as user_department_id',
            'user.level_id as user_level_id',
            'user.matric as user_matric',
            'level.name as user_level',
            'department.name as user_department',
        ]);  
        
        
        if($where)
        {
            $this->db->where($where);
        }
          
       
        $this->db->join('user' , 'user.id = student_assignment.user_id' , 'left');
        $this->db->join('department' , 'user.department_id = department.id', 'left');
        $this->db->join('level' , 'user.level_id = level.id', 'left');
        
        $query = $this->db->get( $this->getTable() );
        
        // is  table created
        foreach ( $query->result_array() as $row ) 
        {
            $objects[] = new self($row);
        }
        
	return $objects;
    }
}
