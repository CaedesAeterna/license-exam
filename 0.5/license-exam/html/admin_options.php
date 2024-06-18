<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Admin options</title>

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
                <p class="subtitle">
                    Below you can see the options you have
                </p>

                <div class="columns has-text-centered">

                    <div class="column">
                        <div class="button mt-2" id="edit_date_format" style="display: none;">
                            Change date format
                        </div>

                    </div>
                    <div class="column">
                        <div class="button mt-2" id="edit_pdf_template" style="display: none;">
                            Edit pdf template

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


        $.ajax({
            "method": "POST",
            "url": apiLink + "get_position",
        }).done(function (data) {
            data = JSON.parse(data);
            //console.log(data.position);

            if (data.position > 10) {
                $('#edit_date_format').remove();
                $('#edit_pdf_template').remove();

            } else {
                $('#edit_date_format').show();
                $('#edit_pdf_template').show();

                $('#edit_date_format').on('click', function () {
                    window.location.href = "edit_date_format.php";
                })
                $('#edit_pdf_template').on('click', function () {
                    window.location.href = "edit_pdf_template.php";
                })
            }

        })



    </script>


</body>

</html>