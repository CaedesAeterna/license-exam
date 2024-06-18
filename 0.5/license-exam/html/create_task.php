<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Create task</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <input type="button" class="button ml-6" id="backToProject" value="Back to project">

            <div class="section has-text-centered">
                <form>
                    <p class="subtitle has-background-danger has-text-centered py-2">The creator of the task will be
                        automatically assigned </p>
                    <input class="input my-2" name="task_title" type="text" placeholder="Task name" id="newTaskTitle">

                    <input class="input my-2" name="task_description" type="text" placeholder="Description"
                        id="newDescription">
                    <input class="button mt-6 " type="button" id="insertSubmitButton" value="New Task">

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
                basicPopUp("Please enter a task name")
                return
            }
            else if ($('#newDescription').val() == "") {
                basicPopUp("Please enter a description")
                return
            }
            
            $.ajax({ 
                type: "POST",
                url: apiLink + "create_task",
                cache: false,
                data: {
                    'task_title': $('#newTaskTitle').val(),
                    'task_description': $('#newDescription').val(),
                    //'task_other_info': $('#newOtherInfo').val(),
                    'project_id': project_id
                }
            }).done(function (data) {
                data = JSON.parse(data);
                //console.log(data);
                if (data.success == true) {
                    basicPopUp("Task created");
                    //console.log("success in insert");
                }
                if (data["success"] == false) {
                    basicPopUp(data["message"]);
                }
            })
        })

        $('#backToProject').click(function () {
            window.location.href = "individual_project.php?project_id=" + project_id;
        })


    </script>

</body>

</html>