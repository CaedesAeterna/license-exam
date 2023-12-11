<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" />

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'header.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-3 ">
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
            url: "/license-exam-backend/api/v1/show_reports",
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

                row.append($('<td>').html('<a href="/license-exam/html/edit_report.php?reports_id='
                    + value.id +
                    '&summary=' + value.summary +
                    '&comments=' + value.comments +
                    '&hours=' + value.hours +
                    '&task_id=' + task_id +
                    '&projects_id=' + projects_id +
                    '">Edit</a>'));

                row.append($('<td>').html('<a href="/license-exam/html/delete_report.php?reports_id='
                    + value.id +
                    '&projects_id=' + projects_id +
                    '&task_id=' + task_id +
                    '">Delete</a>'));


                reportsTable.append(row);

            })


        })

        $('#createReport').click(function () {

            window.location.href = "/license-exam/html/create_report.php?task_id=" + task_id + "&projects_id=" + projects_id;

        })





    </script>

</body>

</html>