// TO: Validate user input on login page
function login_validation() {
    // Declaring the username and password textboxes for manipulation
    var username_box = document.forms["login_form"]["login_username"];
    var password_box = document.forms["login_form"]["login_password"];
    /*
        I kept them as boxes rather than as the direct value so as to
        allow me to refocus on the fields if they're not input
    */

    // Illegal Characters
    illegal_characters = /[\<\>!@#\$%^&\*,\-]+/i; // Allows the underscore and dash

    if (username_box.value.match(illegal_characters)) {
        //Checks whether illegal characters have been used in the Username Box
        alert("The username has illegal characters!");
        username_box.focus();
        return false;
    }
    // Checking whether the username or password is blank
    else if (username_box.value === "" || username_box.value === null) {
        alert("The username cannot be blank!");
        username_box.focus();
        return false;
    } else if (password_box.value === "" || password_box.value === null) {
        alert("The password cannot be blank!");
        password_box.focus();
        return false;
    }
}
