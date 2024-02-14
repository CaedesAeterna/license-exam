<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>All project</title>
    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html'; // Include the header HTML file
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <!-- Main content -->
        <div class="container py-2 ">
            <!-- Container for the main content -->

            <div class="section ">
                <!-- Section for buttons -->
                <div class="button " id="createProject">
                    <!-- Button to create a new project -->
                    Create new project
                </div>

            </div>

            <div class="section ">
                <!-- Section for table -->
                <table class="table is-responsive is-fullwidth  is-hoverable" id="projectsTable">
                    <!-- Table to display project details -->
                    <thead>
                        <tr>
                            <th>Project name</th>
                            <th>Description</th>
                            <th>Tasks</th>
                            <th>Tickets</th>
                            <th>Start </th>
                            <th>Finish</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>



                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>


    <!-- FOOTER START ---------------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'footer.html'; // Include the footer HTML file
    ?>

    <!-- FOOTER END------------------------------------------------------------------------------------------------------------------------------>

    <script>
        $(document).ready(function () {

            $.ajax({
                'method': 'POST',
                'url': apiLink + 'get_position',

            }).done(function (data) {
                console.log(data);

                data = JSON.parse(data);

                if (data.position != 10 && data.position != 20) {
                    $('#createProject').remove();
                }

            })


            // Send an AJAX request to retrieve all projects
            $.ajax({
                "method": "POST",
                "url": apiLink + "all_projects",
                "cache": false,
                "data": {
                    "success": true
                }
            }).done(function (data) {
                // Log the retrieved data to the console
                //console.log(data);

                // Parse the JSON data
                var data = JSON.parse(data);
                //console.log(data);

                // Get the tasks table element

                var projectsTable = $('#projectsTable');


                $.each(data.projects, function (key, value) {
                    var row = $('<tr>');

                    row.append($('<td>').append('<a href="individual_project.php?project_id=' + value.project_id + '">'
                        + value.name + '</a>'));

                    row.append($('<td>').text(value.description));
                    row.append($('<td>').text('tasks'));
                    row.append($('<td>').text('tickets'));
                    row.append($('<td>').text(value.start));
                    row.append($('<td>').text(value.finish));
                    row.append($('<td>').text(value.status));


                    console.log(value);
                    projectsTable.append(row);
                })

            })

            $('#createProject').click(function () {

                window.location.href = "create_project.php";

            })



        })

    </script>
</body>

</html>