<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Archive task</title>

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
                            <label class="label mb-5"> Are you sure you wanna archive this task?</label>

                            <input type="button" class="button mr-6 my-2" id="archive_task" value="Archive Task">
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




        $('#archive_task').on('click', function () {

            

        });

        $('#cancel').on('click', function () {

            window.location.href = "individual_task.php?task_id=" + task_id
                + "&projects_id=" + projects_id;

        });


    </script>

</body>

</html>