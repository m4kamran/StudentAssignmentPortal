<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Mario
 */
class Home extends My_Controller{
    /**
     * We make the home page require user to login
     */
    function index()
    {
        $this->_current_user();
        
        $this->_view('home');
    }
}
