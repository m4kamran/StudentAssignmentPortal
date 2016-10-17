<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Forum_User
 *
 * @author Mario
 */
class Forum_User extends My_Model{
    
    
    public $id;
    
    public $user_id;
    
    public $forum_id;


    protected $table = 'forum_user';
    
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
        'forum_id' => array(
                'type' =>'INT',
                'constraint' => 3
        ),
    ];
}
