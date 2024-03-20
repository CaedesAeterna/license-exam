<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Project</title>

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

                <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">

                    <div class="button is-success " id="createTask" style="display: none;">
                        Create task
                    </div>
                    <div class="button is-success" id="createTicket">
                        Create ticket
                    </div>

                    <div class="button" id="viewTickets">
                        View tickets
                    </div>

                    <div class="button" id="edit_project" style="display: none;">
                        Edit project
                    </div>

                    <div class="button is-link" id="manageProjectUsers" style="display: none;">
                        Manage project users
                    </div>

                    <div class="button" id="viewStatistics">
                        View Statistics
                    </div>

                </div>



            </div>
            <div class="section pb-2">

                <p class="mb-3"> You are viewing project: <span id="project_name"></span></p>
                <p class="mb-3"> You have the project due date: <span id="due_date"></span></p>
                <p class="mb-3"> You have remaining <span id="remaining_days"></span> days</p>
            </div>


            <div class="section pt-1" id="tasks">

                <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                    <div class="subtitle col_title row_title">Task title/description</div>
                    <div class="subtitle col_small row_title">Time spent</div>
                    <div class="subtitle col_small row_title">Start</div>
                    <div class="subtitle col_small row_title">Finish</div>
                    <div class="subtitle col_small row_title">Status</div>

                </div>

            </div>




        </div>
        </div>

        <div class="is-flex is-justify-content-flex-end mr-6">
            <div class="button mb-5 mr-4" id="archive_project" style="display: none;">
                Archive project
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
                url: apiLink + 'get_position',
                type: 'POST',

            }).done(function (data) {

                if (data == null) {
                    $('#createTask').remove();
                    $('#manageProjectUsers').remove();
                    return;
                }
                data = JSON.parse(data);
                //console.log(data);

                // 10-19 admin
                // 20-29 manager
                // 30-39 worker
                // 40-49 client

                if (data.position < 30) {
                    $('#createTask').show();
                    $('#manageProjectUsers').show();
                    $('#archive_project').show();
                    $('#edit_project').show();


                } else if (data.position >= 30 && data.position < 40) {

                    $('#manageProjectUsers').remove();
                    $('#archive_project').remove();
                    $('#edit_project').remove();

                    $.ajax({
                        "method": "POST",
                        "url": apiLink + "check_free_task",
                        data: {
                            project_id: project_id
                        }
                    }).done(function (data) {
                        data = JSON.parse(data);
                        //console.log(data);
                        if (data.success == true) {
                            if (data.free_task_creating == true) {
                                $('#createTask').show();
                            } else {
                                $('#createTask').remove();

                            }
                        }


                    })

                } else {
                    $('#createTask').remove();
                    $('#manageProjectUsers').remove();
                    $('#archive_project').remove();
                    $('#edit_project').remove();

                }
            });


            $.ajax({
                "method": "POST",
                "url": apiLink + "individual_project",
                "data": {
                    'project_id': project_id
                }

            }).done(function (data) {
                if (data == "") {
                    basicPopUp("No tasks");
                }

                if (data == 'no task found') {
                    basicPopUp("No tasks");
                }
                //console.log(data);

                data = JSON.parse(data);

                //console.log(data);

                $('#project_name').html(data.project_name);
                $('#due_date').html(data.due_date);

                let due_date = new Date(data.due_date);
                let today = new Date();


                let remaining_days = due_date - today;

                $('#remaining_days').html((Math.ceil(remaining_days / (1000 * 60 * 60 * 24))));

                var tasksTable = $('#tasks-table');
                var tasks_div = $('#tasks');

                $.each(data.tasks, function (key, value) {

                    var task_hours = 0;

                    $.ajax({
                        "method": "POST",
                        "url": apiLink + "calculate_task_hours",
                        "data": {
                            'task_id': value.id
                        }
                    }).done(function (data) {

                        data = JSON.parse(data);
                        //console.log(data);
                        task_hours = data.hours;

                        var row = $('<div class="is-flex is-justify-content-space-between is-flex-wrap-wrap mb-4">');

                        row.append($('<div class="col_title">').append('<a href="individual_task.php?task_id=' + value.id + '">' + value.title
                            + '</a>' + '<br>' + value.description));
                        row.append($('<div class="col_small ">').text(task_hours));
                        row.append($('<div class=" col_small ">').text(value.start));
                        row.append($('<div class=" col_small ">').text(value.finish));

                        if (value.status == 0) {
                            row.append($('<div class="col_small ">').text('Finished'));
                        } else {
                            row.append($('<div class="col_small ">').text('In progress'));
                        }

                        tasks_div.append(row);

                        /*
                        var row = $('<tr>');

                        //console.log(value);

                        row.append($('<td style="width: 40%">').append('<a href="individual_task.php?task_id=' + value.id + '">'
                            + value.title + '</a>' + '<br>' + value.description));
                        //row.append($('<td>').text(value.description));

                        row.append($('<td>').text(task_hours));

                        row.append($('<td>').text(value.start));
                        row.append($('<td>').text(value.finish));

                        if (value.status == 0) {
                            row.append($('<td>').text('Finished'));
                        } else {
                            row.append($('<td>').text('In progress'));
                        }

                        tasksTable.append(row);
                        */

                    })

                });
            })



            $('#createTask').click(function () {
                window.location.href = "create_task.php?project_id=" + project_id;
            })

            $('#createTicket').click(function () {
                window.location.href = "create_ticket.php?project_id=" + project_id;
            })

            $('#viewTickets').click(function () {
                window.location.href = "view_tickets.php?project_id=" + project_id;
            })

            $('#edit_project').click(function () {
                window.location.href = "edit_project.php?project_id=" + project_id;
            })

            $('#manageProjectUsers').click(function () {
                window.location.href = "manage_project_users.php?project_id=" + project_id;
            })

            $('#viewStatistics').click(function () {
                window.location.href = "view_statistics.php?project_id=" + project_id;
            })


            $('#archive_project').click(async function () {
                try {
                    const userChoice = await confirmPopUp("Archive this project?");
                    if (userChoice === 'confirm') {
                        $.ajax({
                            "method": "POST",
                            "url": apiLink + "archive_project",
                            "data": {
                                'project_id': project_id
                            }
                        }).done(function (data) {
                            console.log(data);
                            data = JSON.parse(data);

                            if (data.success == true) {
                                basicPopUp('Project archived');

                                setTimeout(function () {
                                    window.location.href = "all_project.php";
                                }, 1000);

                            }

                        })

                    } else {

                    }
                } catch (error) {
                    console.error('An error occurred:', error);
                }
            });

        })

    </script>



</body>

</html>