<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;
use Modules\Models\SignUpModel;

class Signup extends BaseController
{
    public function index()
    {
        echo view('Modules\Views\signup.php');
    }
    /*Insert*/
    protected $signUpModel;

    public function __construct()
    {
        /* Load Model */
        $this->signUpModel = new SignUpModel();
    }
    /*Insert*/
    public function savedata()
{
    /* Check if the form is submitted */
    if ($this->request->is('post')) {
        $password = $this->request->getPost('password');

        // Make sure $password is not null and is a string
        if (is_string($password) && !empty($password)) {
            $data = [
                'Name'        => $this->request->getPost('name'),
                'Email'       => $this->request->getPost('email'),
                'Password'    => md5($password), // Convert password to MD5
                'PhoneNumber' => $this->request->getPost('number')
            ];

            $response = $this->signUpModel->saverecords($data);

            if ($response === true) {
               // echo "Records Saved Successfully";
               return redirect()->to('/login');
            } else {
                echo "Insert error!";
            }
        } else {
            echo "Invalid password format.";
        }
    }
}

}
