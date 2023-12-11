<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" />

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'header.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container  py-6 ">
            <div class="section box">
                <div class="title has-text-centered py-3">
                    Create a new user
                </div>
                <form class="field py-3" method="post">
                    <div class="columns ">
                        <div class="column is-one-third">
                            <p class="py-2 ">Enter email:</p>

                        </div>
                        <div class="column is-one-third">
                            <input class="input  " type="text" placeholder="email" required>

                        </div>


                    </div>
                    <div class="columns">
                        <div class="column is-one-third">
                            <p class="py-2 ">Enter name:</p>

                        </div>
                        <div class="column is-one-third">
                            <input class="input  " type="text" placeholder="name" required>

                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-one-third">
                            <p class="py-2 ">Enter password:</p>

                        </div>
                        <div class="column is-one-third">
                            <input class="input  " type="text" placeholder="password" required>

                        </div>

                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="answer">
                                    Client
                                </label>
                                <label class="radio">
                                    <input type="radio" name="answer">
                                    Worker
                                </label>
                                <label class="radio">
                                    <input type="radio" name="answer">
                                    Project manager
                                </label>
                                <label class="radio">
                                    <input type="radio" name="answer">
                                    Super admin
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="container pt-3 has-text-centered">
                        <button class="button" type="submit">Create new user</button>

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

</body>

</html>