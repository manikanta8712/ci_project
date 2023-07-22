<?php
namespace Modules\Models;

use CodeIgniter\Model;

class SignUpModel extends Model 
{
    protected $table = 'user'; // Specify the table name
    //protected $primaryKey = 'ID'; // Specify the primary key if it's different from 'id'
    protected $allowedFields = ['Name', 'Email', 'Password','PhoneNumber']; // Specify the allowed fields for mass assignment

    public function saverecords($data)
    {
        $this->insert($data); // Use $this->insert() to insert data
        return true;
    }
}
