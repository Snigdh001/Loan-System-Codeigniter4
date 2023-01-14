<?php

namespace App\Controllers;

class Hom extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
}
