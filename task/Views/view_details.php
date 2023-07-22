<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <!-- Latest compiled and minified CSS -->
    <link href="bootstrap-5.2.3-dist\css\bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="bootstrap-5.2.3-dist\js\bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>

    </style>
</head>

<body>
    <?php
    if (session()->has('msg')) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . session()->getFlashdata('msg') . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

        // Unset the session message after displaying it
        session()->remove('msg');
    }
    ?>
    <?php
    // $dellmsg = session()->getsetFlashdata('delmsg');
    // if ($dellmsg) {
    //     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $dellmsg . '
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    //     // Unset the session message after displaying it
    //     //session()->unset('msg');
    // }
    ?>
    <h2 class="text-center">Employees Details</h2>
    <form action="<?= base_url('/view'); ?>" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" value="" placeholder="Search Data">
            <button type="submit" class="btn btn-primary">Search</button>
            <a type="button" class="btn btn-danger mx-2" href="<?= base_url('/view'); ?>">Cancel</a>
        </div>
    </form>
    <a type="button" class="btn btn-danger mx-2" href="<?= base_url('/login'); ?>">Logout</a>
    <?php
    $admin = session()->get('admin');
    $id = session()->get('id');
    // echo $admin;
    ?>
    <table class="table table-primary">
        <thead>
            <tr>
                <th>
                    <?php if ($admin == 1) { ?>
                        <button type="submit" id="deleteButton" class="btn btn-light btn-sm all_Delete">Delete</button>
                    <?php } ?>
                </th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Salary</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Picture</th>
                <?php
                if ($admin == 1) {
                ?>
                    <th>Admin</th>
                <?php
                }
                ?>
                <th>Actions</th>
                <!-- <a class="btn btn-primary" href="<?= base_url('/login'); ?>">Logout</a> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td>
                        <?php if ($admin == 1 && $employee['admin'] != 1) { ?>
                            <input class="form-check-input checkall" name="del_chk[]" type="checkbox" value="<?= $employee['user_ID'] ?>">
                        <?php } ?>
                    </td>
                    <td><?= $employee['UID'] ?></td>
                    <td><?= $employee['firstname'] ?></td>
                    <td><?= $employee['lastname'] ?></td>
                    <td><?= $employee['salary'] ?></td>
                    <td><?= $employee['Name'] ?></td>
                    <td><?= $employee['Email'] ?></td>
                    <td><?= $employee['PhoneNumber'] ?></td>
                    <td>

                        <?php
                        // Convert the images string into an array
                        $images = explode(',', $employee['images']);

                        // Get the first image URL
                        $firstImage = isset($images[0]) ? trim($images[0], '" ') : null;

                        if (!empty($firstImage)) : ?>
                            <!-- Use base_url() to get the absolute URL to the first image -->
                            <img src="<?php echo base_url('ci_project/' . $firstImage); ?>" alt="" width="100px" height="100px">
                        <?php endif; ?>

                    </td>
                    <?php
                    if ($employee['ID'] == $id && $admin == 1) {
                    ?>
                        <td> </td>
                    <?php
                    } elseif ($employee['admin'] == 1 && $admin == 1) {
                    ?>
                        <td><input type="checkbox" checked class="adminCheckbox" value="<?php echo $employee['user_ID']; ?>">
                        </td>
                    <?php
                    } elseif ($admin == 1) {
                    ?>
                        <td><input type="checkbox" class="adminCheckbox" value="<?php echo $employee['user_ID']; ?>">
                        </td>
                    <?php
                    }
                    ?>
                    <td>
                        <a class='btn btn-warning' href='<?= base_url('/preview') ?>/<?= $employee['user_ID']; ?>'>Preview</a>
                        <?php
                        if ($admin == 1) {
                            if ($employee['ID'] == $id && $admin == 1) {
                        ?>

                                <a class='btn btn-primary' href="<?= base_url('/edit') ?>/<?= $employee['user_ID']; ?>">Edit</a>
                            <?php
                            } elseif ($employee['admin'] == 1) {
                            ?>
                            <?php
                            } else {
                            ?>
                                <a class='btn btn-primary' href="<?= base_url('/edit') ?>/<?= $employee['user_ID']; ?>">Edit</a>
                                <a class='btn btn-danger delete' href='<?= base_url('/delete') ?>/<?= $employee['user_ID']; ?>' onclick="return confirmDelete();">Delete</a>
                            <?php
                            }
                        } else {
                            if ($id == $employee['ID']) {
                            ?>
                                <a class='btn btn-primary' href="<?= base_url('/edit') ?>/<?= $employee['user_ID']; ?>">Edit</a>
                        <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // delete alert
        function confirmDelete() {
            return confirm('Are you sure you want to delete this employee?');
        }
        $(document).ready(function() {
            $('.adminCheckbox').on('change', function() {
                var selectedadminValues = [];
                // Loop through all the checkboxes
                $('.adminCheckbox').each(function() {
                    var adminValue = $(this).is(':checked') ? 1 : 0;
                    var checkboxValue = $(this).val();
                    //alert(checkboxValue);
                    // Only add to selectedadminValues if the checkbox is checked or the admin value is 1
                    if (adminValue === 1 || adminValue === 0) {
                        selectedadminValues.push({
                            id: checkboxValue,
                            admin: adminValue
                        });
                    }
                });
                // const userId = $(this).data('userid');
                //const adminStatus = $(this).prop('checked') ? 1 : 0;
                // alert(adminStatus);

                $.ajax({
                    url: "<?php echo base_url('admin'); ?>",
                    method: "POST",
                    data: {
                        selectedadminValues: selectedadminValues,
                    },
                    dataType: "json",
                    success: function(response) {
                        // Handle success response if needed
                        window.location.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle error response if needed
                    }
                });
            });
        });
        // for delete all
        $(document).ready(function() {
            $('#deleteButton').click(function() {
                // Get the selected checkboxes
                var selectedIds = $('input.checkall:checked').map(function() {
                    return this.value;
                }).get();

                if (selectedIds.length > 1) {
                    // Show an alert box to confirm the delete action
                    var confirmation = confirm('Are you sure you want to delete selected employees?');

                    if (confirmation) {
                        // Send the selected checkbox values to the server to delete
                        $.ajax({
                            url: '<?= base_url('deleteall'); ?>',
                            type: 'post',
                            data: {
                                del_chk: selectedIds
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    // Reload the page after successful deletion
                                    location.reload();
                                }
                            }
                        });
                    }
                } else {
                    // Show an alert if no checkboxes are selected
                    alert('Please select at least two employees to delete.');
                }
            });
        });
    </script>

</body>

</html>