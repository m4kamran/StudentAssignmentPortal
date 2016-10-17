<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course_Material
 *
 * @author Mario
 */
class Course_Material extends My_Model{
    
    public $id;
    
    public $course_id;
    
    public $lecturer_id;
    
    public $title;
    
    public $path;
    
    public $file_type;
    
    public $description;
    
    protected $primary = 'id';
    
    protected $table = 'course_material';
    
    protected $columns = [
       
        'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'course_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'lecturer_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'title' => array(
                'type' =>'VARCHAR',
                'constraint' => '200'
        ),
        'path' => array(
                'type' =>'VARCHAR',
                'constraint' => '300'
        ),
        'file_type' => array(
                'type' =>'VARCHAR',
                'constraint' => '100'
        ),
        'description' => array(
                'type' =>'VARCHAR',
                'constraint' => '500',
                'null' => true 
        ),
       
    ];
}
