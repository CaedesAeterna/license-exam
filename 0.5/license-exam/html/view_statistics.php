<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Statistics</title>


    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    -->


</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <div class="button ml-4" id="backToProject"> Back to project</div>

            <div class="section has-text-centered">
                <p class="mb-4">
                    Select the interval
                </p>

                <div class="columns is-centered">
                    <div class="column is-4">
                        <input type="date" class="input" id="start_date" name="start_date">
                    </div>
                    <div class="column is-4 mb-4">
                        <input type="date" class="input" id="end_date" name="end_date">
                    </div>
                </div>

                <p>
                    Select the statistic you want to see
                </p>

                <div class="control">
                    <label class="radio">
                        <input type="radio" name="answer" id="workers">
                        Workers
                    </label>
                    <label class="radio">
                        <input type="radio" name="answer" id="tasks">
                        Tasks
                    </label>

                </div>

                <div class="button mt-6" id="get_gtatistics">
                    Get statistic

                </div>
                <br>
                <div class="button mt-6" id="generate_pdf">
                    Generate PDF
                </div>

            </div>

            <div class="has-text-centered">
                <p class="subtitle has-text-blackr">
                    Total hours: <span id="total_hours"></span>
                </p>
            </div>

            <div class="section has-text-centered" id='scrollable_div'>


                <table class="table is-responsive is-fullwidth  is-hoverable" id="statisticsTable">
                    <thead>


                        <th>Name / Title</th>
                        <th>Hours</th>

                    </thead>
                    <tbody>


                    </tbody>


                    <tfoot>

                    </tfoot>
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

            urlParams = new URLSearchParams(window.location.search);
            var project_id = urlParams.get('project_id');

            var flag = false;
            var statisticsTable = $('#statisticsTable');

            $('#backToProject').click(function () {
                window.location.href = "individual_project.php?project_id=" + project_id;
            })

            $('#generate_pdf').click(function () {
                if (!flag) {
                    return;
                }
                var selectedValue = $('input[name="answer"]:checked').attr('id');
                //console.log(selectedValue);
                if (selectedValue == "workers") {
                    var type = "workers";
                    //console.log(type+"workers")
                } else if (selectedValue == "tasks") {
                    var type = "tasks";
                    //console.log(type+"tasks")
                } else {
                    return;
                }
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();

                window.location.href = apiLink + "generate_pdf.php?project_id=" + project_id +
                    "&type=" + type + "&start_date=" + start_date + "&end_date=" + end_date;

            })

            $('#get_gtatistics').click(function () {
                $("#statisticsTable tbody tr").remove();

                var selectedValue = $('input[name="answer"]:checked').attr('id');

                if (selectedValue == "workers") {
                    var type = "workers";
                } else if (selectedValue == "tasks") {
                    var type = "tasks";
                } else {
                    return;
                }

                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();

                //console.log(start_date);
                //console.log(end_date);

                /*
                if (start_date >= end_date || start_date == '' || end_date == '') {
                    basicPopUp("Select a valid interval");
                    return
                } else if (start_date == '' || end_date == '') {
                    start_date = null;
                    end_date = null;
                } else {
                    start_date = $('#start_date').val();
                    end_date = $('#end_date').val();
                }
                */
                //var form = new FormData();
                //form.append("data", data);


                if (type == null) {
                    basicPopUp("Wrong type");
                    //console.log(type)
                }

                $.ajax({
                    "method": "POST",
                    "url": apiLink + "get_statistics",

                    "data": {
                        type: type,
                        project_id: project_id,
                        start_date: start_date,
                        end_date: end_date
                    }
                }).done(function (data) {

                    data = JSON.parse(data);
                    $.each(data.data, function (key, value) {
                        var row = $('<tr>');

                        row.append($('<td>').text(key));
                        row.append($('<td>').text(value));
                        statisticsTable.append(row);
                    })
                    $('#total_hours').text(data.total_hours);
                    flag = true;
                })
            })
        })
    </script>
</body>

</html>