<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>All user</title>

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
                <table class="table is-fullwidth  is-hoverable" id="users_table">
                    <thead>
                        <tr>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Position</th>
                        </tr>
                    </thead>

                </table>


            </div>


        </div>



    </main>



    <!-- FOOTER START ------------------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'footer.html';
    ?>

    <!-- FOOTER END------------------------------------------------------------------------------------------------------------------------------>

    <script>

        $.ajax({
            "method": "POST",
            "url": apiLink + "all_user",
        }).done(function (data) {

            //console.log(data);

            data = JSON.parse(data);
            console.log(data);

            var users_table = $('#users_table');

            $.each(data.users, function (key, value) {
                var row = $('<tr>');
                row.append($('<td>').html('<a href="individual_user.php?user_id=' + value.id + '">' + value.name + '</a>'));
                row.append($('<td>').text(value.email));
                row.append($('<td>').text(value.position));
                users_table.append(row);
            })
        })


    </script>


</body>

</html>