<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>All project</title>

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
                <div class="button " id="createProject" style="display: none;">
                    <!-- Button to create a new project -->
                    Create new project
                </div>

            </div>




            <div class="section pt-1" id="projects">

                <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                    <div class="subtitle col_title row_title">Project name</div>
                    <div class="subtitle col_small row_title">Description</div>
                    <div class="subtitle col_small row_title">Start</div>
                    <div class="subtitle col_small row_title">Finish</div>
                    <div class="subtitle col_small row_title">Active</div>

                </div>

            </div>

            <!-- Section for table 

                <table class="table is-responsive is-fullwidth  is-hoverable" id="projectsTable">
                    
                    <thead>
                        <tr>
                            <th>Project name</th>
                            <th>Description</th>
                            <th>Start </th>
                            <th>Finish</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>



                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                -->


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
                //console.log(data);

                data = JSON.parse(data);

                if (data.position > 20) {
                    $('#createProject').remove();
                }
                else {
                    $('#createProject').show();
                }

            })


            // Send an AJAX request to retrieve all projects
            $.ajax({
                "method": "POST",
                "url": apiLink + "all_projects",

            }).done(function (data) {
                // Log the retrieved data to the console
                //console.log(data);

                // Parse the JSON data
                var data = JSON.parse(data);
                //console.log(data);

                // Get the tasks table element

                var projectsTable = $('#projectsTable');
                var project_div = $('#projects');

                $.each(data.projects, function (key, value) {

                    var row = $('<div class="is-flex is-justify-content-space-between is-flex-wrap-wrap mb-4">');

                    row.append($('<div class="col_title">').append('<a href="individual_project.php?project_id=' + value.project_id
                        + '">' + value.name + '</a>'));
                    row.append($('<div class="col_small ">').text(value.description));
                    row.append($('<div class=" col_small ">').text(value.start));
                    row.append($('<div class=" col_small ">').text(value.finish));

                    if (value.active == 0) {
                        row.append($('<div class="col_small ">').text('Finished'));
                    } else {
                        row.append($('<div class="col_small ">').text('In progress'));
                    }

                    project_div.append(row);

                    /*

                    var row = $('<tr>');

                    row.append($('<td>').append('<a href="individual_project.php?project_id=' + value.project_id + '">'
                        + value.name + '</a>'));

                    row.append($('<td>').text(value.description));


                    row.append($('<td>').text(value.start));
                    row.append($('<td>').text(value.finish));
                    row.append($('<td>').text(value.active));


                    //console.log(value);
                    projectsTable.append(row);
                    */

                })

            })

            $('#createProject').click(function () {

                window.location.href = "create_project.php";

            })



        })

    </script>
</body>

</html>