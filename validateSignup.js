<!-- Signup Form Javascript Validation -->
<!-- by Anna Blendermann-->

/* Set the function to call validateForm when selected */
window.onsubmit=validateForm;

function validateForm() {

    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;

    var invalidMessages = "";

    /* validate first and last name */
    if (isNaN(firstName) ) {
        invalidMessages += "Invalid first name.\n";
    }

    if (isNaN(lastName) ) {
        invalidMessages += "Invalid last name.\n";
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


