<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/jquery.min.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'header.html'; // Include the header HTML file
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <!-- Main content -->
        <div class="container py-2 ">

            <!-- Container for the main content -->
            <div class="section ">

                <div class="columns is-centered">

                    <div class="column is-6">

                        <input class="input mb-2" type="text" placeholder="Project name" id="projectName">
                        <input class="input mt-2 mb-5" type="text" placeholder="Project description"
                            id="projectDescription">

                        <label for="freeTaskCreating">Any worker can create tasks</label>
                        <input class="checkbox m-5" type="checkbox" name="freeTaskCreatingCheckbox"
                            id="freeTaskCreating">

                        <div class="button mt-4" id="createProjectButton">
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
                    alert("Please enter project name");
                } else if ($('#projectDescription').val() == "") {
                    alert("Please enter project description");
                } else {

                    if ($('#freeTaskCreating').is(':checked')) {
                        var freeTaskCreating = 1;
                    } else {
                        var freeTaskCreating = 0;
                    }

                    $.ajax({
                        type: "POST",
                        url: "/license-exam-backend/api/v1/create_project",
                        data: {
                            'project_name': $('#projectName').val(),
                            'project_description': $('#projectDescription').val(),
                            'free_task_creating': freeTaskCreating
                        }
                    }).done(function (data) {
                        console.log(data);

                        window.location.href = "all_project.php";
                    })

                }
            })



        })

    </script>
</body>

</html>