<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- 
    
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
     -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" />
    <link rel="stylesheet" href="../css/tabs.css" />


    <script>
        $(document).ready(function () {
            $(document).on('click', '.dropdown', function () {
                $(this).toggleClass('is-active');
            });


            $('.tabs li').click(function (event) {
                event.preventDefault();

                // Remove the 'is-active' class from the currently active tab
                //$('.tabs li.is-active').removeClass('is-active');
                $('.tabs li.is-active').toggleClass('is-active');

                // Add the 'is-active' class to the clicked tab
                //$(this).addClass('is-active');

                // Hide all content divs
                $('.tab-content .tab-pane').hide();

                // Show the content div that corresponds to the clicked tab
                var tabId = $(this).data('tab');
                $('#' + tabId).show();
            });
        });

    </script>
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

                <div class="tabs is-centered is-boxed is-large">
                    <ul>
                        <li class="is-active" data-tab="clients"><a>Clients</a></li>
                        <li data-tab="workers"><a>Workers</a></li>
                        <li data-tab="project-managers"><a>Project managers</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div id="clients" class="tab-pane is-active">
                        <table class="table">
                            <th>Client name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <tr>
                                <td>Almafa</td>
                                <td>Almafa</td>
                                <td>
                                    <div class="dropdown ">
                                        <div class="dropdown-trigger">
                                            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                                <span>Dropdown button</span>
                                                <span class="icon is-small">
                                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <a href="#" class="dropdown-item">
                                                    Dropdown item
                                                </a>
                                                <a class="dropdown-item">
                                                    Dropdown item
                                                </a>

                                                <hr class="dropdown-divider">
                                                <a href="#" class="dropdown-item">
                                                    With a divider
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>Almafa</td>
                            </tr>
                        </table>
                    </div>
                    <div id="workers" class="tab-pane">
                        <table class="table">
                            <th>Worker name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <tr>
                                <td>Almafa</td>
                                <td>Almafa</td>
                                <td>
                                    <div class="dropdown ">
                                        <div class="dropdown-trigger">
                                            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                                <span>Dropdown button</span>
                                                <span class="icon is-small">
                                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <a href="#" class="dropdown-item">
                                                    Dropdown item
                                                </a>
                                                <a class="dropdown-item">
                                                    Dropdown item
                                                </a>

                                                <hr class="dropdown-divider">
                                                <a href="#" class="dropdown-item">
                                                    With a divider
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>Almafa</td>

                            </tr>
                        </table>
                    </div>
                    <div id="project-managers" class="tab-pane">
                        <table class="table">
                            <th>Manager name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <tr>
                                <td>Almafa</td>
                                <td>Almafa</td>
                                <td>
                                    <div class="dropdown ">
                                        <div class="dropdown-trigger">
                                            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                                <span>Dropdown button</span>
                                                <span class="icon is-small">
                                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <a href="#" class="dropdown-item">
                                                    Dropdown item
                                                </a>

                                                <a class="dropdown-item">
                                                    Dropdown item
                                                </a>

                                                <hr class="dropdown-divider">
                                                <a href="#" class="dropdown-item">
                                                    With a divider
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>Almafa</td>
                                
                            </tr>
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