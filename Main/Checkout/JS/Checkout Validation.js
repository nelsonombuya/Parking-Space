function checkoutValidation() {
    // Declaring the text box input as a variable
    var parking_id_box = document.forms["checkout_form"]["parking-id"];
    /*
        I kept them as boxes rather than as the direct value so as to
        allow me to refocus on the values if they're not input
    */
    // Illegal Characters
    illegal_characters = /[\<\>!@#\$%\_^&\*,\-]+/i;

    if (parking_id_box.value.match(illegal_characters)) {
        alert(
            "Parking Ticket Number shouldn't have illegal characters!\n(<, >, !, @, #, $, %, ^, &, *, _, -)"
        );
        parking_id_box.focus();
        return false;
    }

    // Checking whether the textbox is blank
    else if (parking_id_box.value === "" || parking_id_box.value === null) {
        alert("Please input your Parking Ticket Number");
        parking_id_box.focus();
        return false;
    }

    // If everything's okay
    return true;
}
