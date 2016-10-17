<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Mario
 */
class User extends My_Model{
   
    
    public $id;
    
    public $name;
    
    public $email;
    
    public $password;
    
    public $address;
    
    public $matric;
    
    public $sex;
        
    public $level_id = 0;
    
    public $department_id = 0;
    
    public $is_admin;
    
    /**
     * 
     * @var string  student|teacher|staff
     */
    public $role = '';
    
    protected $table = 'user';

    // join 
    public $department_name;
    public $level_name;
    protected $columns = [
        'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
        ),
        'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
        ),
        'email' => array(
                'type' =>'VARCHAR',
                'constraint' => '100'
        ),
        'address' => array(
                'type' =>'VARCHAR',
                'constraint' => '300',
                'null' => TRUE
        ),
        'password' => array(
                'type' =>'VARCHAR',
                'constraint' => '100'
        ),
        'sex' => array(
                'type' =>'VARCHAR',
                'constraint' => '100'
        ),
        'matric' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
                'null' => true
        ),
        'level_id' => array(
                'type' =>'INT',
                'constraint' => 5
        ),
        'department_id' => array(
                'type' =>'INT',
                'constraint' => 5
        ),
        'role' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
                'default' => 'student'
        ),
        'is_admin' => array(
                'type' => 'smallint',
                'constraint' => 1,
                'default' => 0,
                'null' => true
        ),
    ];
    
    
    public function isStudent()
    {
        return ($this->role == 'student');
    }
    
    public function isLecturer()
    {
        return ($this->role == 'lecturer');
    }
    
    
    public function isSuperAdmin()
    {
        return $this->is_admin;
    }
    
    
    public function getLevel()
    {
        $this->load->model('level');
        
        return $this->level->getOne(['id' => $this->level_id]);
    }
    public function getDepartment()
    {
        $this->load->model('department');
        
        return $this->department->getOne(['id' => $this->department_id]);
    }
    
    
    public function getUsers(  $where = '', $page = '' ,$limit = '', $order = '' , $direction = '')
    {
        $this->db->reset_query();
        $this->db->select(['user.*',
            'level.name as level_name',
            'department.name as department_name',
        ]);  
                 
        $this->db->join('department' , 'user.department_id = department.id' , 'left');
        $this->db->join('level' , 'user.level_id = level.id' , 'left');
        
        return $this->getAll($where ,'' , $page , $limit , $order , $direction );
    }
    
}