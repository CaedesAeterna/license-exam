<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>User</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <div class="section ">

                <!-- Projects Section -->
                <div class="columns">
                    <div class="column is-halfwidth has-background-warning-light ">
                        <!-- Tasks Title -->
                        <h1 class="title ">Projects</h1>
                        <div class="table-responsive">

                            <table class="table projects_table  is-hoverable" id="projects_table">

                                <!-- Table Header -->
                                <thead>
                                    <tr>
                                        <th class="is-one-quater">Name</th>
                                        <th class="is-one-quater">Description</th>

                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tasks Section -->
                    <div class="column is-halfwidth has-background-info-light ">
                        <!-- Tickets Title -->
                        <h1 class="title">Tasks</h1>
                        <table class="table tasks_table  is-hoverable" id="tasks_table">
                            <!-- Table Header -->
                            <thead>
                                <th class="is-one-quater">Title</th>
                                <th class="is-one-quater">Description</th>
                                <th class="is-one-quater"> Project</th>
                            </thead>
                            <!-- Table Body -->
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>
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

        const urlParams = new URLSearchParams(window.location.search);
        const user_id = urlParams.get('user_id');

        $.ajax({
            "method": "POST",
            "url": apiLink + "individual_user",
            data: {
                "user_id": user_id
            }
        }).done(function (data) {

            //console.log(data);
            data = JSON.parse(data);
            console.log(data);


            var projects_table = $('#projects_table');
            var tasks_table = $('#tasks_table');


            $.each(data.projects, function (key, value) {
                var row = $('<tr>');
                row.append($('<td>').html('<a href="individual_project.php?project_id=' + value.id + '">' + value.name + '</a>'));
                row.append($('<td>').text(value.description));
                projects_table.append(row);
            })


            $.each(data.tasks, function (key, value) {
                var row = $('<tr>');
                row.append($('<td>').html('<a href="individual_task.php?task_id=' + value.id + '">' + value.title + '</a>'));
                row.append($('<td>').text(value.description));

                $.ajax({
                    "method": "POST",
                    "url": apiLink + "get_project_name",
                    "data": {
                        'project_id': value.projects_id
                    }
                }).done(function (data) {
                    //console.log(data);
                    data = JSON.parse(data);
                    row.append($('<td>').html('<a href="individual_project.php?project_id=' + value.projects_id + '">'
                             + data.project_name + '</a>'));
                });



                tasks_table.append(row);
            })


        })


    </script>


</body>

</html>