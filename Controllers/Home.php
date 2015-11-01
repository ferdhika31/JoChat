<?php
namespace Controllers;
use Resources, Models;

class Home extends Resources\Controller
{    
    public function index(){    
        $data['title'] = 'Ayo chatting!';
        
        $this->output('home', $data);
    }
}