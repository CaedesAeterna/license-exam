<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" />

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'header.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <div class="section ">
                <form method="post">

                    <input type="hidden" name="task_id">

                    <input class="input my-2" name="task_title" type="text" placeholder="Task name" id="editTaskTitle">

                    <input class="input my-2" name="task_description" type="text" placeholder="Description"
                        id="editDescription">


                    <input class="button" type="button" id="editSubmitButton" value="Submit Edit">

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


        $('#editTaskTitle').val(task_title);
        $('#editDescription').val(task_description);


        $('#editSubmitButton').on('click', function () {

            if ($('#editTaskTitle').val() == "") {
                alert("Please enter a task name")
                return
            }
            else if ($('#editDescription').val() == "") {
                alert("Please enter a description")

            }
            

            $.ajax({
                type: "POST",
                url: "/license-exam-backend/api/v1/edit_task.php",
                cache: false,
                data: {
                    'task_id': task_id,
                    'editTaskTitle': $('#editTaskTitle').val(),
                    'editDescription': $('#editDescription').val(),



                }
            }).done(function (data) {
                console.log(data);
                data = JSON.parse(data);
                console.log(data.project_id);

                if (data.success == "true") {
                    //console.log("success in update");

                    //window.location.href = "individual_project.php?project_id=" + data.project_id;
                    window.location.href = "individual_task.php?task_id=" + data.task_id;
                }

            })



        })


    </script>

</body>

</html>