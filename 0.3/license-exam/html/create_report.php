<?php
session_start();
?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Create report</title>
    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-3 ">
            <div class="section ">
                <form method="post">

                    <form>
                        <div class="columns is-centered">
                            <div class="column is-6">
                                <input class="input mb-2" type="text" placeholder="Summary" id="summary">
                                <input class="input mb-2" type="text" placeholder="Comments" id="comments">
                                <div class="columns">
                                    <div class="column">
                                        <input class="input mb-2" type="datetime-local" placeholder="Datetime"
                                            id="startDateTime">
                                    </div>
                                    <div class="column">
                                        <input class="input mb-2" type="text" placeholder="Hours" id="hours">
                                    </div>
                                </div>
                                <input class="button" type="button" value="Create new report" id="createReport"
                                    step="0.1">
                            </div>

                        </div>

                    </form>
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

        var reportsTable = $('#reportsTable');


        $('#createReport').on('click', function () {
            var summary = $('#summary').val();
            var comments = $('#comments').val();
            var hours = $('#hours').val();
            var date_time_start = $('#startDateTime').val();

            if ($('#summary').val() == "") {
                alert("Please enter summary");
            } else if ($('#comments').val() == "") {
                alert("Please enter comments");
            } else if ($('#Hours').val() == "") {
                alert("Hours cannot be empty");
            } else if ($('#startDateTime').val() == "") {
                alert("Datetime cannot be empty");
            } else {

                $.ajax({
                    method: "POST",
                    url: apiLink + "create_report",
                    data: {
                        "task_id": task_id,
                        "summary": summary,
                        "comments": comments,
                        "hours": hours,
                        "date_time_start": date_time_start,
                        "projects_id": projects_id

                    }

                }).done(function (data) {
                    console.log(data);

                    data = JSON.parse(data);
                    if (data["success"] == true) {
                        window.location.href = "/license-exam/html/show_reports.php?task_id=" + task_id + "&projects_id=" + projects_id;

                    }

                })

            }
        })



    </script>

</body>

</html>