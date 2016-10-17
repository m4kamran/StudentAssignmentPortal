<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Model
 *
 * @author Mario
 */
class My_Model extends CI_Model{
    
    protected $table ;
    
    protected $columns;

    protected $primary = 'id';
    
    
     // this is used for join query
    public $user_name;
    public $lecturer_name;
    public $user_department_id;
    public $user_level_id;
    public $user_matric;
    
    public function __construct($data = null) {
        parent::__construct();
        $this->setProperties($data);
    }
    
    
    public function setProperties($data = null)
    {
        if(is_array($data))
        {
            foreach ($data as $key => $value)
            {
                if (property_exists($this, $key))
                {
                    $this->{$key} = $value;
                }
            }
        }
    }
    
    
    public function count($where = '')
    {
        $this->db->where( $where );
            
        $total = $this->db->count_all_results( $this->getTable() ) ;
    }

    public function getOne( $where = null, $fields = null)
    {
        
        if ( $where )
        {
            $this->db->where($where);  
        }
        if ( $fields )	
        {
           $this->db->select( join(',' ,$fields));
        }
        
        $this->db->limit(1);

        $query =  $this->db->get( $this->getTable() );
        // initialze the data
        $data = $query->row_array();
        $class  = get_class($this) ;
        return new $class( $data );
    }
    
    
    public function getAll($where = '' , $fields = '', $page = '' ,$limit = '', $order = '' , $direction = '' )
    {
        $objects = [];
        // select fields
         if ( $where )
        {
            $this->db->where($where);  
        }
        if ( $fields )	
        {
           $this->db->select( join(',' ,$fields));
        }
        
        // order results
        if ( $order )
        {
            $this->db->order_by($order, $direction);
        }
              
        $offset = '';
        // limit results
        if ( $limit && is_int($page)  )
        {
            $offset = ( $page - 1 ) * $limit;
        }
        if ( $limit ) 
        {
            $this->db->limit($limit, $offset);
        }
           
        $query = $this->db->get( $this->getTable() );
        $class = get_class($this);
        // is  table created
        foreach ( $query->result_array() as $row ) 
        {
            // create + populate user
            $object = new $class($row);
            array_push( $objects , $object );
        }
        
	return $objects;
    }
    
    public function delete()
    {
        
    }
    
    
    /**
     * Save data 
     * @return int Last insert id if insert operation is done
     */
    public function save()
    {
        $data = [];
        $primary = $this->primary;
        
        foreach ($this->columns as $name => $meta)
        {
            $data[$name] = $this->{$name} ;
        }
        
        if($this->{$primary})
        {
            $where = [
                $primary => $this->{$primary}
            ];
            $this->db->update(  $this->getTable(), $data,$where );
        }
        else
        {
            $this->db->insert(  $this->getTable(), $data);
            return $this->db->insert_id();
        }
    }
    
    
    public function getPrimaryKey()
    {
        return $this->primary;
    }

    public function getTable()
    {
        
        if(!$this->table)
        {
            show_error("Table name not set for model: ". get_class($this));
        }
        return $this->table;
    }

    public function createTable()
    {
        $this->load->dbforge();
        
        $primary = $this->getPrimaryKey();
        
        if($primary)
        {
            $this->dbforge->add_key( $primary , TRUE ); 
        }
        
        
        $this->dbforge->add_field($this->columns);
        
        $this->dbforge->create_table($this->getTable() , TRUE);
    }
    
    public function dropTable()
    {
        $this->load->dbforge();
        
        $this->dbforge->drop_table($this->getTable() , TRUE);
    }
}
