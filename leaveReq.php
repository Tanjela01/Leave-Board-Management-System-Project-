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

        <div class="history"
            style="margin-top:0px;border:5px solid gray;border-radius:5px;background-color:gray;position: relative;">
            <h3 style="color:white;"><i class="fa-solid fa-envelope-open-text" style="color:white;"></i>
                Leave List </h3>
            <input type="text" id="searchInput" placeholder="Search" style="position: absolute; top: 0px; right: 50%;">
            <div class="scrollable-table" style="height:680px;overflow:auto;">
                <div style="position: absolute; top:0px;right:0px;color:white;">
                    Filter by Status:
                    <select id="statusFilter">
                        <option value="all">All</option>
                        <option value="approved">Approved</option>
                        <option value="declined">Declined</option>
                        <option value="declined">Pending</option>
                    </select>
                </div>
                <table id="dtDynamicVerticalScrollExample" class="table table-striped table-bordered table-sm"
                    cellspacing="0" width="100%" style="height:680px;">
                    <thead class="sticky-header" style="position:sticky;top:0;">
                        <tr>
                            <th class="th-sm">ID
                            </th>
                            <th class="th-sm">Name
                            </th>
                            <th class="th-sm">Position
                            </th>
                            <th class="th-sm">Leave Type
                            </th>
                            <th class="th-sm">Start Date
                            </th>
                            <th class="th-sm">End Date
                            </th>
                            <th class="th-sm">Leave Duration
                            </th>
                            <th class="th-sm">Status
                            </th>
                            <th class="th-sm">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                            <td>$170,750</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                            <td>$86,000</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                            <td>$433,060</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                            <td>$162,700</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                            <td>$372,000</td>
                            <td>$372,000</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012/08/06</td>
                            <td>$137,500</td>
                            <td>$137,500</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2010/10/14</td>
                            <td>$327,900</td>
                            <td>$327,900</td>
                            <td>$320,800</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm">Decline</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <script>

                    var statusFilter = document.getElementById('statusFilter');


                    var tableRows = document.querySelectorAll('#dtDynamicVerticalScrollExample tbody tr');


                    statusFilter.addEventListener('change', function () {
                        var selectedStatus = this.value;


                        tableRows.forEach(function (row) {
                            var statusCell = row.querySelector('td:nth-child(8)');


                            if (selectedStatus === 'all' || statusCell.textContent.toLowerCase() === selectedStatus) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });
                </script>


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