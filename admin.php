<?php

@include "config.php";
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
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header" style="background-color:gray;">
                        <div class="row">
                            <div class="col">
                                <i class="fa-solid fa-user-gear fa-2x" style="margin-right:250px;color:white"></i>
                            </div>
                            <div class="col">
                                <h3 class="display-3" style="color:white;">
                                    <?php
                                    $memberQuery = "SELECT * FROM member WHERE role='Admin'";
                                    $execmemberQuery = mysqli_query($conn, $memberQuery);
                                    if ($totalMembers = mysqli_num_rows($execmemberQuery)) {
                                        echo $totalMembers;
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </h3>
                                <h6 style="color:white;">Admin</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color:lightslategray;">
                        <h5><a href="manageAdmin.php" style="text-decoration:none;color:white;">View More </a><i
                                class="fa fa-arrow-alt-circle-right" style="color:white;"></i></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header" style="background-color:gray;">
                        <div class="row">
                            <div class="col">
                                <i class="fa-solid fa-users fa-2x" style="margin-right:250px;color:white"></i>
                            </div>
                            <div class="col">
                                <h3 class="display-3" style="color:white;">
                                    <?php
                                    $memberQuery = "SELECT * FROM member WHERE role='Employee'";
                                    $execmemberQuery = mysqli_query($conn, $memberQuery);
                                    if ($totalMembers = mysqli_num_rows($execmemberQuery)) {
                                        echo $totalMembers;
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </h3>
                                <h6 style="color:white;">Employee</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color:lightslategray;">
                        <h5><a href="manageEmp.php" style="text-decoration:none;color:white;">View More</a><i
                                class="fa fa-arrow-alt-circle-right" style="color:white;"></i></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header" style="background-color:gray;">
                        <div class="row">
                            <div class="col">
                                <i class="fa-solid fa-envelope fa-2x" style="margin-right:250px;color:white"></i>
                            </div>
                            <div class="col">
                                <h3 class="display-3" style="color:white;">
                                    <?php
                                    $leavesQuery = "SELECT * FROM leaves WHERE status='Pending'";
                                    $execQuery = mysqli_query($conn, $leavesQuery);
                                    if ($leaveReq = mysqli_num_rows($execQuery)) {
                                        echo $leaveReq;
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </h3>
                                <h6 style="color:white;">Leave Request</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color:lightslategray;">
                        <h5><a href="manageLeave.php" style="text-decoration:none;color:white;">View More</a><i
                                class="fa fa-arrow-alt-circle-right" style="color:white;"></i></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="history"
            style="margin-top:75px;border:5px solid gray;border-radius:5px;background-color:gray;position: relative;">
            <h3 style="color:white;"><i class="fa-solid fa-clock-rotate-left"></i> Leave History </h3>
            <input type="text" id="searchInput" placeholder="Search" style="position: absolute; top: 0px; right: 50%;">
            <div class="scrollable-table" style="height:425px;overflow:auto;">
                <div style="position: absolute; top:0px;right:0px;color:white;">
                    Filter by Status:
                    <select id="statusFilter">
                        <option value="all">All</option>
                        <option value="Approved">Approved</option>
                        <option value="Declined">Declined</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
                <table id="dtDynamicVerticalScrollExample" class="table table-striped table-bordered table-sm"
                    cellspacing="0" width="100%" style="height:500px;">
                    <thead class="sticky-header" style="position:sticky;top:0;">
                        <tr>
                            <th class="th-sm">leave ID</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Position</th>
                            <th class="th-sm">Leave Type</th>
                            <th class="th-sm">From</th>
                            <th class="th-sm">Till</th>
                            <th class="th-sm">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $leaveHistoryQuery = "SELECT leaves.leaveID, member.name, member.position, leaves.leaveType, leaves.`from`, leaves.`till`, leaves.status 
                        FROM leaves
                        INNER JOIN member ON leaves.mID = member.id 
                        ORDER BY leaves.leaveID desc";
                        $execLeaveHistoryQuery = mysqli_query($conn, $leaveHistoryQuery);
                        while ($row = mysqli_fetch_assoc($execLeaveHistoryQuery)) {
                            echo "<tr>";
                            echo "<td>" . $row['leaveID'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['position'] . "</td>";
                            echo "<td>" . $row['leaveType'] . "</td>";
                            echo "<td>" . $row['from'] . "</td>";
                            echo "<td>" . $row['till'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }
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
    <script>

        var statusFilter = document.getElementById("statusFilter");
        var tableRows = document.querySelectorAll("#dtDynamicVerticalScrollExample tbody tr");


        statusFilter.addEventListener("change", function () {
            var selectedStatus = statusFilter.value.toLowerCase();


            for (var i = 0; i < tableRows.length; i++) {
                var statusCell = tableRows[i].querySelector("td:nth-child(7)");

                if (selectedStatus === "all" || statusCell.textContent.toLowerCase() === selectedStatus) {
                    tableRows[i].style.display = "";
                } else {
                    tableRows[i].style.display = "none";
                }
            }
        });
    </script>
</body>

</html>