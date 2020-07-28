//Function for login page validation
function login_validation()
{
    //Declaring the username and password textboxes for manipulation
	var username_box = document.forms["login_form"]["login_username"];
    var password_box = document.forms["login_form"]["login_password"];
    /*
        I kept them as boxes rather than as the direct value so as to
        allow me to refocus on the values if they're not input
    */

	//Checking whether the username is blank
	if (username_box.value === "" || username_box.value === null)
	{
		alert("The username cannot be blank!");
		username_box.focus();
		return false;
	}
	else if (password_box.value === "" || username_box.value === null)
	{
		alert("The password cannot be blank!");
		password_box.focus();
		return false;
	}
}