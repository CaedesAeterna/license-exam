<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.html'; ?>
    <title>Delete report</title>
    <script src="../js/jquery.min.js"></script>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6">
            <div class="section ">
                <form>
                    <div class="columns is-centered">
                        <div class="column is-4">
                            <label class="label mb-5"> Are you sure you wanna delete this report?</label>

                            <input type="button" class="button mr-6 my-2" id="deleteReport" value="Delete Report">
                            <input type="button" class="button ml-6 my-2" id="cancel" value="Cancel">
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
        const reports_id = urlParams.get('reports_id');
        const task_id = urlParams.get('task_id');
        const projects_id = urlParams.get('projects_id');


        $('#deleteReport').on('click', function () {

            $.ajax({
                method: "POST",
                url: apiLink + "delete_report",
                data: {
                    'reports_id': reports_id,
                    'task_id': task_id,
                    'projects_id': projects_id

                }
            }).done(function (data) {
                data = JSON.parse(data);
                console.log(data);

                window.location.href = "/license-exam/html/show_reports.php?task_id=" + task_id
                    + "&projects_id=" + projects_id;
            })

        });

        $('#cancel').on('click', function () {

            window.location.href = "/license-exam/html/show_reports.php?task_id=" + task_id
                + "&projects_id=" + projects_id;

        });

    </script>

</body>

</html>