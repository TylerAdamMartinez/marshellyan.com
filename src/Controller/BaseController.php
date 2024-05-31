<?php

namespace App\Controller;

abstract class BaseController
{
    protected function view($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../../views/" . $view . ".php";
    }
}
