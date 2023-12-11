<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="../js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/neumorphic-login.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'header.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <!-- Main container -->
        <div class="container">
            <!-- Section -->
            <div class="section">
                <!-- Centered columns -->
                <div class="columns is-centered py">
                    <!-- Centered column -->
                    <div class="column has-text-centered is-6">
                        <!-- Login body -->
                        <div class="hero-body has-text-centered">
                            <!-- Login form -->
                            <div class="login has-background-grey-darker">
                                <h1 class="title has-text-white is-size-3">Login</h1>
                                <!-- Login form -->
                                <form method="post">
                                    <!-- Email field -->
                                    <div class="field">
                                        <div class="control">
                                            <label for="email" class="label has-text-white">Email</label>
                                            <input class="input" type="email" placeholder="hello@example.com"
                                                name="email" id="email" required />
                                        </div>
                                    </div>

                                    <!-- Password field -->
                                    <div class="field">
                                        <div class="control">
                                            <label for="password" class="label has-text-white">Password</label>

                                            <input class="input" type="password" placeholder="**********"
                                                name="password" id="password" required />
                                        </div>
                                    </div>
                                    <br />
                                    <!-- Login button -->
                                    <button class="button is-block is-fullwidth is-black" type="button"
                                        id="loginButton">
                                        Login
                                    </button>
                                </form>
                                <br>
                                <!-- Forgot password link -->
                                <nav class="level">
                                    <div class="level-item has-text-centered">
                                        <div>
                                            <a href="forgot_password.php" target="blank" class="has-text-white">Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
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
            // Function triggered when login button is clicked
            $("#loginButton").click(function () {



                // Check if email field is empty
                if ($("#email").val() == "") {
                    alert("Please enter email");
                }

                // Check if password field is empty
                if ($("#password").val() == "") {
                    alert("Please enter password");
                }

                // Get the email and password values
                var email = $("#email").val();
                var password = $("#password").val();

                var salt = "";
                var hash = "";
                var hashString = "";

                $.ajax({
                    "method": "POST",
                    "url": "/license-exam-backend/api/v1/create_salt",

                }).done(function (data) {
                    console.log(data);

                    salt = data;
                    password = CryptoJS.SHA1(password)

                    hash = CryptoJS.SHA1(password + salt);

                    hashString = hash.toString();
                    console.log('hashString : ' + hashString);
                    // Send a POST request to the login API endpoint
                    $.ajax({
                        "method": "POST",
                        "url": "/license-exam-backend/api/v1/login",
                        "cache": false,
                        data: {
                            "email": email,
                            "password": hashString,
                        }

                    }).done(function (data) {
                        // Parse the response data
                        //data = JSON.parse(data);

                        //console.log('data after login ajax: '+data);
                        if (data.success === true) {
                            // Redirect to the dashboard page if login is successful
                            window.location.href = "dashboard.php";

                        } else {
                            console.log("not happening");
                        }

                        console.log(data);
                    })
                })



            })
        })

    </script>


</body>

</html>