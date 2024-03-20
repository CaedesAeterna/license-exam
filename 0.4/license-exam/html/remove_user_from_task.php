<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <Title>Remove user</Title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container my-6 py-6">

            <div class="columns is-centered py-6">

                <div class="column is-4">

                    <p class="subtitle"> Are you sure you want to remove the user from the project? </p>

                    <input class="button ml-6 mr-6" type="button" value="Remove" id="removeUserFromTask">
                    <input class="button ml-6" type="button" value="Cancel" id="cancelRemoveUserFromTask">

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
        const projects_id = urlParams.get('projects_id');
        const task_id = urlParams.get('task_id');
        const user_id = urlParams.get('user_id');

        $(document).ready(function () {

            $("#cancelRemoveUserFromTask").click(function () {
                window.location.href = "manage_task_users.php?task_id=" + task_id + "&projects_id=" + projects_id;
            })

            $("#removeUserFromTask").click(function () {
                $.ajax({
                    method: "POST",
                    url: apiLink + "remove_user_from_task",
                    data: {
                        'task_id': task_id,
                        'user_id': user_id
                    }
                }).done(function (data) {
                    console.log(data);
                    data = JSON.parse(data);

                    if (data == true) {
                        window.location.href = "manage_task_users.php?projects_id=" + projects_id + "&task_id=" + task_id;
                    }

                })

            })




        })



    </script>

</body>

</html>