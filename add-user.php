<?php require_once('./core/database.php') ?>

<?php
$error = $name = $email = "";

if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name)) {
        $error = "Enter the name!";
    } elseif (empty($email)) {
        $error = "Enter the email!";
    } else {
        $result = $database->email_validation('users', $email);

        if ($result) {
            $data = [
                'name' => $name,
                'email' => $email,
            ];

            $is_created = $database->create('users', $data);

            $is_created ? $success = SUCCESS : $error = FAILURE;
        } else {
            $error = 'Email already exists!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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
                                <h3 class="m-0">Add User</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php require_once('./partials/alerts.php'); ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name!" value="<?php echo $name ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email!" value="<?php echo $email ?>">
                            </div>

                            <div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                <input type="reset" value="Reset" class="btn btn-dark">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>