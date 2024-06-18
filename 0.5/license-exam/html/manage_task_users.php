<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Manage task users</title>


</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <input type="button" class="button ml-6" id="backToTask" value="Back to task">

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
                        <input type="text" id="searchedUser" class="input">
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

        $(document).ready(function () {

            const urlParams = new URLSearchParams(window.location.search);
            const task_id = urlParams.get('task_id');
            const projects_id = urlParams.get('projects_id');


            $('#searchedUser').autocomplete({
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
                'url': apiLink + "get_users_for_task",
                'data': {
                    'task_id': task_id
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
                    row.append($('<td>').html('<a href="remove_user_from_task.php?user_id=' + value.id +
                        '&task_id=' + task_id + ' &projects_id=' + projects_id + '">Remove</a>'));

                    usersTable.append(row);
                })

            })

            $('#addUser').click(function () {

                if ($('#searchedUser').val() == '') {
                    basicPopUp('Please enter a user');
                    return;
                }

                $.ajax({
                    'method': "POST",
                    'url': apiLink + "add_user_to_task",
                    'data': {
                        'searchedUser': $('#searchedUser').val(),
                        'task_id': task_id
                    }

                }).done(function (data) {
                    console.log(data);
                    $('#searchedUser').val('');
                    location.reload(true);
                })


            })

            $('#backToTask').click(function () {

                window.location.href = "individual_task.php?task_id=" + task_id;
            })

        });
    </script>


</body>

</html>