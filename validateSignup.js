<!-- Signup Form Javascript Validation -->
<!-- by Anna Blendermann-->

/* Set the function to call validateForm when selected */
var submit = document.getElementById("submit");
submit.onclick = validateForm;

function validateForm() {

    let firstName = document.getElementById("firstName").value;
    let lastName = document.getElementById("lastName").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let phone = document.getElementById("phone").value;
    let birthday = document.getElementById("birthday").value;
    let foods = document.getElementsByName("food[]");

    let startT = document.getElementById("startT").value;
    let endT = document.getElementById("endT").value;


    let invalidMessages = "";

    /* validate first and last name */
    if (!isNaN(firstName) ) {
        invalidMessages += "Invalid first name.\n";
    }
    if (!isNaN(lastName) ) {
        invalidMessages += "Invalid last name.\n";
    }

    /* validate email */

    var regex = /\S+@\S+\.\S+/;
    if (!regex.test(email)) {
        invalidMessages += "Invalid email address.\n";
    }


    /* validate password */

    if (password.length < 8) {
        invalidMessages += "Password must be at least 8 characters.\n";
    }


    /* validate phone number */
    if (isNaN(phone) || phone.length != 10) {
        invalidMessages += "Invalid phone number.\n";
    }

    if (birthday === "") {
        invalidMessages += "Select a valid birthday.\n";
    }


    let checked = false;
    for (let ele of foods) {
        if (ele.checked) {
            checked = true;
        }
    }
    if (!checked) {
        invalidMessages += "Select one or more food preferences.\n";
    }

    if (startT === "") {
        invalidMessages += "Select a start time.\n";
    }
    if (endT === "") {
        invalidMessages += "Select an end time.\n";
    }

    /* display error messages or submit data */
    if (invalidMessages !== "") {
        alert(invalidMessages);
        return false;
    }
    else {
        var submitMessage = "Do you want to sign up for Grab A Bite?\n";
        window.confirm(submitMessage);
    }
}
