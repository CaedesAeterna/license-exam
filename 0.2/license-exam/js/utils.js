

function redirectToPage(data) {

    if (data.redirect === undefined) {
        return false;
    }
    var target = data.redirect;

    switch (target) {
        case 'login':
            target = 'login.php';
            break;
        case 'dashboard':
            target = 'dashboard.php';
            break;

    }



    window.location.href = target;

    return true;


}



