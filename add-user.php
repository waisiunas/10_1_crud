<?php require_once('./database/connection.php'); ?>

<?php
$name = $father_name = $email = $error = $success = '';

if (isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $father_name = htmlspecialchars($_POST['father_name']);

    if (empty($name)) {
        $error = 'Please provide your name!';
    } elseif (empty($father_name)) {
        $error = 'Please provide your father name!';
    } elseif (empty($email)) {
        $error = 'Please provide your email!';
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows === 0) {
            $sql = "INSERT INTO `users`(`name`, `father_name`, `email`) VALUES ('$name', '$father_name', '$email')";
            if($conn->query($sql)) {
                $success = 'Magic has been spelled!';
            } else {
                $error = 'Magic has failed to spell!';
            }
        } else {
            $error = 'Email alreadt exists!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Add User</h5>
                            </div>
                            <div class="col text-end">
                                <a href="./index.php" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                            <div class="mb-3">

                                <?php
                                if (!empty($error)) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $error; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                }

                                if (!empty($success)) { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $success; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Enter your Name!">
                            </div>

                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father Name</label>
                                <input type="text" class="form-control" name="father_name" id="father_name" value="<?php echo $father_name; ?>" placeholder="Enter your Father Name!">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter your Email!">
                            </div>

                            <div>
                                <input type="submit" value="Submit" name="submit" class="btn btn-primary">

                                <input type="reset" value="Reset" class="btn btn-dark">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>