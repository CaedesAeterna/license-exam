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

                    <input class="button ml-6 mr-6" type="button" value="Remove" id="removeUserFromProject">
                    <input class="button ml-6" type="button" value="Cancel" id="cancelRemoveUserFromProject">

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
        const user_id = urlParams.get('user_id');

        $(document).ready(function () {

            $("#cancelRemoveUserFromProject").click(function () {
                window.location.href = "manage_project_users.php?project_id=" + project_id;
            })

            $("#removeUserFromProject").click(function () {
                $.ajax({
                    method: "POST",
                    url: apiLink + "remove_user_from_project",
                    data: {
                        'project_id': project_id,
                        'user_id': user_id
                    }
                }).done(function (data) {
                    console.log(data);
                    data = JSON.parse(data);

                    if (data == true) {
                        window.location.href = "manage_project_users.php?project_id=" + project_id;
                    }

                })

            })




        })



    </script>

</body>

</html>