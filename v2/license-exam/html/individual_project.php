<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Project</title>
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
            <div class="section py-0">
                <div class="button" id="createTask">
                    Create task
                </div>
                <div class="button ml-6" id="manageProjectUsers">
                    Manage project users
                </div>


            </div>
            <div class="section ">
                <table class="table is-fullwidth  is-hoverable" id="tasks-table">
                    <thead>
                        <tr>
                            <th>Task title</th>
                            <th>Description</th>
                            <th>Time spent</th>
                            <th>Start</th>
                            <th>Finish </th>

                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>



                        </tr>

                    </tbody>
                    <tfoot>


                    </tfoot>


                </table>


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
            const project_id = urlParams.get('project_id');

            $.ajax({
                "method": "POST",
                "url": "/license-exam-backend/api/v1/individual_project",
                "data": {
                    'project_id': project_id

                }

            }).done(function (data) {
                if (data == "") {
                    alert("No tasks");
                }

                data = JSON.parse(data);

                console.log(data);

                var tasksTable = $('#tasks-table');

                $.each(data.tasks, function (key, value) {

                    var task_hours = 0;

                    $.ajax({
                        "method": "POST",
                        "url": "/license-exam-backend/api/v1/calculate_task_hours",
                        "data": {
                            'task_id': value.id
                        }
                    }).done(function (data) {

                        data = JSON.parse(data);
                        //console.log(data);
                        task_hours = data.hours;
                        var row = $('<tr>');

                        console.log(value);

                        row.append($('<td>').append('<a href="individual_task.php?task_id=' + value.id + '">'
                            + value.title + '</a>'));
                        row.append($('<td>').text(value.description));


                        row.append($('<td>').text(task_hours));


                        row.append($('<td>').text(value.start));
                        row.append($('<td>').text(value.finish));

                        if (value.status == 0) {
                            row.append($('<td>').text('Finished'));
                        } else {
                            row.append($('<td>').text('In progress'));
                        }

                        tasksTable.append(row);

                    })



                });
            })

            $('#createTask').click(function () {
                window.location.href = "create_task.php?project_id=" + project_id;
            })

            $('#manageProjectUsers').click(function () {
                window.location.href = "manage_project_users.php?project_id=" + project_id;
            })

        })

    </script>



</body>

</html>