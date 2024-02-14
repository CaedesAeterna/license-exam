<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Logout</title>
    <script type="text/javascript" src="../js/jquery-3.7.1.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">

            <div class="columns is-centered py-6 my-4">
                <div class="column is-4 ml-2">
                    <p class=" subtitle">Are you sure you want to exit?</p>

                    <input type="button" class="button is-centered mr-6 ml-4" id="exit" value="Logout">

                    <input type="button" class="button is-centered" id="return" value="Return">

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
        //console.log('data15');

        $("#exit").click(function () {
            //console.log('data2');

            $.ajax({

                method: "POST",
                url: apiLink + "logout"

            }).done(function (data) {

                console.log(data);
                window.location.href = "login.php";

            })


        })

        $("#return").click(function () {
            //console.log('data1');

            window.location.href = "dashboard.php";
        })




    </script>


</body>

</html>