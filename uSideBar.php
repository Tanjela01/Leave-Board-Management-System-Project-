<?php
session_start();
@include "config.php";

if (!isset($_SESSION["employee"])) {
    header("location:login.php");
}

$employee = $_SESSION["employee"];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $updatedName = $_POST['name'];
    $employee['name'] = $updatedName;
    $_SESSION['employee']['name'] = $updatedName;

    $updateQuery = "UPDATE member SET name='$updatedName' WHERE role='Employee' AND id='{$employee['id']}'";
    $execQuery = mysqli_query($conn, $updateQuery);
    if (!$execQuery) {
        $error = "Error updating employee data in the database.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3a00940754.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="profile-icon">
                <?php if (!empty($employee['image'])): ?>
                    <img src="<?php echo $employee['image']; ?>" alt="Profile Picture" class="profile-image" height="100%"
                        width="100%" style="border-radius:50%;object-fit:cover">
                <?php else: ?>
                    <i class="fas fa-user"></i>
                <?php endif; ?>
            </div>
            <a href="profileEmployee.php" class="sidebar-name">
                <?php echo $employee['name']; ?>
            </a>
            <p style="color:white;font-size:12px;">
                <?php echo $employee['position']; ?>
            </p>
        </div>
        <hr>
        <a href="employee.php" class="sidebar-link"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="applyLeave.php" class="sidebar-link"><i class="fa-solid fa-bars-progress"></i> Apply for a Leave</a>
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