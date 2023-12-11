<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" />
</head>

<body>
    <!-- NAVBAR START ----------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'header.html';


    ?>
    <!-- NAVBAR END -------------------------------------------------------------------------------------------------------------------------->
    <main>
        <div class="container py-6 ">
            <div class="section ">
                <div class="table-container">

                    <div class="columns is-centered pb-5">
                        <div class="column is-3 has-text-centered">
                            <label class="is-centered "> Filter </label>
                            <input class="input " type="text"> </input>
                        </div>

                        <div class="column is-3 has-text-centered">
                            <label class="is-centered "> Begin date </label>
                            <input class="input " type="date"> </input>
                        </div>

                        <div class="column is-3 has-text-centered">
                            <label class="is-centered"> End date </label>
                            <input class="input " type="date"> </input>
                        </div>
                        <div class="column is-3 has-text-centered">
                            <button class="button is-flex is-justify-content-center is-align-content-center"> Search
                            </button>
                        </div>
                    </div>


                    <table class="table is-bordered  is-hoverable is-striped">
                        <thead>
                            <tr>
                                <th>Task name </th>
                                <th>Time spent</th>
                                <th>Task description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>First task</td>
                                <td>40h</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo
                                    urna vel
                                    nunc
                                    ultricies rhoncus. Etiam vel lorem nibh. Donec feugiat consectetur ante, ac
                                    semper
                                    justo
                                    facilisis sit amet. Nam a lorem felis. Cras dapibus pretium tempus. Quisque
                                    ut arcu
                                    vehicula, auctor dui nec, euismod risus.
                                </td>
                            </tr>
                            <tr>
                                <td>Second task </td>
                                <td>50h</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo urna vel
                                    nunc
                                    ultricies rhoncus. Etiam vel lorem nibh. Donec feugiat consectetur ante, ac semper
                                    justo
                                    facilisis sit amet. Nam a lorem felis. Cras dapibus pretium tempus. Quisque ut arcu
                                    vehicula, auctor dui nec, euismod risus.
                                </td>
                            </tr>
                            <tr>
                                <td>Third task</td>
                                <td>10h</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo urna vel
                                    nunc
                                    ultricies rhoncus. Etiam vel lorem nibh. Donec feugiat consectetur ante, ac semper
                                    justo
                                    facilisis sit amet. Nam a lorem felis. Cras dapibus pretium tempus. Quisque ut arcu
                                    vehicula, auctor dui nec, euismod risus.
                                </td>
                            </tr>
                            <tr>
                                <td>Fourth task </td>
                                <td>70h</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas commodo urna vel
                                    nunc
                                    ultricies rhoncus. Etiam vel lorem nibh. Donec feugiat consectetur ante, ac semper
                                    justo
                                    facilisis sit amet. Nam a lorem felis. Cras dapibus pretium tempus. Quisque ut arcu
                                    vehicula, auctor dui nec, euismod risus.
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>All time spent</th>
                                <th>170h</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- FOOTER START ------------------------------------------------------------------------------------------------------------------------------->
    <?php
    include 'footer.html';
    ?>
    <!-- FOOTER END------------------------------------------------------------------------------------------------------------------------------>
</body>

</html>