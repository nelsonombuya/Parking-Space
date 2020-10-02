/*
    TO: Set a 30 seconds countdown then redirect to the Check-In Page
*/
var time_left = 30; // How much time before redirecting
var redirect_timer = setInterval(function () {
    if (time_left <= 0) {
        clearInterval(redirect_timer);
        document.getElementById("emphasis").innerHTML =
            "<h3><strong>Redirecting...</strong></h3>";
        window.location.href = "Pages/Check-In/Check-In.php"; // Page to redirect to
    } else if (time_left == 1) {
        document.getElementById("countdown").innerHTML = time_left + " second.";
        time_left -= 1;
    } else {
        document.getElementById("countdown").innerHTML =
            time_left + " seconds.";
        time_left -= 1;
    }
}, 1000);
