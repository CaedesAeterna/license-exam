<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Create task</title>
    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

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
                <form method="post">

                    <input class="input my-2" name="task_title" type="text" placeholder="Task name" id="newTaskTitle">

                    <input class="input my-2" name="task_description" type="text" placeholder="Description"
                        id="newDescription">
                    <input class="button" type="button" id="insertSubmitButton" value="New Task">

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
        const project_id = urlParams.get('project_id');

        $('#insertSubmitButton').on('click', function () {

            if ($('#newTaskTitle').val() == "") {
                alert("Please enter a task name")
                return
            }
            else if ($('#newDescription').val() == "") {
                alert("Please enter a description")

            }

            $.ajax({
                type: "POST",
                url: "/license-exam-backend/api/v1/create_task.php",
                cache: false,
                data: {
                    'task_title': $('#newTaskTitle').val(),
                    'task_description': $('#newDescription').val(),
                    //'task_other_info': $('#newOtherInfo').val(),
                    'project_id': project_id
                }
            }).done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.success == true) {
                    console.log("success in insert");
                    window.location.href = "individual_project.php?project_id=" + data.project_id;
                }
            })



        })


    </script>

</body>

</html>