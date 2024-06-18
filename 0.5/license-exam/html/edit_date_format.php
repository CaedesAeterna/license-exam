<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'header.php'; ?>
    <title>Edit date format</title>

</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'nav.html';
    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->


    <main>
        <div class="container py-6 ">
            <div class="button ml-4" id="back_to_options"> Back to options</div>


            <div class="section">
                <div class="columns is-centered">
                    <div class="column is-6 has-text-centered">
                        <p class="subtitle">Select the date format you want</p>

                        <div class="select">
                            <select name="date_format" id="date_format">
                                <option value="d-m-Y"> dd/mm/yyyy</option>
                                <option value="m-d-Y"> mm/dd/yyyy</option>
                                <option value="Y-m-d"> yyyy/mm/dd</option>
                            </select>
                        </div>


                        <br>
                        <div class="button mt-6" id="edit_date_format">
                            Save
                        </div>
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


        $('#back_to_options').click(function () {
            window.location.href = "admin_options.php";
        })


        $('#edit_date_format').click(function () {

            $.ajax({
                "method": "POST",
                "url": apiLink + "edit_option",
                "data": {
                    "key": "date_format",
                    "value": $('#date_format').val()
                }

            }).done(function (data) {

                console.log(data);
                data = JSON.parse(data);
                if (data.success == true) {
                    basicPopUp(data.message);
                }




            })
        })

    </script>


</body>

</html>