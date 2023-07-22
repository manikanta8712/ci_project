<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link href="bootstrap-5.2.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="bootstrap-5.2.3-dist/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f0f0;
            margin: 0;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            max-width: 500px;
            width: 100%;
            padding: 20px;
            text-align: center;
        }

        .text_change {
            background: rgb(65, 202, 192);
            border-radius: 13px 13px 0px 0px;
            color: white;
            font-size: 24px;
            padding: 10px;
            margin: 0;
        }

        .card-body {
            padding: 30px;
        }

        .mb-2 {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 700;
        }

        .form-outline {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;
        }

        .form-outline p {
            margin: 10px 0;
        }

        .form-outline img {
            display: block;
            margin: 10px auto;
            max-width: 100%;
            height: auto;
        }

        .btn-block {
            margin: 2px;
            background: rgb(65, 202, 192);
            border-radius: 0px 0px 10px 10px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: black;
            font-size: x-large;
        }

        .btn-block:hover {
            border-color: rgb(65, 202, 192);
        }
    </style>
</head>

<body>
    <div class="card">
        <h3 class="text_change">Details</h3>
        <?php foreach ($person as $employee) { ?>
            <div class="card-body">
                <form id="myForm" action="employee_data.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-2">
                        <span class="font-weight-bold text-uppercase">FirstName:</span>
                        <span class=""><?= $employee['firstname']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="text-uppercase">LastName:</span>
                        <span class=""><?= $employee['lastname']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="form-label text-uppercase">Salary:</span>
                        <span class=""><?= $employee['salary']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="text-uppercase">Username:</span>
                        <span class=""><?= $employee['Name']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="text-uppercase">Email:</span>
                        <span class=""><?= $employee['Email']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="form-label text-uppercase">Phone Number:</span>
                        <span class=""><?= $employee['PhoneNumber']; ?></span>
                    </div>
                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="image">Image</label>
                                        <?php
                                        // Convert the images string into an array
                                        $images = explode(',', $employee['images']);
                                    //print_r($images);
                                        foreach ($images as $image) {
                                            // Trim leading/trailing spaces and double quotes from the image URL
                                            $imageUrl = trim($image, ' "');
                                            if (!empty($imageUrl)) :
                                        ?>
                                                <!-- Use base_url() to get the absolute URL to the image -->
                                                <img src="<?php echo base_url('ci_project/' . $imageUrl); ?>" alt="" width="100px" height="100px">
                                        <?php
                                            endif;
                                        }
                                        ?>
                                        <input type="file" id="image" name="image[]" class="form-control form-control-lg" multiple />
                                        <p>Accept jpeg, jpg, png, gif</p>
                                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary btn-lg btn-block" href="<?= base_url('/view'); ?>" type="submit">Cancel</a>
                    </div>
                </form>
            <?php } ?>
            </div>
    </div>
</body>

</html>