<?php require_once('./core/database.php') ?>

<?php
session_start();

$users = $database->show_all('users');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="text-bg-dark">

    <div class="container mt-5">
        <div class="row">
            <div class="col-9 mx-auto">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-6">
                                <h3 class="m-0">Users</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./add-user.php" class="btn btn-outline-primary">Add User</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['failure']) && !empty($_SESSION['failure'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php
                                echo $_SESSION['failure'];
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['failure']);
                        }

                        if (isset($_SESSION['success']) && !empty($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php
                                echo $_SESSION['success'];
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['success']);
                        }
                        ?>

                        <table class="table table-bordered table-hover m-0">
                            <?php
                            if (count($users) > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sr = 1;
                                    foreach ($users as $user) { ?>
                                        <tr>
                                            <td><?php echo $sr++; ?></td>
                                            <td><?php echo $user['name'] ?></td>
                                            <td><?php echo $user['email'] ?></td>
                                            <td>
                                                <a href="./edit-user.php?id=<?php echo $user['id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="./delete-user.php?id=<?php echo $user['id'] ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            <?php
                            } else { ?>
                                <div class="alert alert-danger m-0">No record found!</div>
                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>