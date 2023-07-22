<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- Latest compiled and minified CSS -->
    <link href="bootstrap-5.2.3-dist\css\bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="bootstrap-5.2.3-dist\js\bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <style>
        .text_change {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            margin: 0px;
            background: rgb(65, 202, 192);
            border-radius: 13px 13px 0px 0px;
            color: white;
        }

        .btn-block {
            display: block;
            width: auto;
            background: rgb(65, 202, 192);
            border-color: rgb(65, 202, 192);
        }

        .btn-block:hover {
            background: rgb(65, 202, 192);
            border-color: rgb(65, 202, 192);
        }
    </style>
</head>

<body>
    <div class="container">
        <span>Hello <?php
                    // $admin = session()->get('admin');
                    // echo $admin;
                    $user =  session()->get('user');
                    // Access the 'user_name' session variable in the view
                    $userName = session()->get('user_name');
                    $email = session()->get('email');
                    echo $userName . "," .
                        $email; ?> Login successful ,</span>

        <a class="btn btn-primary" href="<?= base_url('/login'); ?>">Logout</a>
        <div>
            <a href="page1.php">page1</a>
            <a href="page2.php">page2</a>
            <a href="page3.php">page3</a>
        </div>
        <h1>This is welcome Page</h1>
    </div>
    </div>
    <section class="">
        <?php
        if (!$user) { ?>
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <h3 class="text_change">Enter Details</h3>
                            <div class="card-body p-5 text-center">

                                <!-- <h3 class="mb-5">Sign in</h3> -->
                                <form id="myForm" action="<?= base_url('/employee'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="firstName">firstName</label>
                                        <input type="text" name="firstName" id="firstName" class="form-control form-control-lg" placeholder="Enter Your firstName" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="lastName">lastName</label>
                                        <input type="text" id="typePasswordX-2" name="lastName" class="form-control form-control-lg" placeholder="Enter Your lastName" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="lastName">salary</label>
                                        <input type="text" id="salary" name="salary" class="form-control form-control-lg" placeholder="Enter Your salary" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label d-flex" for="lastName">Image</label>
                                        <input type="file" id="image" name="image[]" class="form-control form-control-lg" multiple />
                                        <p>Accept jpeg,jpg,png,gif</p>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary btn-lg btn-block" value="SUBMIT" type="submit">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
            echo "<div class='d-flex justify-content-center align-items-center'>";
            echo "<h1 class='text-center'>You Have Already Entered Details</h1>,";
            echo "<a class='btn btn-primary text-center' href='" . base_url('/view') . "'>List View</a>";
            echo "</div>";
        }
        ?>
    </section>
    <script>
        $.validator.addMethod("extension", function(value, element, param) {
            param = typeof param === "string" ? param.replace(/,/g, "|") : "jpg|jpeg|gif|png";
            return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
        }, "Please enter a valid image file.");

        $("#myForm").validate({
            rules: {
                firstName: {
                    required: true,
                    //regex: "^[a-zA-Z0-9-_.(&),\'/ ]+$",
                },
                lastName: {
                    required: true,
                    // regex: "^[a-zA-Z0-9-_.(&),\'/ ]+$",
                },
                salary: {
                    required: true,
                    digits: true,
                    minlength: 2,
                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|gif|png",
                },
            },
            messages: {
                firstName: {
                    required: "Please Enter firstName.",
                    //regex: "Invalid Characters.",
                },
                lastName: {
                    required: "Please Enter lastName.",
                    //regex: "Invalid Characters.",
                },
                salary: {
                    required: "Please enter your salary",
                    digits: "Please enter only digits",
                },
                image: {
                    required: "please upload image",
                    extension: "please upload image jpg,jpeg,gif,png",
                },
            },
            submitHandler: function(form) {
                // Called when the form is valid and ready to be submitted
                form.submit();
            }
        });
    </script>
</body>

</html>