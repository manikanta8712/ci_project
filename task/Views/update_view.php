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
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jquery validation-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f0f0;
            margin: 0;
        }

        .text_change {
            background: rgb(65, 202, 192);
            border-radius: 13px 13px 0px 0px;
            color: white;
            font-size: 24px;
            padding: 10px;
            margin: 0;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            max-width: 500px;
            width: 100%;
        }

        .card-body {
            padding: 30px;
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 700;
        }

        .form-control-lg {
            font-size: 18px;
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
            display: block;
            width: 100%;
            background: rgb(65, 202, 192);
            border-color: rgb(65, 202, 192);
            margin-top: 20px;
        }

        .btn-block:hover {
            background: rgb(65, 202, 192);
            border-color: rgb(65, 202, 192);
        }
    </style>
</head>

<body>
    <section class="">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong">
                        <h3 class="text_change">Edit Details</h3>
                        <div class="card-body p-5">
                            <?php foreach ($person as $employee) { ?>
                                
                                <form id="myForm" action="<?= base_url('/update') ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value='<?= $employee['user_ID']; ?>'>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="firstName">First Name</label>
                                        <input type="text" name="firstName" id="firstName" class="form-control form-control-lg" placeholder="Enter Your First Name" value='<?= $employee['firstname']; ?>' />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="lastName">Last Name</label>
                                        <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" placeholder="Enter Your Last Name" value='<?= $employee['lastname']; ?>' />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="salary">Salary</label>
                                        <input type="text" id="salary" name="salary" class="form-control form-control-lg" placeholder="Enter Your Salary" value='<?= $employee['salary']; ?>' />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control form-control-lg" disabled value='<?= $employee['Name']; ?>' />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="Email">Email</label>
                                        <input type="text" id="Email" name="Email" class="form-control form-control-lg" disabled value='<?= $employee['Email']; ?>' />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="number">Phone Number</label>
                                        <input type="text" id="number" name="number" class="form-control form-control-lg" placeholder="Enter Your Phone Number" value='<?= $employee['PhoneNumber']; ?>' />
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
                                        <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Update</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- script for validation -->
    <script>
        $.validator.addMethod("extension", function(value, element, param) {
            param = typeof param === "string" ? param.replace(/,/g, "|") : "jpg|jpeg|gif|png";
            return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
        }, "Please enter a valid image file.");

        $("#myForm").validate({
            rules: {
                firstName: {
                    required: true,
                },
                lastName: {
                    required: true,
                },
                salary: {
                    required: true,
                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|gif|png",
                },
            },
            messages: {
                firstName: {
                    required: "Please Enter First Name.",
                },
                lastName: {
                    required: "Please Enter Last Name.",
                },
                salary: {
                    required: "Please enter your salary",
                },
                image: {
                    required: "Please upload an image",
                    extension: "Please upload an image with jpg, jpeg, gif, or png format",
                },
            },
        });
    </script>
</body>

</html>