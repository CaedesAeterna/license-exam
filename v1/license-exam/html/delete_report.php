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
        <div class="container py-6">
            <div class="section ">
                <form>
                    <div class="columns is-centered">
                        <div class="column is-4">
                            <label class="label mb-5"> Are you sure you wanna delete this report?</label>

                            <input type="button" class="button mr-6 my-2" id="deleteReport" value="Delete Report">
                            <input type="button" class="button ml-6 my-2" id="cancel" value="Cancel">
                        </div>

                    </div>

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
        const reports_id = urlParams.get('reports_id');
        const task_id = urlParams.get('task_id');
        const projects_id = urlParams.get('projects_id');


        $('#deleteReport').on('click', function () {

            $.ajax({
                method: "POST",
                url: "/license-exam-backend/api/v1/delete_report",
                data: {
                    'reports_id': reports_id,
                    'task_id': task_id,
                    'projects_id': projects_id

                }
            }).done(function (data) {
                data = JSON.parse(data);
                console.log(data);

                window.location.href = "/license-exam/html/show_reports.php?task_id=" + task_id
                    + "&projects_id=" + projects_id;
            })

        });

        $('#cancel').on('click', function () {

            window.location.href = "/license-exam/html/show_reports.php?task_id=" + task_id
                + "&projects_id=" + projects_id;

        });

    </script>

</body>

</html>