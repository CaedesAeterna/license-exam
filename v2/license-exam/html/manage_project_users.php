<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Manage users</title>
    <?php include 'header.html'; ?>

    <!--
    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.min.css" rel="stylesheet" />

    -->

    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

    <script type="text/javascript" src="../js/jquery-ui.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/jquery-ui.css">

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

        const urlParams = new URLSearchParams(window.location.search);
        const project_id = urlParams.get('project_id');

        var searchedUserArray = [];

        $.ajax({
            'type': "POST",
            'url': "/license-exam-backend/api/v1/get_users_for_project",
            'data': {
                'project_id': project_id
            }
        }).done(function (data) {
            //console.log(data);

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

        })


        $('#searchedUser').keyup(function () {

            var searchedUserString = $('#searchedUser').val();

            $.ajax({
                'type': "POST",
                'url': "/license-exam-backend/api/v1/get_users_for_addition",
                'data': {
                    'searchedUserString': searchedUserString
                }
            }).done(function (data) {
                console.log(data);

                data = JSON.parse(data);

                searchedUserArray = [];

                $.each(data.users, function (key, value) {

                    if (searchedUserArray.includes(value.name)) {

                    } else {
                        searchedUserArray.push(value.name);
                    }
                })

                console.log(searchedUserArray);

                $('#searchedUser').autocomplete({
                    source: searchedUserArray

                });

            });




        })


        $('#addUser').click(function () {


            if (searchedUser.length == 0) {
                alert('Please enter a user');
                return;
            }

            $.ajax({
                'method': "POST",
                'url': "/license-exam-backend/api/v1/add_user_to_project",
                'data': {
                    'searchedUser': $('#searchedUser').val(),
                    'project_id': project_id
                }

            }).done(function (data) {
                console.log(data);
            })

            $('#searchedUser').val('');

            location.reload(true);
        })




    </script>


</body>

</html>