<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function set_active_class($url = '' , $current_url = '' , $active_class = 'active')
{
    $current_url = $current_url ?: uri_string();
    
    if($url == $current_url)
    {
        return $active_class;
    }
}
