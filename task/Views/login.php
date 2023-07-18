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
            width: 100%;
            background: rgb(65, 202, 192);
            border-color: rgb(65, 202, 192);
        }
    </style>
</head>
<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <h3 class="text_change">Sign In Now</h3>
                        <div class="card-body p-5 text-center">

                            <!-- <h3 class="mb-5">Sign in</h3> -->
                            <form action="<?= base_url('/login'); ?>" method="POST">
                                <div class="form-outline mb-4">
                                    <label class="form-label d-flex" for="typeEmailX-2">Email</label>
                                    <input type="email" name="Email" id="typeEmailX-2" class="form-control form-control-lg" placeholder="Enter Your Email" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label d-flex" for="typePasswordX-2">Password</label>
                                    <input type="password" id="typePasswordX-2" name="Password" class="form-control form-control-lg" placeholder="Enter Your password" />
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Login</button>
                                <p><?php if (!empty($show_error)) {
                                        echo $show_error;
                                    } ?></p>
                            </form>
                            <div>
                                <p>Don't have an account?</p>
                                <a type="button" class="button text-decoration-none" href="<?= base_url('/sign'); ?>">Sign Up</a>
                            </div>
                            <hr class="my-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>