<?php
@include "config.php";


if (isset($_POST['delete'])) {
    $id = $_POST['delete'];


    $deleteQuery = "DELETE FROM member WHERE id = '$id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {


    } else {

        echo "Error deleting record: " . mysqli_error($conn);
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
        <div class="history"
            style="margin-top: 0px; border: 5px solid gray; border-radius: 5px; background-color: gray; position: relative;">
            <h3 style="color: white;"><i class="fa-solid fa-user-gear" style="color: white"></i> Admin List</h3>
            <input type="text" id="searchInput" placeholder="Search" style="position: absolute; top: 0px; right: 50%;">
            <a href="addAdmin.php">
                <button type="button" class="btn btn-primary"
                    style="position: absolute; top: 0px; right: 0px; background-color: lightslategray; border: none;"
                    onmouseover="this.style.backgroundColor='lightgray';"
                    onmouseout="this.style.backgroundColor='lightslategray';">
                    Add Admin
                </button>
            </a>

            <div class="scrollable-table" style="height: 680px; overflow: auto;">
                <table id="dtDynamicVerticalScrollExample" class="table table-striped table-bordered table-sm"
                    cellspacing="0" width="100%" style="height: 680px;">
                    <thead class="sticky-header" style="position: sticky; top: 0;">
                        <tr>
                            <th class="th-sm">ID</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Gender</th>
                            <th class="th-sm">Age</th>
                            <th class="th-sm">Contact</th>
                            <th class="th-sm">Role</th>
                            <th class="th-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT id,name,gender,age,contact,role FROM member where role='Admin'";
                        $result = mysqli_query($conn, $query);


                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>" . $row['age'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>
                            <a href='modAdmin.php?id=" . $row['id'] . "'><button type='button' class='btn btn-primary btn-sm'>Modify</button></a>
                            <form method='POST' action='{$_SERVER['PHP_SELF']}' style='display:inline' >
                                <input type='hidden' name='delete' value='{$row['id']}'>
                                <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</button>
                            </form>
                        </td>";
                            echo "</tr>";
                        }


                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchInput').on('keyup', function () {
                var searchText = $(this).val().toLowerCase();
                $('#dtDynamicVerticalScrollExample tbody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>