<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;
use Modules\Models\ViewModel;
use Modules\Models\SearchModel;

class EmployeeView extends BaseController
{
    public function view()
{
    $employeeModel = new ViewModel();
    $searchTerm = $this->request->getPost('search');

    // Retrieve data from both tables using the model method
    $data['employees'] = $employeeModel->getEmployeesWithImages($searchTerm);

    // Load the view and pass the data to it
    return view('Modules\Views\view_details', $data);
}

    // search
    public function search()
    {
        $employeeModel = new SearchModel();

        // Get the search term from the form
        $searchTerm = $this->request->getPost('search');

        // Search in both "User" and "Employee" tables using the model method
        $data['employees'] = $employeeModel->searchEmployees($searchTerm);
        //print_r($data);exit;
        // Load the view and pass the data to it
        return view('Modules\Views\search', $data);
    }

    // public function view()
    // {
    //     $employeeModel = new ViewModel();

    //     // Check if a search query is present
    //     $searchQuery = $this->request->getVar('search');

    //     if (!empty($searchQuery)) {
    //         // If a search query exists, retrieve search results from the model
    //         $data['employees'] = $employeeModel->searchEmployeesWithImages($searchQuery);
    //         return view('Modules\Views\view_details', $data);
    //     } else {
    //         // If no search query, retrieve all employees with images
    //         $data['employees'] = $employeeModel->getEmployeesWithImages();
    //         return view('Modules\Views\view_details', $data);
    //     }

    //     // Load the view and pass the data to it
    //    // return view('Modules\Views\view_details', $data);
    // }
}