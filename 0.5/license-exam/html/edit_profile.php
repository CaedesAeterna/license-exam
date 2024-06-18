<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Edit profile</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>


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

                        <label class="label"> New name</label>
                        <input class="input mb-5" type="text" id="name" placeholder="Name">

                        <label class="label"> New profile picture link</label>
                        <input class="input mb-5" type="text" id="profilePicLink" placeholder="Profile picture link">

                        <label class="label"> New email adress</label>
                        <input class="input mb-5" type="text" id="new_email" placeholder="New email adress">

                        <label class="label"> New password</label>
                        <input class="input mb-5" type="text" id="new_password" placeholder="New password">

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

            if ($('#new_password').val() == "") {
                new_password = null;
            } else {
                new_password = CryptoJS.SHA1($('#new_password').val()).toString();
            }

            $.ajax({
                "method": "POST",
                "url": apiLink + "edit_profile",
                "cache": false,
                "data": {
                    name: $('#name').val(),
                    profilePicLink: $('#profilePicLink').val(),
                    new_email: $('#new_email').val(),
                    new_password: new_password
                }
            }).done(function (data) {
                console.log(data);

                data = JSON.parse(data);
                console.log(data);

                if (data == true) {

                    $('#name').val();
                    $('#profilePicLink').val();
                    $('#new_password').val();
                    $('#new_email').val();

                    basicPopUp("Profile updated!");

                }
            })
        })
    </script>


</body>

</html>