<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bulma CSS <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css" /> -->

<link rel="stylesheet" href="../css/bulma.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="../css/style.css">
<link rel="icon" href="../logos/SVG/Asset 1.svg">

<link type="text/css" rel="stylesheet" href="../css/jquery-ui.css">

<script type="text/javascript" src="../js/jquery-3.7.1.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>

<script src="../js/utils.js"></script>

<script>

    $.ajax({
        method: "POST",
        url: apiLink + "check_session",

    }).done(function (data) {

        data = JSON.parse(data);
        //console.log(data);

        if (data == false && !document.URL.includes('login.php') && !document.URL.includes('forgot_password.php')) {
            window.location.href = 'login.php';
        }

    })

</script>