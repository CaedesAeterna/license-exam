<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Edit pdf template</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <div class="section has-text-centered">
                <p class="subtitle "> Here you can upload the header,footer and logo for your pdf</p>

                <div class="columns is-centered ">
                    <div class="column is-7 my-3">
                        <input class="input my-2" type="text" id="header_link" placeholder="Header link">
                        <input class="input my-2" type="text" id="footer_link" placeholder="Footer link">
                        <input class="input mt-2 mb-6" type="text" id="logo_link" placeholder="Logo link">

                        <input class="button is-link" type="button" value="Upload" id="upload">

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
            $("#upload").click(function () {

                var message = "";

                if ($("#header_link").val() != "") {
                    $.ajax({
                        type: "POST",
                        url: apiLink + "edit_option",
                        data: {
                            key: "header_link",
                            value: $("#header_link").val()
                        }
                    })

                }

                if ($("#footer_link").val() != "") {
                    $.ajax({
                        type: "POST",
                        url: apiLink + "edit_option",
                        data: {
                            key: "footer_link",
                            value: $("#footer_link").val()
                        }
                    })
                }

                if ($("#logo_link").val() != "") {
                    $.ajax({
                        type: "POST",
                        url: apiLink + "edit_option",
                        data: {
                            key: "logo_link",
                            value: $("#logo_link").val()
                        }
                    })
                }

            })

        })


    </script>

</body>

</html>