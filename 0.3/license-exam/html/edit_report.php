<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Edit report</title>
    <script src="../js/jquery.min.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-3 ">
            <div class="section ">
                <form>
                    <div class="columns is-centered">
                        <div class="column is-6">
                            <input class="input mb-2" type="text" placeholder="Summary" id="editSummary">
                            <input class="input mb-2" type="text" placeholder="Comments" id="editComments">

                            <div class="columns">
                                <div class="column">
                                    <input class="input mb-2" type="datetime-local" placeholder="startDateTime"
                                        id="startDateTime">
                                </div>
                                <div class="column">
                                    <input class="input mb-2" type="text" placeholder="Hours" id="editHours">
                                </div>
                            </div>

                            <input class="button" type="button" value="Submit edit" id="editReport">
                        </div>

                    </div>



                </form>

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
        // these comes from individual task

        const projects_id = urlParams.get('projects_id');
        const reports_id = urlParams.get('reports_id');
        const task_id = urlParams.get('task_id');

        const summary = urlParams.get('summary');
        const comments = urlParams.get('comments');
        const hours = urlParams.get('hours');

        //console.log('hours ', hours);

        var summary_input = $('#editSummary');
        var comments_input = $('#editComments');
        var hours_input = $('#editHours');
        var startDateTime_input = $('#startDateTime');


        summary_input.val(summary);
        comments_input.val(comments);
        hours_input.val(hours);


        $('#editReport').on('click', function () {


            startDateTime = startDateTime_input.val();

            //console.log('frontend stratdatetime', startDateTime);


            if ($('#editSummary').val() == "") {
                alert("Summary cannot be empty");
            } else if ($('#editComment').val() == "") {
                alert("Comment cannot be empty");
            } else if ($('#editHours').val() == "") {
                alert("Hours cannot be empty");
            } else if ($('#startDateTime').val() == "") {
                alert("Datetime cannot be empty");
            }
            else {

                $.ajax({
                    method: "POST",
                    url: apiLink + "edit_report",

                    data: {

                        "task_id": task_id,
                        "projects_id": projects_id,
                        "reports_id": reports_id,

                        "summary": summary_input.val(),
                        "comments": comments_input.val(),
                        "hours": hours_input.val(),

                        "startDateTime": startDateTime,

                    }

                }).done(function (data) {
                    console.log(data);

                    data = JSON.parse(data);
                    console.log(data);

                    if (data['success'] == true) {

                        window.location.href = "/license-exam/html/show_reports.php?task_id=" + task_id
                            + "&projects_id=" + projects_id;


                    }


                })
            }



        }
        )






    </script>

</body>

</html>