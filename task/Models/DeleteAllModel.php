<?php
namespace Modules\Models;

use CodeIgniter\Model;

class DeleteAllModel extends Model 
{
    //protected $userTable = 'employees'; // Specify the user table name
    protected $userDetailsTable = 'employee_images'; // Specify the user_details table name

   // protected $allowedUserFields = ['firstname', 'lastname', 'salary','user_ID']; // Specify the allowed fields for mass assignment in the user table
    protected $allowedUserDetailsFields = ['username', 'image','user_ID']; // Specify the allowed fields for mass assignment in the user_details table
}