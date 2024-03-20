<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Edit profile</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <input class="button ml-3" type="button" value="Back to profile" id="backToProfile">
            <div class="section">

                <div class="columns is-centered">
                    <div class="column is-5">
                        <input class="input mt-6 mb-3" type="text" id="name" placeholder="Name">
                        <input class="input mb-5" type="text" id="profilePicLink" placeholder="Profile picture link">

                    </div>
                </div>


                <div class="buttons is-centered">
                    <input class="button " type="button" value="Save" id="save">
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
        $('#backToProfile').on('click', function () {
            window.location.href = "profile.php";


        });


        $('#save').on('click', function () {

            $.ajax({
                "method": "POST",
                "url": apiLink + "edit_profile",
                "cache": false,
                "data": {
                    name: $('#name').val(),
                    profilePicLink: $('#profilePicLink').val()
                }
            }).done(function (data) {
                console.log(data);

                data = JSON.parse(data);
                console.log(data);

                if (data == true) {

                    $('#name').val();
                    $('#profilePicLink').val();

                    basicPopUp("Profile updated!");
                    setTimeout(function () {
                        window.location.href = "profile.php";
                    }, 1500);

                }
            })

        })

    </script>


</body>

</html>