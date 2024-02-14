
var apiLink = 'https://students.csik.sapientia.ro/~gi2021fig/license-exam-backend/api/v1/';
//Var apiLink = 'http://localhost/license-exam-backend/api/v1/';


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



