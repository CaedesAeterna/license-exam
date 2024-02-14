<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Statistics</title>
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
            <div class="button" id="backToProject"> Back to project</div>

            <div class="section has-text-centered">

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

                <div class="button mt-6" id="getStatistics">
                    Get statistic

                </div>


            </div>

            <div class="section has-text-centered">


                <table class="table is-responsive is-fullwidth  is-hoverable" id="statisticsTable">
                    <thead>

                        <th>
                        <th>Name</th>
                        <th>Hours</th>
                        </th>

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
        urlParams = new URLSearchParams(window.location.search);
        var project_id = urlParams.get('project_id');

        $('#backToProject').click(function () {

            window.location.href = "individual_project.php?project_id=" + project_id;

        })

        $('#getStatistics').click(function () {
            var statisticsTable = $('#statisticsTable');
            $("#statisticsTable tbody tr").remove();




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


            if (type != null) {
                //console.log(type)
            } else {
                //console.log('no type')
                return;
            }


            $.ajax({
                "method": "POST",
                "url": apiLink + "get_statistics",
                "cache": false,
                "data": {
                    type: type,
                    project_id: project_id,



                }

            }).done(function (data) {


                //todo

                data = JSON.parse(data);


                $.each(data.data, function (key, value) {
                    var row = $('<tr>');

                    row.append($('<td>').text(key));
                    row.append($('<td>').text(value));



                    statisticsTable.append(row);
                })

                console.log(data);



            })






        })






    </script>



</body>

</html>