<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;

class Signup extends BaseController
{
    public function index()
    {
        echo view('Modules\Views\signup.php');
    }
}