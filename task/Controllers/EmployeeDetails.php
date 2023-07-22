<?php

namespace Modules\Controllers;

use App\Controllers\BaseController;
use Modules\Models\EmployeeModel;

class EmployeeDetails extends BaseController
{
    /*Insert*/
    protected $employeeModel;

    public function __construct()
    {
        /* Load Model */
        $this->employeeModel = new EmployeeModel();
    }
    /*Insert*/
    public function employee()
    {
        //echo "hello";
        /* Check if the form is submitted */
        if ($this->request->is('post')) {
            $pic = $this->request->getFileMultiple('image');
            //echo "hi";
           // exit;
           $fileNames = array();
          // $target_dir = "ci_project\uploads";
        //    if (!file_exists($target_dir)) {
        //     mkdir($target_dir, 0777, true); // Create the directory with full permissions (777)
        // }
        foreach ($pic as  $profilepic) {
            $extension = $profilepic->getClientExtension();
            if (!empty($extension) && in_array($extension, ["jpg", "jpeg", "png", "gif"])) {
                $uniqueId = uniqid(); // Generate a unique ID
                $timestamp = time(); // Get the current timestamp
                $newFileName = $uniqueId . '_' . $timestamp . '.' . $extension; // Construct a new file name
                // echo $newFileName;exit;
                $target_dir = "./ci_project";
                $target_file = $target_dir . $newFileName;
                if ($profilepic->isValid() && !$profilepic->hasMoved()) {
                    $profilepic->move($target_dir, $newFileName);
                    //echo "The file " . $profilepic->getName() . " has been uploaded.";
                    $jsonFileName = json_encode($newFileName);
                   // echo $jsonFileName;exit;
                    $imageDetails = [
                        'username' => session()->get('user_name'),
                        'image' => $jsonFileName,
                        'user_ID' => session()->get('id')
                    ];
                   // print_r( $imageDetails);exit;
                    $response2 = $this->employeeModel->saveImageAndDetails($imageDetails);
                } else {

                    echo "File upload failed.";
                }
            } else {

                echo "Invalid file extension. Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        }
           // echo $target_dir;
           // Loop through each uploaded file
   
           // Convert array of file names to a comma-separated string
          // $images = implode(',', $fileNames);

            // Make sure $password is not null and is a string
            $dataUser  = [
                'firstname'  => $this->request->getPost('firstName'),
                'lastname'  => $this->request->getPost('lastName'),
                'salary'  => $this->request->getPost('salary'),
                'user_ID' => session()->get('id')
            ];
            

            $response = $this->employeeModel->saveUserAndDetails($dataUser);

            if ($response === true) {
               // echo "Records Saved Successfully";
               return redirect()->to(base_url('/view'));
            } else {
                echo "Insert error!";
            }
        } else {
            echo "Invalid password format.";
        }
    }
}
