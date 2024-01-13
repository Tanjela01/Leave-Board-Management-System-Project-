<?php

@include "config.php";

?>
<?php

@include "config.php";
session_start();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $select = "SELECT * FROM member WHERE contact = '$email' AND password = '$password' AND role = '$role'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) == 1 && $role == "Admin") {
        $fetch = mysqli_fetch_assoc($result);
        $_SESSION["logged_in"] = true;
        $_SESSION['role'] = $fetch["role"];
        $adminData = [
            'id' => $fetch["id"],
            'name' => $fetch["name"],
            'gender' => $fetch["gender"],
            'age' => $fetch["age"],
            'email' => $fetch["contact"],
            'password' => $fetch["password"],
            'image' => $fetch["image"],
            'role' => $fetch["role"]
        ];
        $_SESSION["admin"] = $adminData;
        header("location: admin.php");
        exit();
    } elseif (mysqli_num_rows($result) == 1 && $role == "Employee") {
        $fetch = mysqli_fetch_assoc($result);
        $_SESSION["logged_in"] = true;
        $_SESSION['role'] = $fetch["role"];
        $employeeData = [
            'id' => $fetch["id"],
            'name' => $fetch["name"],
            'gender' => $fetch["gender"],
            'age' => $fetch["age"],
            'position' => $fetch["position"],
            'salary' => $fetch["salary"],
            'joinDate' => $fetch["joinDate"],
            'email' => $fetch["contact"],
            'password' => $fetch["password"],
            'image' => $fetch["image"],
            'role' => $fetch["role"]
        ];
        $_SESSION["employee"] = $employeeData;
        header("location: employee.php");
        exit();
    } else {
        $message = 'Invalid Credentials';

    }
}

mysqli_close($conn);
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3a00940754.js" crossorigin="anonymous"></script>
</head>

<body>
    <section style="background-color:lightgray;height:100vh;display:flex;justify-content:center;align-items:center;">

        <div class="loginbox"
            style="height:500px;width:500px;background-color:white;border-radius:5%;display:flex;justify-content:center;align-items:center;">

            <form method="POST" action="login.php">
                <h1 style="color:#4267B3">LMS PORTAL</h1>
                <div class=>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class=>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div style="margin-top:5%;">
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <option value="Admin">Admin</option>
                        <option value="Employee">Employee</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="login" value="login"
                    style="display:block;width:100%;margin-top:5%;">Login</button>
                <?php if (isset($message)) { ?>
                    <p class="message" style="color:red;margin-top:5px;">
                        <?php echo $message; ?>
                    </p>
                <?php } ?>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>