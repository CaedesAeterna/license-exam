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
                            <p>Enter you're email, and you will get a new password to that email</p>
                        </div>

                        <div>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-rounded" id="email" type="email"
                                        placeholder="hello@example.com" autocomplete="email" required />
                                </div>
                            </div>
                            <div class="field ">
                                <br />
                                <button class="button is-block  is-rounded is-fullwidth" type="button"
                                    id="forgot_password">
                                    Get email with with new password
                                </button>
                            </div>

                        </div>
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

    <script>

        $("#forgot_password").click(function () {
            if ($("#email").val() == "") {
                basicPopUp("Please enter your email");
                return;
            }

            $.ajax({
                method: "POST",
                url: apiLink + "send_new_password_mail",
                data: {
                    email: $("#email").val()
                },

            }).done(function (data) {
                data = JSON.parse(data);
                if (data.success == true) {
                    basicPopUp("Check your email");
                    $("#email").val("");
                }
                

            })
        })





    </script>

</body>

</html>