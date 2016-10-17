<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author Mario
 */
class Users extends My_Controller{
   
    
    public $login_title = 'User Login';
    public $login_view = 'login';
    public $profile_view = 'profile';


    public function login()
    {
        $this->_current_user();
        $error = '' ;
        
        if($this->current_user && $this->current_user->id)
        {
            redirect($this->_get_profile_page());
        }
        
        if($this->input->post('login'))
        {
            
            $this->load->model('user');
            
            $user = $this->user->getOne([
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            ]);
            
            if($user->id)
            {
                $this->session->set_userdata ("user_id" , $user->id);
                redirect($this->_get_profile_page());
            }
            $error = "Invalid credentials";
        }
        
        $this->_view($this->login_view, [
            'error' => $error,
            'login_title' => $this->login_title
        ]);
    }
    
    
    public function profile()
    {
        $this->_secure();
        
        $success = false;
        $error = '' ;
        $prev_pass = $this->current_user->password;
        
        $department = $this->current_user->getDepartment();
        $level = $this->current_user->getLevel();
        
        if($this->input->post('update'))
        {
            
            $this->current_user->setProperties($this->input->post());
            
            if(!$this->input->post('password'))
            {
                $this->current_user->password = $prev_pass;
            }
            else if($this->input->post('password') != $this->input->post('password-confirm'))
            {
              $error = 'Pasword not match' ; 
            }
            if(!$error)
            {
                
                $this->current_user->save();
                $success = true;
            }
        }
        
        
        $this->_view($this->profile_view, [
            'user' => $this->current_user,
            'error' => $error,
            'success' => $success ,
            'level' => $level,
            'department' => $department,
        ]);
    }
    public function logout()
    {
        $this->_secure();
        
        $this->session->unset_userdata ("user_id");
        
        redirect($this->_get_login_page());
        
    }
    
    
    
    
    
    
    /**
     * 
     * @return string
     */
    protected function _get_login_page()
    {
        
        return '/users/login';
    }
    /**
     * 
     * @return string
     */
    protected function _get_profile_page()
    {
        
        return '/users/profile';
    }
}
