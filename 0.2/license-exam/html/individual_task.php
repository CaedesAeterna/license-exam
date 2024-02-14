<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Task</title>
    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">

            <input type="button" class="button mx-3" id="backToProject" value="Back to project">
            <input type="button" class="button mx-3" id=>
            <div class="columns  is-centered">
                <div class="column">
                    <div class="section">

                        <p class="subtitle">Title: <span id="nameSpan"> title title</span> </p>
                        <p class="subtitle">Description: <span id="descSpan">desc desc</span> </p>
                        <p class="subtitle">Time spent: <span id="timeSpan">time time</span> </p>
                        <p class="subtitle">Start: <span id="startSpan">start start</span> </p>

                    </div>
                </div>
            </div>

            <div class="columns is-centered">

                <div class="column">

                    <div class="section">
                        <input type="button" class="button mr-3" id="editTask" value="Edit">
                        <input type="button" class="button mx-3" id="deleteTask" value="Delete">
                        <input type="button" class="button mx-3" id="showReports" value="Reports">
                        <input type="hidden" name="project_id" id="projects_id">
                    </div>

                </div>

            </div>

        </div>

    </main>



    <!-- FOOTER START ------------------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'footer.html';
    ?>

    <!-- FOOTER END------------------------------------------------------------------------------------------------------------------------------>


    <script>
        $(document).ready(function () {

            const urlParams = new URLSearchParams(window.location.search);
            // these comes from dashboard
            const task_id = urlParams.get('task_id');
            const task_title = urlParams.get('task_title');
            const task_description = urlParams.get('task_description');


            $.ajax({
                "method": "POST",
                "url": "/license-exam-backend/api/v1/individual_task",
                "cache": false,
                "data": {
                    'task_id': task_id,
                    'task_title': task_title,
                    'task_description': task_description,
                }
            }).done(function (data) {
                console.log(data);

                var data = JSON.parse(data);

                console.log(data);

                var title = $('#nameSpan');
                var desc = $('#descSpan');
                var start = $('#startSpan');

                title.text(data.title);
                desc.text(data.description);
                start.text(data.start);
                //start.append(data.start);

                var project_id_span = $('#projects_id');
                projects_id = data.projects_id;
                project_id_span.text(projects_id);


                var timeSpan = $('#timeSpan');

                $.ajax({
                    "method": "POST",
                    "url": "/license-exam-backend/api/v1/calculate_task_hours",
                    "data": {
                        'task_id': task_id
                    }
                }).done(function (data) {
                    var data = JSON.parse(data);

                    timeSpan.text(data.hours);
                })


            })

            $('#editTask').click(function () {

                var title = $('#nameSpan');
                var desc = $('#descSpan');

                window.location.href = "edit_task.php?task_id=" + task_id +
                    "&task_title=" + title.text() +
                    "&task_description=" + desc.text();
            })

            $('#deleteTask').click(function () {

                window.location.href = "delete_task.php?task_id=" + task_id + "&projects_id=" + projects_id;



            })
            $('#showReports').click(function () {

                var title = $('#nameSpan');
                var desc = $('#descSpan');

                var project_id = $('#project_id').text();

                window.location.href = "show_reports.php?task_id=" + task_id + "&projects_id=" + projects_id;

            })

            $('#backToProject').click(function () {

                var project_id = $('#project_id').text();


                window.location.href = "individual_project.php?project_id=" + projects_id;
            })

        })
    </script>

</body>

</html>