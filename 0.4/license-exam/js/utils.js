
var apiLink = 'https://students.csik.sapientia.ro/~gi2021fig/license-exam-backend/api/v1/';
//Var apiLink = 'http://localhost/license-exam-backend/api/v1/';


/**
 * Redirects to the specified page based on the data provided.
 * @param {Object} data - The data object containing the redirect information.
 * @returns {boolean} - Returns true if the page was redirected, false otherwise.
 */
function redirectToPage(data) {
    if (data.redirect === undefined) {
        return false; // No redirect specified
    }
    var target = data.redirect;
    switch (target) {
        case 'login':
            target = 'login.php'; // Redirect to login page
            break;
        case 'dashboard':
            target = 'dashboard.php'; // Redirect to dashboard page
            break;
    }
    window.location.href = target; // Redirect to the specified page
    return true; // Page redirected
}


/**
 * Displays a basic pop-up notification with the given data.
 * @param {string} data - The content to be displayed in the notification.
 */
function basicPopUp(data) {

    // If data is undefined, show an alert
    if (data == undefined) {
        return alert(data);
    }

    // Append the notification to the body
    $(document.body).append('<div id="notification">' + data + '</div>');

    // Initialize the notification dialog
    $('#notification').dialog({
        title: 'Notification',
        resizable: false,
        modal: true,
        buttons: {
            "Ok": function () {
                $(this).dialog("close");
            }
        },
        close: function () {
            $(this).dialog('destroy').remove();
        }
    });
}

// Function to display a confirmation pop-up
/**
 * @param {string} data - The data to be displayed in the pop-up
 * @returns {Promise<string>} - A promise that resolves with "confirm" or "cancel"
 */
function confirmPopUp(data) {
    return new Promise((resolve, reject) => {
        if (data == undefined) {
            return reject('Data is undefined');
        }

        // Append the notification to the body
        $(document.body).append('<div id="notification">' + data + '</div>');

        // Create a dialog for confirmation
        $('#notification').dialog({
            title: 'Confirmation',
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Confirm": function () {
                    $(this).dialog("close");
                    resolve("confirm");
                },
                "Cancel": function () {
                    $(this).dialog("close");
                    resolve("cancel");
                }
            },
            close: function () {
                $(this).dialog('destroy').remove();
            }
        });
    });
}




