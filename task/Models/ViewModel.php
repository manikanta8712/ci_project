<?php

namespace Modules\Models;

use CodeIgniter\Model;

class ViewModel extends Model
{
    protected $table = 'employees';
    //protected $primaryKey = 'id';
    protected $allowedFields = ['firstname', 'lastname', 'salary', 'user_ID'];

    public function getEmployeesWithImages($searchValue)
{
    // Join the 'image_details' table on the 'user_ID' column
    // to get the images associated with each employee
    $query = "SELECT employees.*, user.*, GROUP_CONCAT(employee_images.image) AS images
              FROM employees
              JOIN user ON user.ID = employees.user_ID
              JOIN employee_images ON employee_images.user_ID = employees.user_ID
              ";

    if (!empty($searchValue)) {
        $query .= " WHERE CONCAT(firstname, lastname) LIKE '%$searchValue%' OR Email LIKE '%$searchValue%' OR Name LIKE '%$searchValue%' OR PhoneNumber LIKE '%$searchValue%'";
    }

    $query .= " GROUP BY employees.user_ID";

    $employeeData = $this->db->query($query)->getResultArray();
    return $employeeData;
}
    // for search
    // public function searchEmployeesWithImages($query)
    // {
    //     // Join the 'user' table on the 'user_ID' column
    //     // to get the user information associated with each employee
    //     return $this->select('employees.*, user.*')
    //         ->join('user', 'user.ID = employees.user_ID')
    //         ->join('employee_images', 'employee_images.user_ID = employees.user_ID')
    //         ->like('firstname', $query)
    //         ->orLike('lastname', $query)
    //         ->orLike('salary', $query)
    //         ->orLike('UID', $query)
    //         ->orLike('Name', $query)
    //         ->orLike('PhoneNumber', $query)
    //         ->findAll();
    // }
}
