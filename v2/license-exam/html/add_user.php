<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Add user</title>
    <?php include 'header.html'; ?>

    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

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
                            <select id="position" class="select" required>
                                <option>Admin</option>
                                <option>Manager</option>
                                <option selected="selected">Worker</option>
                                <option>Client</option>
                            </select>
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

            $('#createUser').click(function () {
                var email = $('#email').val();
                var name = $('#name').val();
                var password = $('#password').val();
                var position = $('#position').val();

                if (email === '') {
                    alert('Please enter email');
                    return;
                } else if (name === '') {
                    alert('Please enter email');
                    return;

                } else if (password === '') {
                    alert('Please enter email');
                    return;

                } else if (position === '') {
                    alert('Please enter email');
                    return;
                }

                password = CryptoJS.SHA1(password);
                password = password.toString();


                $.ajax({
                    method: "POST",
                    url: "/license-exam-backend/api/v1/add_new_user",
                    data: {
                        'email': email,
                        'name': name,
                        'password': password,
                        'position': position
                    }

                }).done(function (data) {
                    console.log(data);
                })


            })


        })


    </script>

</body>

</html>