<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" />
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
            <div class="section">


                <div class="title">
                    <span id="ticketName">
                        Ticket title


                    </span>
                </div>
                <div class="box" id="ticketBody">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet hendrerit quam et
                        laoreet. Suspendisse potenti. Quisque ut sem nulla. Ut consequat urna et elementum pulvinar.
                        Donec gravida purus sapien, eu pretium mi tristique eget. Mauris ullamcorper massa nec mi
                        bibendum, sed hendrerit nulla egestas. Sed ac maximus eros. Sed sagittis, ex at rutrum
                        consectetur, nisi risus efficitur sapien, in semper lorem sapien sit amet dui. Proin quis tellus
                        dui. Vestibulum elementum neque id elit facilisis, et rutrum mi eleifend. Nullam dapibus
                        porttitor sem, in aliquam sapien volutpat a. Donec sem felis, feugiat in sodales eu, aliquet
                        fringilla lacus. Curabitur iaculis eleifend posuere. Duis efficitur odio justo, sed laoreet
                        risus accumsan sed.

                        Donec at felis eleifend, aliquam risus tincidunt, suscipit sapien. Maecenas suscipit nibh felis,
                        eget rutrum ligula pretium in. Vestibulum suscipit scelerisque tincidunt. Praesent pretium neque
                        vitae placerat eleifend. Aliquam id auctor ipsum, at cursus metus. Praesent iaculis leo
                        fringilla viverra tincidunt. Phasellus mattis nibh vitae consectetur pellentesque. Aenean metus
                        leo, interdum suscipit mattis quis, auctor semper nunc. Praesent sed posuere mi. Sed vitae
                        tempus nisl. Sed eu tristique ligula, eu posuere orci. Curabitur volutpat nec dolor a
                        scelerisque. Mauris interdum eleifend ex, vel fringilla nisl tempor ac. Phasellus ex erat,
                        semper et mauris porttitor, consequat vulputate quam. Class aptent taciti sociosqu ad litora
                        torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                </div>
                <div class="button" id="ticketDone">
                    Ticket done
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
                "url": "/license-exam-backend/api/v1/individual_ticket",
                "cache": false,
                "data": {
                    "success": true

                }

            }).done(function (data) {
                console.log(data);
                data = JSON.parse(data);

                $("#ticketName").text(data.name);
                $("#ticketBody").text(data.description);


            })
        })

    </script>
</body>

</html>