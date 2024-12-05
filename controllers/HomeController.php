<?php
require_once __DIR__ . '/../models/News.php';

class HomeController
{
    public function index()
    {
     
        require_once 'views/home/index.php';
    }


}