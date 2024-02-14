<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Delete task</title>
    <script src="../js/jquery.min.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6">
            <div class="section ">
                <form>
                    <div class="columns is-centered">
                        <div class="column is-4">
                            <label class="label mb-5"> Are you sure you wanna delete this task?</label>

                            <input type="button" class="button mr-6 my-2" id="deleteTask" value="Delete Task">
                            <input type="button" class="button ml-6 my-2" id="cancel" value="Cancel">
                        </div>

                    </div>

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
        const task_title = urlParams.get('task_title');
        const task_description = urlParams.get('task_description');
        const projects_id = urlParams.get('projects_id');




        $('#deleteTask').on('click', function () {

            $.ajax({
                "method": "POST",
                "url": "/license-exam-backend/api/v1/delete_task",
                "data": {
                    'task_id': task_id

                }
            }).done(function (data) {
                data = JSON.parse(data);
                console.log(data);

                window.location.href = "individual_project.php?project_id=" + data.project_id;

            })

        });

        $('#cancel').on('click', function () {

            window.location.href = "/license-exam/html/individual_task.php?task_id=" + task_id
                + "&projects_id=" + projects_id;

        });


    </script>

</body>

</html>