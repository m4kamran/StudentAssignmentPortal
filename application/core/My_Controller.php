<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Controller
 *
 * @author Mario
 */
class My_Controller extends CI_Controller {
   
    /**
     *
     * @var User 
     */
    public $current_user;
    
    public $current_user_role = 'student';
    
    public $layout = 'layouts/page' ;

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(config_item('show_profiler'));
        $this->load->database();
    }

    protected function _secure()
    {
        // user already logged in?
        if($this->current_user && $this->current_user->id)  
        {
            return;
        }
        
        $this->_current_user();
        
        if(!$this->current_user || !$this->current_user->id)
        {
            redirect('/users/login');
        }
        // user is logged in 
        $this->current_user_role = $this->current_user->role ;
        
        
    }
    
    protected function _current_user()
    {
        $id = $this->session->userdata ("user_id");
        
        if($id)
        {
            $this->load->model('user');
            $this->current_user = $this->user->getOne(['id' => $id]);
        }
        
        return $this->current_user;
    }
    
    
    protected function _studentOnly()
    {
        $this->_current_user();
        
        if(!$this->current_user || !$this->current_user->isStudent())
        {
            redirect('users/profile');
        }
    }
    protected function _lecturerOnly()
    {
        $this->_current_user();
        
        if( !$this->current_user || !$this->current_user->isLecturer())
        {
            redirect('users/profile');
        }
    }
    protected function _adminOnly()
    {
        $this->_current_user();
        
        if(!$this->current_user || !$this->current_user->isSuperAdmin())
        {
            redirect('users/profile');
        }
    }

    /**
     * Load the view
     * 
     * This should be used by controllers
     * 
     * it autoload the layout and set 'user' index to current user for the view 
     * 
     * @param type $file
     * @param type $data
     * @param type $return
     * @param type $load_layout
     * @return type
     */
    protected function _view($file = '' , $data = '' , $return = false , $load_layout = true)
    {
        $this->_current_user();
        
        if(!$data)
        {
            $data = array();
        }
        
        $data['user'] = $this->current_user;
        
        
        $main_view = $this->load->view($file , $data , true );
        
        if($load_layout)
        {
            $layout = $this->load->view($this->layout , ['main_view' => $main_view] , true );
        }
        
        if($return) return $layout;
        
        echo $layout;
    }
}
