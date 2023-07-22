<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;
use Modules\Models\AdminModel;

class AdminController extends BaseController
{
    public function updateUserAdminStatus()
    {
        
       // $userId = $this->request->getPost('userId');
        $adminStatus = $this->request->getVar('selectedadminValues');
        //print_r($adminStatus);exit;
        $adminModel = new AdminModel();
        $adminModel->updateUserAdminStatus( $adminStatus);

        // Return a response (optional)
        $response['status'] = 'success';
        return $this->response->setJSON($response);
    }
    
}