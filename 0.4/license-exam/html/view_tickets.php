<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Tickets</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">

            <input type="button" class="button ml-6" id="backToProject" value="Back to project">

            <div class="section ">

                <table class="table is-fullwidth  is-hoverable" id="ticketsTable">
                    <thead>
                        <tr>
                            <th>Ticket name</th>
                            <th>Ticket description</th>

                        </tr>
                    </thead>

                </table>

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
            const project_id = urlParams.get('project_id');


            $('#backToProject').click(function () {
                window.location.href = "individual_project.php?project_id=" + project_id;
            })

            $("#ticketsTable tbody tr").remove();


            $.ajax({
                method: "POST",
                url: apiLink + "get_tickets",
                data: {
                    'project_id': project_id
                }
            }).done(function (data) {

                //console.log(data);
                data = JSON.parse(data);
                console.log(data);
                var ticketsTable = $('#ticketsTable');

                $.each(data.tickets, function (key, value) {
                    var row = $('<tr>');

                    row.append($('<td>').append('<a href="individual_ticket.php?ticket_id=' + value.id + '">'
                        + value.name + '</a>'
                    ));
                    row.append($('<td>').text(value.description));

                    ticketsTable.append(row);
                })

            })





        })



    </script>

</body>

</html>