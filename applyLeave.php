<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
@include "config.php";

$employee = $_SESSION['employee'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leaveType = $_POST["leaveType"];
    $fromDate = $_POST["fromDate"];
    $toDate = $_POST["toDate"];
    $reason = $_POST["reason"];

    $fromTimestamp = strtotime($fromDate);
    $toTimestamp = strtotime($toDate);

    $currentTimestamp = time();

    if ($toTimestamp >= $fromTimestamp && $fromTimestamp >= $currentTimestamp) {
        $sql = "INSERT INTO leaves (leaveType, `from`, `till`, reason, mID) VALUES ('$leaveType', '$fromDate', '$toDate', '$reason', '{$employee['id']}')";

        if (mysqli_query($conn, $sql)) {
            $message = "Leave application recorded successfully.";
        } else {
            $message = "Error inserting leave record: " . mysqli_error($conn);
        }
    } else if ($fromTimestamp < $currentTimestamp) {
        $message = "Error: The 'From' date cannot be less or equal to the current date.";
    } else {
        $message = "Error: The 'To' date must be greater than the 'From' date.";
    }
}
?>

<script>
    document.getElementById("leaveForm").addEventListener("submit", function (event) {
        

< !DOCTYPE html >
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
    <?php include "uSideBar.php" ?>

    <div class="content" style="height: 82.7vh; width: 1720px; border: 5px solid white; margin-left: 200px;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Apply for a leave</h5>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="leaveType" class="form-label">Leave Type:</label>
                        <select class="form-select" id="leaveType" name="leaveType" required>
                            <option value="" disabled selected>Select a Leave Type</option>
                            <option value="Casual leave">Casual leave</option>
                            <option value="Sick leave">Sick leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Annual leave">Annual leave</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fromDate" class="form-label">From:</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="toDate" class="form-label">To:</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason:</label>
                        <input type="text" class="form-control" id="reason" name="reason" required>
                    </div>


                    <button type="submit" class="btn btn-primary">Apply</button>
                    <hr>
                </form>

                <p
                    style="color: <?php echo ($message == 'Leave application recorded successfully.') ? 'green' : 'red'; ?>">
                    <?php echo $message; ?>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script>
                                    document.getElementById("leaveForm").addEventListener("submit", function (event) {
        var fromDate = document.getElementById("fromDate").value;
                                    var toDate = document.getElementById("toDate").value;
                                    var currentDate = new Date().toISOString().slice(0, 10);

                                    var fromTimestamp = Date.parse(fromDate);
                                    var toTimestamp = Date.parse(toDate);
                                    var currentTimestamp = Date.parse(currentDate);

                                    if (toTimestamp < fromTimestamp) {
                                        event.preventDefault();
        } else if (fromTimestamp < currentTimestamp) {
                                        event.preventDefault();
        }
    });
    </script>

</body>

</html>