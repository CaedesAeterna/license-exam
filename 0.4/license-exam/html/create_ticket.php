<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Create ticket</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6">
            <input type="button" class="button ml-6" id="backToProject" value="Back to project">

            <div class="columns is-centered mt-6 mb-4">

                <div class="column is-6">
                    <input type="text" class="input mb-4" placeholder="Ticket name" id="ticketName">
                    <input type="text" class="input mt-2" placeholder="Ticket description" id="ticketDescription">

                </div>



            </div>
            <div class="section has-text-centered pb-4">
                <input type="button" class="button " id="createTicket" value="Create ticket">


            </div>

        </div>



    </main>



    <!-- FOOTER START ------------------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'footer.html';
    ?>

    <!-- FOOTER END------------------------------------------------------------------------------------------------------------------------------>


    <script>

        const urlParams = new URLSearchParams(window.location.search);
        const project_id = urlParams.get('project_id');

        $('#backToProject').click(function () {
            window.location.href = "individual_project.php?project_id=" + project_id;
        })

        $('#createTicket').click(function () {
            if ($('#ticketName').val() == "" || $('#ticketDescription').val() == "") {
                basicPopUp("Please fill in all fields")
                return;
            }




            $.ajax({
                "method": "POST",
                "url": apiLink + "create_ticket",
                "data": {
                    'ticketName': $('#ticketName').val(),
                    'ticketDescription': $('#ticketDescription').val(),
                    'project_id': project_id
                }
            }).done(function (data) {

                data = JSON.parse(data);

                if (data.success) {
                    $('#ticketName').val('');
                    $('#ticketDescription').val('');

                    setTimeout(function () {
                        basicPopUp("Ticket created")
                    }, 100);
                }

                //console.log(data);

            })







        })




    </script>


</body>

</html>