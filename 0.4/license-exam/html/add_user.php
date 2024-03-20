<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Add user</title>
    <?php require_once 'header.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6">
            <div class="section box">
                <div class="title has-text-centered py-3">
                    Create a new user
                </div>
                <form class="field py-5">

                    <div class="columns is-centered">
                        <div class="column is-5">
                            <p class="py-2 ">Enter email:</p>

                        </div>
                        <div class="column is-5">
                            <input id="email" class="input" type="text" placeholder="email" required>

                        </div>

                    </div>
                    <div class="columns is-centered">
                        <div class="column is-5">
                            <p class="py-2 ">Enter name:</p>
                        </div>

                        <div class="column is-5">
                            <input id="name" class="input  " type="text" placeholder="name" required>
                        </div>
                    </div>
                    <div class="columns is-centered">
                        <div class="column is-5">
                            <p class="py-2 ">Enter password:</p>
                        </div>
                        <div class="column is-5">
                            <input id="password" class="input  " type="text" placeholder="password" required>
                        </div>
                    </div>

                    <div class="columns is-centered">

                        <div class="column is-5">
                            <p class="py-2 ">Enter postion:</p>
                        </div>

                        <div class="column is-5">
                            <div class="select">
                                <select id="position" class="select" required>
                                    <option id="admin" style="display: none">Admin</option>
                                    <option>Manager</option>
                                    <option selected="selected">Worker</option>
                                    <option>Client</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="container pt-3 has-text-centered">
                        <button class="button" type="button" id="createUser">Create new user</button>

                    </div>


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
        $(document).ready(function () {

            $.ajax({
                "method": "POST",
                "url": apiLink + "get_position"

            }).done(function (data) {
                data = JSON.parse(data);

                if (data.position >= 20) {
                    $('#admin').remove();
                } else {
                    $('#admin').show();
                }
            })


            $('#createUser').click(function () {
                var email = $('#email').val();
                var name = $('#name').val();
                var password = $('#password').val();
                var position = $('#position').val();

                if (email === '') {
                    basicPopUp('Please enter email');
                    return;
                } else if (name === '') {
                    basicPopUp('Please enter email');
                    return;

                } else if (password === '') {
                    basicPopUp('Please enter email');
                    return;

                } else if (position === '') {
                    basicPopUp('Please enter email');
                    return;
                }

                password = CryptoJS.SHA1(password);
                password = password.toString();


                $.ajax({
                    method: "POST",
                    url: apiLink + "add_new_user",
                    data: {
                        'email': email,
                        'name': name,
                        'password': password,
                        'position': position
                    }

                }).done(function (data) {

                    console.log(data);
                    data = JSON.parse(data);

                    if (data == true) {
                        $('#email').val('');
                        $('#name').val('');
                        $('#password').val('');
                        $('#position').val('Worker');

                        setTimeout(function () {
                            basicPopUp('User created');

                        }, 100);
                    }

                })

            })

        })


    </script>

</body>

</html>