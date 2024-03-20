<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">

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

                <!-- Tasks Section -->
                <div class="columns">
                    <div class="column is-halfwidth has-background-grey-lighter ">
                        <!-- Tasks Title -->
                        <h1 class="title ">Tasks</h1>
                        <div class="table-responsive">

                            <table class="table tasks-table  is-hoverable">

                                <!-- Table Header -->
                                <thead>
                                    <tr>
                                        <th class="is-one-quater">Title</th>
                                        <th class="is-one-quater">Description</th>
                                        <th class="is-one-quater">Hours</th>
                                        <th class="is-one-quater">Project</th>
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

                    <!-- Tickets Section -->
                    <div class="column is-halfwidth has-background-white-ter ">
                        <!-- Tickets Title -->
                        <h1 class="title">Tickets</h1>
                        <table class="table tickets-table  is-hoverable">
                            <!-- Table Header -->
                            <thead>
                                <th class="is-one-quater">Name</th>
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
        $(document).ready(function () {


            // console.log("Hello");
            $.ajax({
                "method": "POST",
                "url": apiLink + "dashboard",
                "cache": false,

            }).done(function (data) {

                console.log(data);
                // Parse the JSON data
                var data = JSON.parse(data);

                // Get the tasks table element
                var tasksTable = $('.tasks-table');

                // Get the tickets table element
                var ticketsTable = $('.tickets-table');

                console.log(data);

                // console.log(data.tasks);
                // console.log(data.tickets.name + "----------------------");

                console.log(data);
                // Check if 'data.tasks' exists

                if (data.tasks) {

                    // Iterate over each task in 'data.tasks'
                    $.each(data.tasks, function (key, value) {
                        var row = $('<tr>');

                        console.log(value);
                        // Create a table row with task details
                        row.append($('<td>').append('<a href="individual_task.php?task_id=' + value.id +
                            '&task_title=' + value.title +
                            '&task_description=' + value.description +
                            '&projects_id=' + value.projects_id

                            +

                            '">' + value.title + '</a>'));

                        row.append($('<td>').text(value.description));
                        row.append($('<td>').text("to be calculated"));

                        row.append($('<td>').append('<a href="individual_project.php?project_id=' + value.projects_id + '">'
                            + value.project + '</a></td>'));

                        tasksTable.append(row); // Add the row to the tasks table

                    })

                } else {
                    console.log("no tasks"); // Print a message if there are no tasks
                }

                console.log('\n \n');

                // Check if 'data.tickets' exists
                if (data.tickets) {

                    // Iterate over each ticket in 'data.tickets'
                    $.each(data.tickets, function (key, value) {
                        var row = $('<tr>');

                        // Print the key and value of the current ticket
                        // console.log("key: ", key, " value: ", value);
                        // Create a table row with ticket details

                        row.append($('<td>').append('<a href="individual_ticket.php?ticket_id=' + value.id + '">'
                            + value.name + '</a>'));

                        row.append($('<td>').text(value.description));
                        row.append($('<td>').text(value.project));

                        ticketsTable.append(row); // Add the row to the tickets table
                    })

                } else {
                    console.log("no tickets"); // Print a message if there are no tickets
                }

            })
        })

    </script>
</body>

</html>