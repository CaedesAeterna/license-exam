<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Forgot Password</title>


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
                <div class="columns is-centered ">
                    <div class="column has-text-centered is-5">

                        <h1 class="title has-text-black">Forgot Password</h1><br>
                        <div class="content is-normal has-text-black">
                            <p>Enter you're email, and you will get a verification code</p>
                        </div>

                        <form action="" method="post">
                            <div class="field">
                                <div class="control">
                                    <input class="input  is-rounded" type="email" placeholder="hello@example.com"
                                        autocomplete="email" required />
                                </div>
                            </div>


                            <div class="field ">
                                <br />

                                <button class="button is-block  is-rounded is-fullwidth" type="submit">
                                    Get email with verification code
                                </button>

                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- FOOTER START ------------------------------------------------------------------------------------------------------------------------------->
        <?php
        include 'footer.html';
        ?>

        <!-- FOOTER END------------------------------------------------------------------------------------------------------------------------------>

    </main>
</body>

</html>