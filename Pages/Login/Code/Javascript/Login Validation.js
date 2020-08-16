// TO: Validate user input on login page
function login_validation() {
    // Declaring the username and password textboxes for manipulation
    var username_box = document.forms["login_form"]["login_username"];
    var password_box = document.forms["login_form"]["login_password"];
    /*
        I kept them as boxes rather than as the direct value so as to
        allow me to refocus on the values if they're not input
    */

    // Illegal Charachters

    // alert(/[^a-zA-Z0-9-/]/.test("username_box.value"));

    // Checking whether the username is blank or has any wrong charachters
    if (username_box.value === "" || username_box.value === null) {
        alert("The username cannot be blank!");
        username_box.focus();
        return false;
    } else if (password_box.value === "" || password_box.value === null) {
        alert("The password cannot be blank!");
        password_box.focus();
        return false;
    }
    //TODO: Remember to add validation checks for malicious scripts
}
