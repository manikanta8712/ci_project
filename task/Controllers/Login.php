<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;
use Modules\Models\HomeModal;

class Login extends BaseController
{
    public function index()
    {
        //echo "hello";
        // $model = new HomeModal();
        //print_r($model);
        //  $data['results'] = $model->findAll(); // Retrieves all records from the 'user' table
        //print_r($data);
        $model = new HomeModal();
        //     $data['results'] = $model->findAll(); // Retrieves all records from the 'user' table

        if ($this->request->is('post')) {
            // echo'hi';
            //exit;
            $email = $this->request->getVar('Email');
            $password = $this->request->getVar('Password');

            $userModel = new HomeModal();
            $user = $userModel->getUserByEmail($email);

            if (!$user) {
                $show_error = "Invalid Email";
            } elseif (md5($password) !== $user['Password']) {
                $show_error = "Email and Password Not Matched";
            } else {
                // Authentication successful, set session or other necessary actions
                // For example:
                // $this->session->set('user_id', $user['id']);
                // Redirect to the details page
                $isuserexist = $userModel->isuserexists($user['ID']);
                //echo $isuserexist;
                session()->set('user', $isuserexist);
                session()->set('user_name', $user['Name']);
                session()->set('email', $user['Email']);
                session()->set('id', $user['ID']);
                session()->set('admin', $user['admin']);
                return redirect()->to(base_url('/details'));
            }
        }


        return view('Modules\Views\login.php');
    }
    public function details()
    {

        echo view('Modules\Views\enter_details.php');
    }
}
