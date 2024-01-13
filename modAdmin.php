<?php
@include "config.php";

$message = "";

if (isset($_GET['id'])) {
    $adminId = $_GET['id'];


    $query = "SELECT * FROM member WHERE role = 'Admin' AND id = '$adminId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        $name = $admin['name'];
        $gender = $admin['gender'];
        $age = $admin['age'];
        $contact = $admin['contact'];
        $password = $admin['password'];
    } else {
        $error = "Admin not found.";
    }
} else {
    $error = "Admin ID not provided.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];


    $updateQuery = "UPDATE member SET name='$name', gender='$gender', age='$age', contact='$contact', password='$password' WHERE role='Admin' AND id = '$adminId'";

    $execQuery = mysqli_query($conn, $updateQuery);

    if ($execQuery) {
        $message = "Profile modified successfully.";
    } else {
        $message = "Error modifying profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3a00940754.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "header.php" ?>
    <?php include "sideBar.php" ?>

    <div class="content" style="height: 82.7vh; width: 1720px; border: 5px solid white; margin-left: 200px;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Modify Admin</h5>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" <?php if ($gender === 'Male')
                                echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($gender === 'Female')
                                echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Contact (Email)</label>
                        <input type="email" class="form-control" id="email" name="contact"
                            value="<?php echo $contact; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            value="<?php echo $password; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Modify</button>
                    <hr>
                </form>
                <p style="color: green;">
                    <?php echo $message; ?>
                </p>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Tskq/8g3bWbe2siIBtnd9sfawxLLosuH82//vBR2Qly4ms4e8DbvmykkG5m5FdwS"
        crossorigin="anonymous"></script>

</body>

</html>