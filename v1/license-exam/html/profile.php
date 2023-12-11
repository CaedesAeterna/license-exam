<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/jquery.min.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'header.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <div class="section ">
                <div class="tile is-ancestor">
                    <div class="tile box is-child ">
                        <div class="subtitle">
                            Personal information
                        </div>
                        <figure class="image is-128x128">
                            <img src="https://bulma.io/images/placeholders/128x128.png">
                        </figure>
                        <p class="py-2"> Name: <span id="nameSpan"> name name</span></p>

                        <p class="py-2"> Position: <span id="posSpan">pos pos</span></p>

                    </div>
                    <div class="tile box is-child">
                        <div class="subtitle">
                            Administration
                        </div>
                        <div class="button">
                            Edit profile
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

            $.ajax({
                "method": "POST",
                "url": "/license-exam-backend/api/v1/profile",
                "cache": false,
                "data": {
                    "success": true

                }

            }).done(function (data) {

                var data = JSON.parse(data);
                var name = $('#nameSpan');
                var position = $('#posSpan');


                name.text(data.name);
                position.text(data.position);

                console.log(data);
            })
        })

    </script>
</body>

</html>