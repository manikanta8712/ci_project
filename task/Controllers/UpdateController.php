<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;
use Modules\Models\EditUpdateModel;
//use Modules\Models\DeleteAllModel;
class UpdateController extends BaseController
{
    // function __construct()
    // {

    //     // $this->data = [];

    //     $this->ViewModel = new ViewModel();

    // }
    // public function index()
    // {
    //     $employeeModel = new EditUpdateModel();

    //     // Retrieve data from both tables using the model method
    //     $data['employees'] = $employeeModel->getEmployeesWithImages();
    //     //print_r($data);exit;

    //     // Load the view and pass the data to it
    //     return view('Modules\Views\update_view', $data);
    //     //echo view('Modules\Views\update_view');
    // }

    public function editPerson($user_ID)
    {
        $personModel = new EditUpdateModel();

        // Get the person's details using the custom model
        $personData = $personModel->getPersonDetails($user_ID);
        //$data['person'] = array($personData);
        $data['person'] = $personData;
        //print_r($data);exit;
        //print_r($personData);exit;
        // Check if the person exists
        if (!$personData) {
            return redirect()->back()->with('error', 'Person not found.');
        }

        return view('Modules\Views\update_view', ['person' => $data]);
    }
    public function preview($user_ID)
    {
        $personModel = new EditUpdateModel();

        // Get the person's details using the custom model
        $personData = $personModel->getPersonDetails($user_ID);
        //$data['person'] = array($personData);
        $data['person'] = $personData;
        //print_r($personData);exit;
        // Check if the person exists
        if (!$personData) {
            return redirect()->back()->with('error', 'Person not found.');
        }

        return view('Modules\Views\preview', ['person' => $data]);
    }

    // delete
    public function delete($user_ID)
    {
        // Load the EditUpdateModel
        $personModel = new EditUpdateModel();

        // Check if the employee exists
        $employeeData = $personModel->getPersonDetails($user_ID);
        if (empty($employeeData)) {
            // Redirect or show an error message as needed
            // For example, redirect('employees/index') or show_error('Employee not found');
        }

        // Delete the employee and associated image
        $result = $personModel->deleteEmployeeAndImages($user_ID);
        if ($result) {
            session()->setFlashdata('msg', 'deleted successfully');
            // Employee and image deleted successfully
            // You can redirect to a success page or show a success message
            // For example, redirect('employees/index') or show_success_message('Employee deleted successfully');
            return redirect()->to('/view');
        } else {
            // Something went wrong during deletion
            // You can redirect to an error page or show an error message
            // For example, redirect('employees/index') or show_error('Failed to delete employee');
            echo 'Failed to delet data';
        }
    }

    // deleteall
    public function deleteall()
    {
        if ($this->request->isAJAX()) {
            $employeeModel = new EditUpdateModel();
            // $imageModel = new DeleteAllModel();
            // Get the selected checkboxes' values from the POST request
            $selectedIds = $this->request->getPost('del_chk');
            // Delete the selected employees
            $employeeModel->whereIn('user_ID', $selectedIds)->delete();
            //$imageModel->whereIn('user_ID', $selectedIds)->delete();
            // You can return a response if needed
            return $this->response->setJSON(['success' => true]);
        }

        // Redirect to the index page if not an AJAX request
        return redirect()->to('/view');
    }


    public function update()
    {
        $personModel = new EditUpdateModel();
        $Firstname = $this->request->getVar('firstName');
        $Lastname = $this->request->getVar('lastName');
        $Salary = $this->request->getVar('salary');
        $ID = $this->request->getVar('id');
        $Phonenumber = $this->request->getVar('number');
        $pic = $this->request->getFileMultiple('image');
        $updatestatus1 = $personModel->updatestatus1($Firstname, $Lastname, $Salary, $ID);
        $updatestatus3 = $personModel->updatestatus3($Phonenumber, $ID);
        // Handling multiple images
        if ($this->request->is('post')) {
            //echo "hi";
            // exit;
            $fileNames = array();
            $target_dir = "ci_project\uploads";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); // Create the directory with full permissions (777)
            }
            // echo $target_dir;
            // Loop through each uploaded file
            foreach ($pic as  $profilepic) {
                $extension = $profilepic->getClientExtension();
                if (!empty($extension) && in_array($extension, ["jpg", "jpeg", "png", "gif"])) {
                    $uniqueId = uniqid(); // Generate a unique ID
                    $timestamp = time(); // Get the current timestamp
                    $newFileName = $uniqueId . '_' . $timestamp . '.' . $extension; // Construct a new file name
                    $target_dir = "./ci_project";
                    $target_file = $target_dir . $newFileName;
                    if ($profilepic->isValid() && !$profilepic->hasMoved()) {
                        $profilepic->move($target_dir, $newFileName);
                        //echo "The file " . $profilepic->getName() . " has been uploaded.";
                        $jsonFileName = json_encode($newFileName);
                        $data2 = [
                            'image' => $jsonFileName,
                            'user_ID' => $ID,
                        ];

                        $insertstatus2 = $personModel->insertstatus2($data2);
                    } else {

                        echo "File upload failed.";
                    }
                } else {

                    echo "Invalid file extension. Only JPG, JPEG, PNG, and GIF files are allowed.";
                }
            }
        } else {
            echo "File upload failed.";
        }
        if ($updatestatus1 && $updatestatus3) {
            session()->setFlashdata('msg', 'Your Data Updated successfully');
            //echo 'Your Data Updated successfully';
            //return redirect()->to(base_url('/MainHomePage'))->with('success', 'Your Data Updated successfully');
            return redirect()->to('/view');
        } else {

            echo 'Failed to update data';

            //return redirect()->to(base_url('/MainHomePage'))->with('error', 'Failed to update data');

        }
    }
    // public function update()

    // {

    //     $usereditid = $this->request->getGet('id');

    //     $admin = session()->get('loginuid');

    //     $data = $this->ViewModel->getEmployeeEditData($usereditid, $admin);

    //     return view('Modules\Views\update_view', $data);

    // }
}
