<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Nano Navigator - Secure Project Management Login</title>
    <meta name="keywords" content="Nano Navigator, project management, login, secure project management app">
    <meta name="description" content="Login to Nano Navigator - Your free, secure project management tool. 
                Manage projects seamlessly with our advanced features.">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>


    <link rel="stylesheet" type="text/css" href="../css/neumorphic-login.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/animation.css">
</head>

<body>

    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->

    <div id="loadingSpinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>
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
                                <form>
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

            $('#email').on("keypress", function (event) {
                // If the user presses the "Enter" key on the keyboard
                if (event.key === "Enter") {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    $("#loginButton").click();
                }
            });

            $('#password').on("keypress", function (event) {
                // If the user presses the "Enter" key on the keyboard
                if (event.key === "Enter") {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    $("#loginButton").click();
                }
            });

            // Function triggered when login button is clicked
            $("#loginButton").click(function () {

                // Check if email field is empty
                if ($("#email").val() == "") {
                    basicPopUp("Please enter email");
                    return;

                }

                // Check if password field is empty
                if ($("#password").val() == "") {
                    basicPopUp("Please enter password");
                    return;

                }

                // Get the email and password values
                var email = $("#email").val();
                var password = $("#password").val();

                // Show the loading spinner
                $("#loadingSpinner").show();
                // Define variables
                var salt = "";
                var hash = "";
                var hashString = "";


                //console.log('on frontedn SHA1: ' + CryptoJS.SHA1('a').toString());

                $.ajax({
                    "url": apiLink + "create_salt",
                    "method": "POST"
                }).done(function (data) {
                    // Set the salt value
                    salt = data;
                    // Hash the password using SHA1 algorithm
                    password = CryptoJS.SHA1(password).toString();
                    hashString = CryptoJS.SHA1(password + salt).toString();

                    // Send a POST request to the login API endpoint
                    $.ajax({
                        "method": "POST",
                        "url": apiLink + "login",
                        data: {
                            "email": email,
                            "password": hashString,
                        }
                    }).done(function (data) {
                        console.log(data);
                        // Parse the response data
                        // Hide the loading spinner
                        $("#loadingSpinner").hide();

                        data = JSON.parse(data);
                        if (redirectToPage(data)) {
                            return;
                        }
                        if (data.success == true) {
                            window.location.href = "dashboard.php";
                        }
                    })
                })



            })
        })

    </script>


</body>

</html>