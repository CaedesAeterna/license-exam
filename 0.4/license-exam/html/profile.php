<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style.css">


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
                <div class="tile is-ancestor">
                    <div class="tile box is-child ">
                        <div class="subtitle">
                            Personal information
                        </div>

                        <figure class="image is-128x128" id="profilePicContainer">
                            <img class="" src="https://bulma.io/images/placeholders/128x128.png" id="profilePic">
                        </figure>

                        <p class="py-2"> Name: <span id="nameSpan"> </span></p>

                        <p class="py-2"> Position: <span id="posSpan"> </span></p>

                    </div>
                    <div class="tile box is-child ">
                        <div class="subtitle">
                            Administration
                        </div>
                        <div class="button my-2" id="editProfile">
                            Edit profile
                        </div>
                        <br>
                        
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


            $('#editProfile').on('click', function () {
                window.location.href = "edit_profile.php";
            })


        
            $.ajax({
                "method": "POST",
                "url": apiLink + "profile",
                "data": {
                    "success": true
                }

            }).done(function (data) {

                var data = JSON.parse(data);

                var name = $('#nameSpan');
                var position = $('#posSpan');


                name.text(data.name);
                position.text(data.position);

                var link = data.img;

                if (link) {

                    $('#profilePic').attr('src', link);

                    $('#profilePicContainer').addClass('is-128x128');
                    $('#profilePic').addClass('is-128x128');
                }



                //console.log(data);
            })
        })

    </script>
</body>

</html>