<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Ticket</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <div class="button ml-4" id="backToTickets"> Back to tickets</div>

            <div class="section">


                <div class="title">
                    <span id="ticketName">

                        Ticket title

                    </span>
                </div>
                <div class="box" id="ticketBody">
                    <p>

                    </p>
                </div>

                <input type="hidden" id="project_id">

                <div class="is-flex is-justify-content-space-between">

                    <div class="button ml-6 is-success" id="workOnTicket" style="display: none;">
                        Work on ticket
                    </div>

                    <div class="button mr-6 is-danger" id="ticketDone" style="display: none;">
                        Ticket done
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

            const urlParams = new URLSearchParams(window.location.search);
            const ticket_id = urlParams.get('ticket_id');




            $.ajax({
                "method": "POST",
                "url": apiLink + "individual_ticket",
                "cache": false,
                "data": {
                    ticket_id: ticket_id

                }

            }).done(function (data) {
                console.log(data);
                data = JSON.parse(data);

                var users_id = data.users_id;

                if (users_id == null) {
                    $("#workOnTicket").show();
                    $("#ticketDone").remove();
                } else {
                    $("#workOnTicket").remove();
                    $("#ticketDone").show();
                }

                $("#ticketName").text(data.name);
                $("#ticketBody").text(data.description);
                $("#project_id").val(data.project_id);

            })


            $('#backToTickets').click(function () {
                window.location.href = "view_tickets.php?project_id=" + $("#project_id").val();
            })

            $('#ticketDone').click(function () {

                $.ajax({
                    "method": "POST",
                    "url": apiLink + "ticket_done",
                    data: {
                        ticket_id: ticket_id
                    }
                }).done(function (data) {

                    $("#workOnTicket").addClass("is-disabled");
                    data = JSON.parse(data);
                    console.log(data);
                    
                    if (data == true) {
                        basicPopUp("Ticket done")
                    }
                })

            })

            $('#workOnTicket').click(function () {

                if ($("#workOnTicket").hasClass("is-disabled")) {
                    return;
                }

                $.ajax({
                    "method": "POST",
                    "url": apiLink + "work_on_ticket",
                    data: {
                        ticket_id: ticket_id
                    }
                }).done(function (data) {

                    data = JSON.parse(data);
                    console.log(data);

                    if (data == true) {
                        basicPopUp("Ticket picked up")
                    }

                })


            })




        })

    </script>
</body>

</html>