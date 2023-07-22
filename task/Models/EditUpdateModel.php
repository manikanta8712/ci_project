<?php

namespace Modules\Models;

use CodeIgniter\Model;

class EditUpdateModel extends Model
{
    protected $table = 'employees';
    //protected $primaryKey = 'id';
    protected $allowedFields = ['firstname', 'lastname', 'salary', 'user_ID'];

    // public function getEmployeesWithImages()
    // {
    //     // Join the 'image_details' table on the 'user_ID' column
    //     // to get the images associated with each employee
    //     return $this->select('employees.*, user.*, employee_images.image')
    //         ->join('user', 'user.ID = employees.user_ID')
    //         ->join('employee_images', 'employee_images.user_ID = employees.user_ID')
    //         ->findAll();
    // }
    public function getPersonDetails($user_ID)
    {
        $personData = $this->db->query("SELECT employees.*, user.*, GROUP_CONCAT(employee_images.image) AS images
        FROM employees
        JOIN user ON user.ID = employees.user_ID
        JOIN employee_images ON employee_images.user_ID = employees.user_ID
        WHERE user.ID = $user_ID
        GROUP BY employees.user_ID")
            ->getRowArray();

        return $personData;
    }

    // delete
    public function deleteEmployeeAndImages($user_ID)
    {
        // Start a database transaction to ensure data consistency
        $this->db->transBegin();

        // Delete the employee
        $this->where('user_ID', $user_ID)->delete();

        // Delete the associated image from 'employee_images' table
        $this->db->table('employee_images')->where('user_ID', $user_ID)->delete();

        // Check if any error occurred during the deletion process
        if ($this->db->transStatus() === false) {
            // Something went wrong, rollback the transaction
            $this->db->transRollback();
            return false;
        } else {
            // Everything is fine, commit the transaction
            $this->db->transCommit();
            return true;
        }
    }

    // update
    public function updatestatus1($firstname, $lastname, $salary, $emp_id)
    {
        // Define the data to be updated
        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'salary' => $salary
        );
        // Use CodeIgniter's update() method to update the 'employee' table
        $resultsts = $this->db->table('employees')->where('user_ID', $emp_id)->update($data);
        if ($resultsts) {
            return true;
        } else {
            return false;
        }
    }
    public function updatestatus3($Phonenumber, $emp_id)
    {
        // Define the data to be updated
        $data = array(
            'PhoneNumber' => $Phonenumber,
        );
        // Use CodeIgniter's update() method to update the 'employee' table
        $resultsts = $this->db->table('user')->where('ID', $emp_id)->update($data);
        if ($resultsts) {
            return true;
        } else {
            return false;
        }
    }
    public function insertstatus2($data2)
    {
        if (count($data2) != 0) {
            $results = $this->db->table('employee_images')->insert($data2);
        }
        if ($results) {
            return true;
        } else {
            return false;
        }
    }
}
