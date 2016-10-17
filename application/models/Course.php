<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course
 *
 * @author Mario
 */
class Course extends My_Model{
   
   
    
    public $id;
    
    public $title;
    
    public $code;
    
    public $is_core;
    
    public $units = 2;
    
    public $lecturer_id;
    
    public $level_id = 0;
    
    public $department_id = 0;
    
    public $description;
    
    protected $primary = 'id';
    
    protected $table = 'course';
    
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
        'code' => array(
                'type' =>'VARCHAR',
                'constraint' => '100'
        ),
        'is_core' => array(
                'type' =>'tinyint',
                'constraint' => 1,
                'null' =>  true
        ),
        'description' => array(
                'type' =>'VARCHAR',
                'constraint' => '500' ,
                'null' => true
        ),
        'units' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'level_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'department_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'lecturer_id' => array(
                'type' =>'INT',
                'constraint' => 3 ,
                'null' => true
        ),
       
    ];
}
