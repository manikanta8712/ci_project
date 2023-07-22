<?php 
// app/Models/UserModel.php

namespace Modules\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'user'; // Replace 'users' with your actual table name
    protected $primaryKey = 'ID'; // Replace 'id' with the primary key of the users table

    protected $allowedFields = [
        'admin', // Add other allowed fields as well
    ];

    // public function updateUserAdminStatus($userId, $adminStatus)
    // {
    //     $this->set('admin', $adminStatus)
    //         ->where('ID', $userId)
    //         ->update();
    // }
    public function updateUserAdminStatus($useradmin)
    {
        foreach ($useradmin as $checkbox) {
            $id = $checkbox['id'];
            $admin = $checkbox['admin'];
            $data = array(
                'admin' => $admin
            );
            $result = $this->db->table('user')->where('ID', $id)->update($data);
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
