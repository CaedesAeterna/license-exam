<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Manage project users</title>
    <?php require_once 'header.php'; ?>

    <!--
    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.min.css" rel="stylesheet" />

    -->
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

            <div class="section ">

                <div class="columns is-centered">
                    <div class="column has-background-link is-9">

                        <table class="table is-fullwidth is-hoverable" id="usersTable">
                            <th>User</th>
                            <th>Email</th>
                            <th>Remove</th>
                        </table>
                    </div>
                </div>
                <div class="columns has-background-warning is-centered mt-4">

                    <div class="column is-5">
                        <input type="text" id="searched_user" class="input">
                    </div>

                    <div class="column is-4">
                        <input type="button" id="addUser" class="button" value="Add User">
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


        $('#searched_user').autocomplete({
            source: function (request, response) {
                $.ajax({
                    'type': "POST",
                    'url': apiLink + "get_users_for_addition",
                    'data': {
                        'searchedUserString': request.term
                    }
                }).done(function (data) {
                    //console.log(data, response);
                    data = JSON.parse(data);
                    console.log(data.users);

                    response(data.users);

                });
            },
            minLength: 1,
            select: function (event, ui) {
                console.log("Selected: " + ui.item.value);
            }
        });

        $.ajax({
            'type': "POST",
            'url': apiLink + "get_users_for_project",
            'data': {
                'project_id': project_id
            }
        }).done(function (data) {
            console.log(data);

            data = JSON.parse(data);
            console.log(data);
            var usersTable = $('#usersTable');

            $.each(data.users, function (key, value) {
                var row = $('<tr>');

                row.append($('<td>').text(value.name));
                row.append($('<td>').text(value.email));

                row.append($('<td>').html('<a href="remove_user_from_project.php?user_id=' + value.id +
                    '&project_id=' + project_id + '">Remove</a>'));

                usersTable.append(row);
            })

        });

        // Binding a click event to the '#add_user' button
        $('#addUser').click(function () {
            // Checking if the input for '#searched_user' is empty
            if ($('#searched_user').val() == '') {
                basicPopUp('Please enter a user');
                return;
            }

            // Making an AJAX POST request to add a user to the project
            $.ajax({
                method: "POST",
                url: apiLink + "add_user_to_project",
                data: {
                    searchedUser: $('#searched_user').val(),
                    project_id: project_id
                }
            }).done(function (data) {
                data = JSON.parse(data);
                console.log(data);

                if (data == false) {
                    basicPopUp('User not added already on this project');
                } else {
                    basicPopUp('User added');
                }


                $('#searched_user').val('');

                setTimeout(function () {
                    location.reload();
                }, 1000);


            });
        });


        // Binding a click event to the '#backToProject' button
        $('#backToProject').click(function () {
            window.location.href = "individual_project.php?project_id=" + project_id;
        });


    </script>

</body>

</html>