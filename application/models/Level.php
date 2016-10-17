<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Level
 *
 * @author Mario
 */
class Level extends My_Model{
    
     public $id;
    
    public $name;
            
    
    protected $table = 'level';
    
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
        )
      
    ];
}
