<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Reports</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6">
            <input type="button" class="button" id="backToTask" value="Back to task">

            <div class="section ">
                <form method="post">
                    <div class="container pb-6">
                        <input type="button" class="button" id="createReport" value="Create Report">
                    </div>

                    <table class="table is-fullwidth is-hoverable is-bordered is-narrow" id="reportsTable">

                        <th>Worker name</th>
                        <th>Date</th>
                        <th>Summary</th>
                        <th>Comments</th>
                        <th>Hours</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </table>
                </form>
            </div>
        </div>
    </main>


    <!-- FOOTER START ------------------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'footer.html';
    ?>

    <!-- FOOTER END------------------------------------------------------------------------------------------------------------------------------>


    <script>
        const urlParams = new URLSearchParams(window.location.search);
        // these comes from individual task
        const task_id = urlParams.get('task_id');
        const projects_id = urlParams.get('projects_id');

        $.ajax({
            method: "POST",
            url: apiLink + "show_reports",
            data: {
                'task_id': task_id,
                'projects_id': projects_id

            }
        }).done(function (data) {
            data = JSON.parse(data);

            console.log(data);

            var reportsTable = $('#reportsTable');

            console.log(data.reports)

            $.each(data.reports, function (key, value) {
                var row = $('<tr>');
                console.log(value);

                row.append($('<td>').text(value.worker_name));
                row.append($('<td>').text(value.start));
                row.append($('<td>').text(value.summary));
                row.append($('<td>').text(value.comments));
                row.append($('<td>').text(value.hours));

                row.append($('<td>').html('<a href="edit_report.php?reports_id='
                    + value.id +
                    '&summary=' + value.summary +
                    '&comments=' + value.comments +
                    '&hours=' + value.hours +
                    '&task_id=' + task_id +
                    '&projects_id=' + projects_id +
                    '">Edit</a>'));

                row.append($('<td>').html('<a href="delete_report.php?reports_id='
                    + value.id +
                    '&projects_id=' + projects_id +
                    '&task_id=' + task_id +
                    '">Delete</a>'));

                reportsTable.append(row);

            })

        })

        $('#createReport').click(function () {
            window.location.href = "create_report.php?task_id=" + task_id + "&projects_id=" + projects_id;
        })

        $('#backToTask').click(function () {
            window.location.href = "individual_task.php?task_id=" + task_id;
        })





    </script>

</body>

</html>