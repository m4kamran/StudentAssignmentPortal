<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Assignment
 *
 * @author Mario
 */
class Assignment extends My_Model {
    
    public $id;
    
    public $title;
    
    public $description;
    
    public $attachment;
    
    public $course_id;
    
    //public $level_id;
    
    public $grade;
    
    public $deadline;
    
    public $lecturer_id;
    
    protected $primary = 'id';
    
    protected $table = 'assignment';
    
    protected $columns = [
       
        'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
        ),
        'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '500'
        ),
        'attachment' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => true 
        ),
        'course_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
//        'level_id' => array(
//                'type' =>'INT',
//                'constraint' => 3
//        ),
        'lecturer_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'grade' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
                'null' => true
        ),
        'deadline' => array(
                'type' =>'DATETIME',
        ),
       
    ];
    
    
    public function isDue()
    {
        return (date("Y-m-d H:i:s") > $this->deadline) ;
    }
    
    
    public function deleteAttachment()
    {
       $file = dirname(BASEPATH).'/'.$this->attachment;
       
       if(file_exists($file))
       {
           unlink($file);
           $this->attachment = '' ;
       }
    }
    
    
    public function getDuePeriod()
    {
        $this->load->helper('date');
        
        if(!$this->deadline)
        {
            return '' ;
        }
        $unix = human_to_unix($this->deadline);
        
        return date('Y-m-d');
    }
    
    public function getDueTime()
    {
        $this->load->helper('date');
        
        if(!$this->deadline)
        {
            return '' ;
        }
        $unix = human_to_unix($this->deadline);
        
        return date('H:i:s');
    }
}
