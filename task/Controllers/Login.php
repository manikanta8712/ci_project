<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;
use Modules\Models\HomeModal;

class Login extends BaseController
{
    public function index()
    {
        echo view('Modules\Views\login.php');
    }
}