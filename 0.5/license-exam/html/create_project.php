<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Create project</title>
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

                <div class="columns is-centered">


                    <div class="column is-6 has-text-centered">
                        <p class="subtitle has-background-danger has-text-centered py-2">The creator of the project will
                            be automatically assigned </p>
                        <input class="input mb-2" type="text" placeholder="Project name" id="projectName">
                        <input class="input mt-2 mb-5" type="text" placeholder="Project description"
                            id="projectDescription">

                        <label for="freeTaskCreating">Any worker can create tasks</label>
                        <input class="checkbox m-5 " type="checkbox" name="freeTaskCreatingCheckbox"
                            id="freeTaskCreating">
                        <br>

                        <input type="date" class="input mt-4" id="due_date">
                        <br>

                        <div class="button mt-6 has-background-success" id="createProjectButton">
                            Submit new project
                        </div>

                    </div>
                </div>
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


            $('#createProjectButton').click(function () {

                if ($('#projectName').val() == "") {
                    basicPopUp("Please enter project name");

                } else if ($('#projectDescription').val() == "") {
                    basicPopUp("Please enter project description");

                } else if($('#due_date').val() == "") {
                    basicPopUp("Please enter due date");

                }else {

                    if ($('#freeTaskCreating').is(':checked')) {
                        var freeTaskCreating = 1;

                    } else {
                        var freeTaskCreating = 0;
                        
                    }

                    $.ajax({
                        type: "POST",
                        url: apiLink + "create_project",
                        data: {
                            'project_name': $('#projectName').val(),
                            'project_description': $('#projectDescription').val(),
                            'free_task_creating': freeTaskCreating,
                            'due_date': $('#due_date').val()
                        }
                    }).done(function (data) {
                        console.log(data);
                        data = JSON.parse(data);

                        if (redirectToPage(data)) {
                            return;
                        }

                        window.location.href = "all_project.php";
                    })

                }
            })



        })

    </script>
</body>

</html>