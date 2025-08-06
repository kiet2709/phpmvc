<?php

namespace Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Welcome to My MVC'];
        $this->view('home/index', $data);
    }
}
