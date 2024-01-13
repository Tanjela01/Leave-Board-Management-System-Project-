<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

@include "config.php";

$admin = $_SESSION["admin"];


$id = $admin["id"];
$name = $admin['name'];
$gender = $admin['gender'];
$age = $admin['age'];
$email = $admin['email'];
$password = $admin['password'];

$profilePicture = $admin['profile_picture'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $updatedName = $_POST['name'];
    $updatedGender = $_POST['gender'];
    $updatedAge = $_POST['age'];
    $updatedEmail = $_POST['contact'];
    $updatedPassword = $_POST['password'];
    $updatedImage = $_POST['profile_picture'];


    $_SESSION['admin']['name'] = $updatedName;
    $_SESSION['admin']['gender'] = $updatedGender;
    $_SESSION['admin']['age'] = $updatedAge;
    $_SESSION['admin']['email'] = $updatedEmail;
    $_SESSION['admin']['image'] = $updatedImage;



    if ($_FILES['profile_picture']['name']) {
        $targetDirectory = "img/";
        $targetFile = $targetDirectory . basename($_FILES['profile_picture']['name']);


        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {

            $_SESSION['admin']['image'] = $targetFile;
        } else {

            $error = "Error uploading profile picture.";
        }
    }


    $updateQuery = "UPDATE member SET name='$updatedName', gender='$updatedGender', age='$updatedAge', contact='$updatedEmail', password='$updatedPassword', image='$targetFile' WHERE role='Admin' AND id='$id'";

    $execQuery = mysqli_query($conn, $updateQuery);

    if ($execQuery) {
        $message = "Profile updated successfully.";
    } else {
        $message = "Error updating profile: " . mysqli_error($conn);
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
                <h5 class="card-title">User Profile</h5>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            value="<?php echo $name; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="Male" <?php if ($gender === 'Male')
                                echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($gender === 'Female')
                                echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" required
                            value="<?php echo $age; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="contact" name="contact" required
                            value="<?php echo $email; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required
                            value="<?php echo $password; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture:</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                            accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <hr>
                </form>
                <p style="color: green;">
                    <?php echo $message; ?>
                </p>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

</body>

</html>