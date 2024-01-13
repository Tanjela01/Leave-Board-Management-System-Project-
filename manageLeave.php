<?php
@include "config.php";

if (isset($_POST['approve'])) {
    $stat = "Approved";
    $id = $_POST['leave_id'];

    $updateQuery = "UPDATE leaves SET status = '$stat' WHERE leaveID = '$id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {

    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

if (isset($_POST['decline'])) {
    $stat = "Declined";
    $id = $_POST['leave_id'];

    $updateQuery = "UPDATE leaves SET status = '$stat' WHERE leaveID = '$id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("location: manageLeave.php");
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($conn);
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

    <div class="content" style="height:82.7vh;width:1720px;border:5px solid white;margin-left:200px;">
        <div class="history"
            style="margin-top:0px;border:5px solid gray;border-radius:5px;background-color:gray;position: relative;">
            <h3 style="color:white;"><i class="fa-solid fa-envelope-open-text" style="color:white;"></i>
                Leave Requests </h3>
            <input type="text" id="searchInput" placeholder="Search" style="position: absolute; top: 0px; right: 0;">
            <div class="scrollable-table" style="height:680px;overflow:auto;">
                <table id="dtDynamicVerticalScrollExample" class="table table-striped table-bordered table-sm"
                    cellspacing="0" width="100%" style="height:680px;">
                    <thead class="sticky-header" style="position:sticky;top:0;">
                        <tr>
                            <th class="th-sm">Leave ID</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Position</th>
                            <th class="th-sm">Leave Type</th>
                            <th class="th-sm">From</th>
                            <th class="th-sm">Till</th>
                            <th class="th-sm">Reason</th>
                            <th class="th-sm">Status</th>
                            <th class="th-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT leaves.leaveID, member.name, member.position, leaves.leaveType, leaves.from, leaves.till, leaves.reason, leaves.status FROM leaves INNER JOIN member ON member.id = leaves.mID WHERE leaves.status = 'Pending' ORDER BY leaves.leaveID DESC";

                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['leaveID']; ?>
                                </td>
                                <td>
                                    <?php echo $row['name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['position']; ?>
                                </td>
                                <td>
                                    <?php echo $row['leaveType']; ?>
                                </td>
                                <td>
                                    <?php echo $row['from']; ?>
                                </td>
                                <td>
                                    <?php echo $row['till']; ?>
                                </td>
                                <td>
                                    <?php echo $row['reason']; ?>
                                </td>
                                <td>
                                    <?php echo $row['status']; ?>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="leave_id" value="<?php echo $row['leaveID']; ?>">
                                        <button type="submit" name="approve" value="<?php echo $row['leaveID']; ?>"
                                            class="btn btn-success btn-sm">Approve</button>
                                        <button type="submit" name="decline" value="<?php echo $row['leaveID']; ?>"
                                            class="btn btn-danger btn-sm">Decline</button>
                                    </form>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Tskq/8g3bWbe2siIBtnd9sfawxLLosuH82//vBR2Qly4ms4e8DbvmykkG5m5FdwS"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#dtDynamicVerticalScrollExample tbody tr');

            searchInput.addEventListener('input', function () {
                const searchText = searchInput.value.trim().toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    if (rowText.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>