<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Edit project</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">

            <input type="button" class="button ml-6" id="back_to_project" value="Back to project">

            <div class="columns is-centered mb-6 mt-6 has-text-centered">
                <div class="column is-6">
                    <input type="text" class="input mb-5" id="project_name" placeholder="Project name">
                    <input type="text" class="input mb-6" id="project_description" placeholder="Project description">
                    <p>Enter new due date below:</p>
                    <input type="date" class="input mt-4" id="due_date" style="display: none;">
                    <br>
                    
                    <div class="button  is-success mt-6" id="save_project">
                        Save project
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

        const urlParams = new URLSearchParams(window.location.search);
        const project_id = urlParams.get('project_id');


        $.ajax({
            url: apiLink + 'get_position',
            type: 'POST',

        }).done(function (data) {

            if (data == null) {
                $('#due_date').show();
                return;
            }
            data = JSON.parse(data);
            //console.log(data);


            // 0-10 - admin
            // 11-20 - manager
            // 21-30 - worker
            // 31-40 - client

            if (data.position <= 20) {
                $('#due_date').show();

            } else {
                $('#due_date').remove();

            }
        });


        $('#save_project').click(function () {

            $.ajax({
                "method": "POST",
                "url": apiLink + "edit_project",
                "cache": false,
                "data": {
                    project_id: project_id,
                    project_name: $("#project_name").val(),
                    project_description: $("#project_description").val(),
                    due_date: $("#due_date").val()
                }
            }).done(function (data) {
                //console.log(data);
                data = JSON.parse(data);
                console.log(data);

                if (data.success == true) {
                    console.log('data');
                    basicPopUp("Project edited");
                    $("#project_name").val('');
                    $("#project_description").val('');
                }
            });



        });


        $("#back_to_project").click(function () {
            window.location.href = "individual_project.php?project_id=" + project_id;
        });


    </script>


</body>

</html>