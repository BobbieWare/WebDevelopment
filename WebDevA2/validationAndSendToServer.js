// file simpleajax.js
var xhr = createRequest();
function getData(url, aName, aPhone, aUnitNumber, aStreet, aDestination, aDate, aTime) {
    alert("Please wait while we process your request");
    var validInput = true;
    var invalidReason = "Inputs were invalid because of the following reasons: "

    if (aName === "" || aPhone === "" || aStreet === "" || aDestination === "" || aDate === "" || aTime === "") {
        validInput = false;
        invalidReason += "- Some of the nessescary inputs were null. "
    }

    var givenDate = new Date(aDate + " " + aTime);
    var currentDate = new Date();;
    if (currentDate.valueOf() > givenDate.valueOf())
    {
        validInput = false;
        invalidReason += "- Pickup Date is before current date. "
    }

    if (aName.length > 40)
    {
        validInput = false;
        invalidReason += "- Name is too long. ";
    }

    if (aPhone.length > 20)
    {
        validInput = false;
        invalidReason += "- Phone is too long. ";
    }

    if (aStreet.length > 50)
    {
        validInput = false;
        invalidReason += "- Street is too long. ";
    }

    if (aDestination.length > 20)
    {
        validInput = false;
        invalidReason += "- Suburb is too long. ";
    }

    var container = document.getElementsByClassName("container")[0];
    if (container.children.length > 2) {
        var elem = container.children[2];
        container.removeChild(elem);
    }
    var content = document.createElement("div");
    content.className = "content";
    var p = document.createElement("p");
    var message = "";
    if (!validInput)
    {
        p.innerHTML = "" + invalidReason;
        content.appendChild(p);
        container.appendChild(content);
    } else {
        if (xhr) {
            var requestBody = "name=" + encodeURIComponent(aName) + "&phone=" + encodeURIComponent(aPhone) + "&unitNumber="
                    + encodeURIComponent(aUnitNumber) + "&street=" + encodeURIComponent(aStreet) + "&destination=" + encodeURIComponent(aDestination)
                    + "&date=" + encodeURIComponent(aDate) + "&time=" + encodeURIComponent(aTime);

            xhr.open("POST", url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    message = xhr.responseText;
                    p.innerHTML = message;
                    content.appendChild(p);
                    container.appendChild(content);
                }
            };
            xhr.send(requestBody);
        } 
    }


}