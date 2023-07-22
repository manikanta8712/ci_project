<?php 
namespace Modules\Models;
use CodeIgniter\Model;

// class HomeModal extends Model{
//     protected $table = 'user'; // Name of the table you want to interact with
//    // protected $returnType = 'array'; // The type of data you want to retrieve (array in this case)
//    protected $primaryKey = 'ID';
//     protected $allowedFields = ['Email', 'Password']; 
// }
class HomeModal extends Model
{
    protected $table = 'user'; // Replace 'user' with the actual table name

    public function getUserByEmail($email)
    {
        return $this->where('Email', $email)
            ->first(); // Retrieves the first row that matches the given email
    }
    public function isuserexists($uid)
    {
        $builder = $this->db->table('employees')->select('user_ID')->where('user_ID', $uid)->get();
        $row = $builder->getRowArray();
        if (!empty($row)) {
            return true;
        } else {
            return false;
        }
    }
}
