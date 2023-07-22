<?php

namespace Modules\Models;

use CodeIgniter\Model;

class SearchModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'user_ID';
    protected $allowedFields = [
        'UID', 'firstname', 'lastname', 'salary'
    ];

    public function getEmployeesWithImages()
    {
        return $this->findAll();
    }

    public function searchEmployees($searchTerm)
    {
        return $this->query('SELECT employees.*, user.*, GROUP_CONCAT(employee_images.image) AS images
        FROM employees
        JOIN user ON user.ID = employees.user_ID
        JOIN employee_images ON employee_images.user_ID = employees.user_ID
        GROUP BY employees.user_ID')
            ->like('firstname', $searchTerm)
            ->orLike('lastname', $searchTerm)
            ->orLike('salary', $searchTerm)
            ->like('Name', $searchTerm)
            ->orLike('Email', $searchTerm)
            ->orLike('PhoneNumber', $searchTerm)
            ->findAll();
   }
}
