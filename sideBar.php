<?php
session_start();
@include "config.php";

if (!isset($_SESSION["admin"])) {
    header("location:login.php");
    exit;
}


$admin = $_SESSION["admin"];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && !(isset($_POST['recordId']))) {
    $updatedName = $_POST['name'];
    $idToUpdate = $_GET['id']; // Use the admin's ID from the session

    // Update the session name only if the current admin's name is being modified
    if ($idToUpdate === $admin['id']) {
        $_SESSION['admin']['name'] = $updatedName;
    }

    $updateQuery = "UPDATE member SET name='$updatedName' WHERE role='Admin' AND id='$idToUpdate'";
    $execQuery = mysqli_query($conn, $updateQuery);
    if (!$execQuery) {
        $error = "Error updating admin data in the database: " . mysqli_error($conn);
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
    <div class="sidebar">

        <div class="sidebar-header">
            <div class="profile-icon">
                <?php if (!empty($admin['image'])): ?>
                    <img src="<?php echo $admin['image']; ?>" alt="Profile Picture" class="profile-image" height="100%"
                        width="100%" style="border-radius:50%;object-fit:cover">
                <?php else: ?>
                    <i class="fas fa-user"></i>
                <?php endif; ?>
            </div>
            <a href="profileAdmin.php" class="sidebar-name">
                <?php echo $admin['name']; ?>
            </a>
            <p style="color:white;font-size:12px;">
                <?php echo $admin['role']; ?>
            </p>
        </div>
        <hr>


        <a href="admin.php" class="sidebar-link"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="manageAdmin.php" class="sidebar-link"><i class="fa-solid fa-bars-progress"></i> Manage Admin</a>
        <a href="manageEmp.php" class="sidebar-link"><i class="fa-solid fa-bars-progress"></i> Manage Employee</a>
        <a href="manageLeave.php" class="sidebar-link"><i class="fa-solid fa-bars-progress"></i> Manage Leaves</a>

        <button type="submit" class="btn sidebar-logout" onclick="logout()"><i
                class="fa-solid fa-right-from-bracket"></i> Log Out</button>

        <script>
            function logout() {

                window.location.href = "logOut.php";
            }
        </script>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>