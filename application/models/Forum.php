<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Forum
 *
 * @author Mario
 */
class Forum extends My_Model{
   
    public $id;
    
    public $name;
    
    public $description;
    
    public $level_id;
    
    public $user_id;
    
    protected $table = 'forum';
    
    protected $columns = [
        'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'name' => array(
                'type' =>'VARCHAR',
                'constraint' => '200'
        ),
        'description' => array(
                'type' =>'VARCHAR',
                'constraint' => '500',
                'null' => true
        ),
        'level_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
        'user_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
    ];
}
