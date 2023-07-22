<?php
namespace Modules\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model 
{
    protected $userTable = 'employees'; // Specify the user table name
    protected $userDetailsTable = 'employee_images'; // Specify the user_details table name

    protected $allowedUserFields = ['firstname', 'lastname', 'salary','user_ID']; // Specify the allowed fields for mass assignment in the user table
    protected $allowedUserDetailsFields = ['username', 'image','user_ID']; // Specify the allowed fields for mass assignment in the user_details table

    public function saveUserAndDetails($dataUser)
    {
        $this->db->transStart(); // Start a transaction to ensure both inserts are successful or none are

        // Insert data into the user table
        $this->db->table($this->userTable)->insert($dataUser);

        // Insert data into the user_details table
        //$this->db->table($this->userDetailsTable)->insert($imageDetails);

        $this->db->transComplete(); // Complete the transaction

        // Check if both inserts were successful
        if ($this->db->transStatus() === true) {
            return true;
        } else {
            return false;
        }
    }
    public function saveImageAndDetails($imageDetails)
    {
        $this->db->transStart(); // Start a transaction to ensure both inserts are successful or none are

        // Insert data into the user table
        //$this->db->table($this->userTable)->insert($dataUser);

        // Insert data into the user_details table
        $this->db->table($this->userDetailsTable)->insert($imageDetails);

        $this->db->transComplete(); // Complete the transaction

        // Check if both inserts were successful
        if ($this->db->transStatus() === true) {
            return true;
        } else {
            return false;
        }
    }
}
