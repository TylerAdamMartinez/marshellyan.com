<?php

namespace App\Controller;

class HttpController extends BaseController
{
    public function index()
    {
        $this->view('home', ['message' => 'Welcome to my PHP app!']);
    }

    public function about()
    {
        $this->view('about');
    }
}
